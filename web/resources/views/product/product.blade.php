 @extends('layouts.app')
 @section('title', $title)
 @section('content')
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('/img/'.$product->image) }}"
            class="img-fluid rounded-start">
        </div>
            <div class="col-md-8">
            <div class="card-body">
            <h5 class="card-title">
            {{ $product->name }}
            (${{ $product->price }})
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text"><small class="text-muted">Add to Cart</small></p>
            </div>
        </div>
    </div>
 @endsection
    