<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }} - Storefront</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
            --accent-color: #FFE66D;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 15px 0;
            sticky: top;
            z-index: 100;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .nav-link {
            margin: 0 10px;
            color: #333;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        /* Hero Banner */
        .hero-banner {
            background: linear-gradient(135deg, var(--primary-color) 0%, #ff5252 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .hero-banner h1 {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero-banner p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        /* Product Card */
        .product-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .product-image {
            width: 100%;
            height: 250px;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }

        .product-info {
            padding: 15px;
        }

        .product-name {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 8px;
            color: #333;
        }

        .product-price {
            color: var(--primary-color);
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-rating {
            color: #ffc107;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .btn-add-cart {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-add-cart:hover {
            background-color: #ff5252;
        }

        /* Footer */
        .footer {
            background: #333;
            color: white;
            padding: 40px 0 20px 0;
            margin-top: 60px;
        }

        .footer-title {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer-link {
            color: #ccc;
            text-decoration: none;
            margin-bottom: 10px;
            display: block;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid #555;
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
            color: #999;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/">
                    <i class="fas fa-store"></i> Gadget50
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/shop">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cart">
                                <i class="fas fa-shopping-cart"></i> Cart
                            </a>
                        </li>
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user"></i> {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="/account">My Account</a></li>
                                    <li><a class="dropdown-item" href="/account/orders">Orders</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-title">
                        <i class="fas fa-store"></i> Gadget50
                    </div>
                    <p>Your trusted online marketplace for quality products.</p>
                </div>
                <div class="col-md-3">
                    <div class="footer-title">Quick Links</div>
                    <a href="/" class="footer-link">Home</a>
                    <a href="/shop" class="footer-link">Shop</a>
                    <a href="/about" class="footer-link">About Us</a>
                    <a href="/contact" class="footer-link">Contact</a>
                </div>
                <div class="col-md-3">
                    <div class="footer-title">Support</div>
                    <a href="/faq" class="footer-link">FAQ</a>
                    <a href="/shipping" class="footer-link">Shipping Info</a>
                    <a href="/returns" class="footer-link">Returns</a>
                    <a href="/privacy" class="footer-link">Privacy Policy</a>
                </div>
                <div class="col-md-3">
                    <div class="footer-title">Connect</div>
                    <a href="#" class="footer-link"><i class="fab fa-facebook"></i> Facebook</a>
                    <a href="#" class="footer-link"><i class="fab fa-twitter"></i> Twitter</a>
                    <a href="#" class="footer-link"><i class="fab fa-instagram"></i> Instagram</a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Gadget50. All Rights Reserved. Powered by Gadget50.com</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
