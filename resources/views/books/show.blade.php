@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="row g-0">
                {{-- Cover Image or Default Icon --}}
                <div class="col-md-4">
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center h-100">
                        @if ($book->cover_image && file_exists(public_path('storage/' . $book->cover_image)))
                            <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                 alt="{{ $book->title }} Cover" 
                                 class="img-fluid rounded-start w-100 h-100 object-fit-cover">
                        @else
                            <i class="bi bi-book" style="font-size: 4rem;"></i>
                        @endif
                    </div>
                </div>

                {{-- Book Details --}}
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title">{{ $book->title }}</h2>
                        <h5 class="card-subtitle mb-2 text-muted">By {{ $book->author }}</h5>
                        
                        <p class="card-text">{{ $book->description }}</p>

                        <div class="mb-2">
                            <strong>Tahun Terbit:</strong> {{ $book->published_year }}
                        </div>

                        <div class="mb-3">
                            <strong>ISBN:</strong> {{ $book->isbn }}
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection