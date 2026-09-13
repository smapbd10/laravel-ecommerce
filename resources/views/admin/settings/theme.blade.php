@extends('admin.settings.layout')
@section('settings_content')

<div class="card">
    <div class="card-header">
        <i class="fas fa-paint-brush"></i> Theme Settings
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.store.theme') }}">
            @csrf

            <h6 class="mb-3">COLORS</h6>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="primary_color" class="form-label">Primary Color</label>
                        <input type="color" class="form-control form-control-color" id="primary_color" name="primary_color" value="{{ $settings['primary_color'] ?? '#FF6B6B' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="secondary_color" class="form-label">Secondary Color</label>
                        <input type="color" class="form-control form-control-color" id="secondary_color" name="secondary_color" value="{{ $settings['secondary_color'] ?? '#4ECDC4' }}">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="accent_color" class="form-label">Accent Color</label>
                <input type="color" class="form-control form-control-color" id="accent_color" name="accent_color" value="{{ $settings['accent_color'] ?? '#FFE66D' }}">
            </div>

            <hr>
            <h6 class="mb-3">MODE</h6>

            <div class="form-check">
                <input class="form-check-input" type="radio" id="light_mode" name="dark_mode" value="0" {{ !($settings['dark_mode'] ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="light_mode">
                    Light Mode
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="dark_mode" name="dark_mode" value="1" {{ ($settings['dark_mode'] ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="dark_mode">
                    Dark Mode
                </label>
            </div>

            <hr>
            <h6 class="mb-3">PREVIEW</h6>

            <div class="alert alert-info">
                <strong>Preview:</strong> Theme colors will be applied across the entire storefront.
                <div class="mt-3">
                    <div class="mb-2">
                        <span class="badge" style="background-color: {{ $settings['primary_color'] ?? '#FF6B6B' }}">Primary</span>
                        <span class="badge" style="background-color: {{ $settings['secondary_color'] ?? '#4ECDC4' }}">Secondary</span>
                        <span class="badge" style="background-color: {{ $settings['accent_color'] ?? '#FFE66D' }}">Accent</span>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
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
