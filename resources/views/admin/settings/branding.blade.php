@extends('admin.settings.layout')
@section('settings_content')

<div class="card">
    <div class="card-header">
        <i class="fas fa-palette"></i> Branding Settings
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.store.branding') }}">
            @csrf

            <h6 class="mb-3">LOGO & ICONS</h6>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="text" class="form-control" id="logo" name="logo" placeholder="Logo URL" value="{{ $settings['logo'] ?? '' }}">
                <small class="text-muted">Upload and paste the logo image URL</small>
            </div>

            <div class="mb-3">
                <label for="dark_logo" class="form-label">Dark Mode Logo</label>
                <input type="text" class="form-control" id="dark_logo" name="dark_logo" placeholder="Dark logo URL" value="{{ $settings['dark_logo'] ?? '' }}">
            </div>

            <div class="mb-3">
                <label for="favicon" class="form-label">Favicon</label>
                <input type="text" class="form-control" id="favicon" name="favicon" placeholder="Favicon URL" value="{{ $settings['favicon'] ?? '' }}">
            </div>

            <hr>
            <h6 class="mb-3">BRANDING TEXT</h6>

            <div class="mb-3">
                <label for="copyright_text" class="form-label">Copyright Text</label>
                <input type="text" class="form-control" id="copyright_text" name="copyright_text" value="{{ $settings['copyright_text'] ?? '' }}" placeholder="© {YEAR} Company. All Rights Reserved.">
                <small class="text-muted">Use {YEAR} to auto-update the current year</small>
            </div>

            <div class="mb-3">
                <label for="powered_by_text" class="form-label">Powered By Text</label>
                <input type="text" class="form-control" id="powered_by_text" name="powered_by_text" value="{{ $settings['powered_by_text'] ?? '' }}" placeholder="Powered by Gadget50.com">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="show_powered_by" name="show_powered_by" value="1" {{ ($settings['show_powered_by'] ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="show_powered_by">
                    Show "Powered by" in footer
                </label>
            </div>

            <hr>
            <h6 class="mb-3">SOCIAL & SEO</h6>

            <div class="mb-3">
                <label for="og_image" class="form-label">Open Graph Image</label>
                <input type="text" class="form-control" id="og_image" name="og_image" placeholder="OG image URL" value="{{ $settings['og_image'] ?? '' }}">
                <small class="text-muted">Image used when sharing on social media (1200x630px recommended)</small>
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
