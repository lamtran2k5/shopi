 @extends('layouts.app')
 @section('title', $viewData['title'])
 @section('content')
<div class="row">
    @foreach ($viewData['product'] as $product)
        <div class="col-md-4 col-lg-3 mb-2">
            <div class="card">
            <img src="{{ asset('/img/' . $product->image) }}"
            class="card-img-top">
                <div class="card-body text-center">
                <a href="{{ route('product.detail', ['id' => $product->id]) }}"
                class="btn bg-primary text-white">
                {{ $product->name }}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
 @endsection
