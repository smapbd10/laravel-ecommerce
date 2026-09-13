# Gadget50 - Master Laravel E-Commerce Platform

A complete, production-ready, reusable Laravel e-commerce platform designed for shared hosting and all hosting environments.

## 🚀 Features

### Core Foundation (Phase 1)
- ✅ Laravel Framework setup
- ✅ Database migrations
- ✅ RBAC (Role-Based Access Control) system
- ✅ User authentication (Admin & Customer)
- ✅ Settings management system
- ✅ First-run installation wizard

### E-Commerce Features (Phases 2-7)
- Admin Dashboard
- Product Management (Simple, Variable, Bundle, Digital)
- Category & Brand Management
- Customer System with Profiles
- Shopping Cart & Wishlist
- Checkout & Payment Gateway Architecture
- Order Management & Tracking
- Inventory System
- Coupon & Discount System
- Shipping & Tax Calculation
- Product Reviews & Ratings
- Blog, News & CMS
- Theme Customizer
- Email & Notification System
- Analytics & Reporting

### Commercial Features (Phase 8)
- API Architecture (for mobile apps)
- License/Activation System
- Multi-store/White-label Support
- Deployment Documentation

## 📋 Requirements

- PHP 8.1 or higher
- MySQL/MariaDB 5.7+
- Composer
- Node.js (optional, for frontend assets)

## 🔧 Installation

### 1. Clone Repository
```bash
git clone https://github.com/smapbd10/laravel-ecommerce.git
cd laravel-ecommerce
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Access Installation Wizard
Open your browser and navigate to:
```
http://your-domain.com/install
```

The installer will:
- Verify system requirements
- Configure database
- Create super admin account
- Run migrations
- Seed default data

## 📁 Project Structure

```
laravel-ecommerce/
├── app/
│   ├── Models/          # Eloquent models
│   ├── Http/            # Controllers, Requests, Resources
│   ├── Services/        # Business logic
│   └── Actions/         # Reusable actions
├── database/
│   ├── migrations/      # Database migrations
│   ├── seeders/         # Database seeders
│   └── factories/       # Model factories
├── resources/
│   ├── views/           # Blade templates
│   │   ├── admin/       # Admin dashboard
│   │   ├── customer/    # Customer pages
│   │   └── install/     # Installation wizard
│   └── css/
├── routes/              # Application routes
├── tests/               # Unit & Feature tests
└── README.md
```

## 🔐 Security

- CSRF protection enabled
- XSS protection
- SQL injection prevention
- Secure password hashing (bcrypt)
- Permission-based access control
- Audit logging

## 🎨 Customization

All important store information is database-driven:
- Logo & Branding
- Colors & Typography
- Header & Footer
- Homepage Builder
- Menus & Navigation
- SEO Settings
- Email Templates

No source code editing required for normal customization.

## 📱 Mobile App Readiness

The backend is architected to support:
- Flutter apps
- React Native apps
- Native iOS/Android apps
- Windows Desktop apps

Clean REST API endpoints are prepared for future mobile integrations.

## 📚 Documentation

For detailed documentation, see:
- [Installation Guide](docs/INSTALLATION.md)
- [Admin Guide](docs/ADMIN_GUIDE.md)
- [API Documentation](docs/API.md)
- [Theme Customization](docs/THEME.md)

## 🤝 Support

For issues and feature requests, please open an issue on GitHub.

## 📄 License

MIT License - See LICENSE file for details.

## 🏢 Powered by

Powered by Gadget50.com

---

**Status**: Phase 1 - Foundation Complete ✅
