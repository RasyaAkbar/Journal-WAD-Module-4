@extends('layouts.app')

@section('content')
@if(session('error') || session('success'))
    @php
        $type = session('error') ? 'error' : 'success';
        $message = session($type);
        $alertClass = $type === 'error' ? 'alert-danger' : 'alert-success';
        $id = $type . '-message';
    @endphp

    <div id="{{ $id }}" class="alert {{ $alertClass }} alert-dismissible fade show" role="alert">
        <span>{{ $message }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(() => {
            const el = document.getElementById('{{ $id }}');
            if (el) {
                const alert = new bootstrap.Alert(el);
                alert.close();
            }
        }, 5000);
    </script>
@endif
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Books Collection</h1>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Add New Book
            </a>
        @endif
    </div>
    
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
        @foreach($books as $book)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 hover-card overflow-hidden">
                    {{-- Cover Image --}}
                    <div class="position-relative bg-gradient d-flex align-items-center justify-content-center" style="height: 280px; overflow: hidden;">
                        @if ($book->cover_image && file_exists(public_path('storage/' . $book->cover_image)))
                            <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                alt="{{ $book->title }} Cover" 
                                style="max-width: 100%; max-height: 100%; width: auto; height: auto; object-fit: contain;">
                        @else
                            <i class="bi bi-book text-white" style="font-size: 5rem; opacity: 0.6;"></i>
                        @endif
                        
                        {{-- Published Year Badge --}}
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge bg-dark bg-opacity-75 px-3 py-2">{{ $book->published_year }}</span>
                        </div>
                    </div>
                    
                    {{-- Card Body --}}
                    <div class="card-body d-flex flex-column p-3">
                        <h5 class="card-title fw-bold mb-2" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $book->title }}">
                            {{ $book->title }}
                        </h5>
                        <p class="card-text text-muted small mb-2">
                            <i class="bi bi-person"></i> {{ $book->author }}
                        </p>
                        <p class="card-text small text-secondary flex-grow-1 mb-3" style="line-height: 1.5; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                            {{ Str::limit($book->description, 100) }}
                        </p>
                        
                        {{-- Action Buttons --}}
                        <div class="mt-auto">
                            @if(auth()->user()->role === 'admin')
                                <div class="d-flex gap-2 mb-2">
                                    <a href="{{ route('books.edit', $book) }}" 
                                       class="btn btn-outline-warning btn-sm flex-fill">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('books.destroy', $book) }}" 
                                          method="POST" 
                                          class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm w-100" 
                                                onclick="return confirm('Are you sure you want to delete this book?')">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                            
                            <a href="{{ route('books.show', $book) }}" 
                               class="btn btn-primary w-100">
                                <i class="bi bi-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    {{-- Pagination if needed --}}
    @if(method_exists($books, 'links'))
        <div class="mt-4">
            {{ $books->links() }}
        </div>
    @endif
</div>

<style>
    .bg-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endsection