@extends('admin.settings.layout')
@section('settings_content')

<div class="card">
    <div class="card-header">
        <i class="fas fa-window-maximize"></i> Header Settings
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.store.header') }}">
            @csrf

            <div class="mb-3">
                <label for="header_layout" class="form-label">Header Layout</label>
                <select class="form-select" id="header_layout" name="header_layout">
                    <option value="default" {{ ($settings['header_layout'] ?? 'default') === 'default' ? 'selected' : '' }}>Default</option>
                    <option value="minimal" {{ ($settings['header_layout'] ?? '') === 'minimal' ? 'selected' : '' }}>Minimal</option>
                    <option value="modern" {{ ($settings['header_layout'] ?? '') === 'modern' ? 'selected' : '' }}>Modern</option>
                </select>
            </div>

            <hr>
            <h6 class="mb-3">HEADER ELEMENTS</h6>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="show_search" name="show_search" value="1" {{ ($settings['show_search'] ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="show_search">
                    Show Search Bar
                </label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="show_wishlist" name="show_wishlist" value="1" {{ ($settings['show_wishlist'] ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="show_wishlist">
                    Show Wishlist Icon
                </label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="show_cart" name="show_cart" value="1" {{ ($settings['show_cart'] ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="show_cart">
                    Show Cart Icon
                </label>
            </div>

            <hr>
            <h6 class="mb-3">STICKY HEADER</h6>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="sticky_header" name="sticky_header" value="1">
                <label class="form-check-label" for="sticky_header">
                    Enable sticky header on scroll
                </label>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
