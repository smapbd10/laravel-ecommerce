@extends('layouts.app')
@section('content')

<!-- Hero Banner -->
<div class="hero-banner">
    <div class="container">
        <h1>Welcome to Gadget50</h1>
        <p>Discover Amazing Products at Great Prices</p>
        <div>
            <a href="/shop" class="btn btn-light btn-lg">
                <i class="fas fa-shopping-bag"></i> Start Shopping
            </a>
        </div>
    </div>
</div>

<!-- Featured Categories -->
<div class="container py-5">
    <h2 class="mb-4 text-center">Shop by Category</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div style="background: var(--primary-color); color: white; padding: 40px; font-size: 48px;">
                    <i class="fas fa-mobile"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Phones</h5>
                    <p class="card-text">Latest mobile phones and accessories</p>
                    <a href="/category/phones" class="btn btn-primary">Browse</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div style="background: var(--secondary-color); color: white; padding: 40px; font-size: 48px;">
                    <i class="fas fa-laptop"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Laptops</h5>
                    <p class="card-text">High-performance computing devices</p>
                    <a href="/category/laptops" class="btn btn-primary">Browse</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-center">
                <div style="background: var(--accent-color); color: white; padding: 40px; font-size: 48px;">
                    <i class="fas fa-headphones"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Accessories</h5>
                    <p class="card-text">Premium quality gadget accessories</p>
                    <a href="/category/accessories" class="btn btn-primary">Browse</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Products -->
<div class="container py-5 bg-light" style="border-radius: 10px;">
    <h2 class="mb-4 text-center">Featured Products</h2>
    <div class="row">
        @for ($i = 1; $i <= 6; $i++)
            <div class="col-md-4 col-sm-6">
                <div class="product-card">
                    <div class="product-image">
                        <i class="fas fa-box" style="font-size: 48px;"></i>
                    </div>
                    <div class="product-info">
                        <div class="product-name">Featured Product {{ $i }}</div>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            (48 reviews)
                        </div>
                        <div class="product-price">${{ 99.99 + ($i * 10) }}</div>
                        <button class="btn-add-cart">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>

@endsection
