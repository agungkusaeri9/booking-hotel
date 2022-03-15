@extends('user.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4">
               <a href="{{ route('product.show', $product->slug) }}" class="nav-link">
                <div class="card" style="width: 18rem;min-height:25rem">
                    <img class="card-img-top" src="{{ $product->image() }}" alt="Card image cap" style="height: 12rem;width:100%">
                    <div class="card-body">
                        <h6>Rp {{ number_format($product->price->price) }}/<span class="small">Hari</span></h6>
                      <h5 class="card-title text-dark">{{ $product->name }}</h5>
                      <p class="card-text text-dark">{{ Str::limit($product->description,200) }}</p>
                    </div>
                  </div>
               </a>
            </div>
        @endforeach
    </div>
</div>
@endsection