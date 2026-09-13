@extends('admin.settings.layout')
@section('settings_content')

<div class="card">
    <div class="card-header">
        <i class="fas fa-window-minimize"></i> Footer Settings
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.store.footer') }}">
            @csrf

            <div class="mb-3">
                <label for="footer_columns" class="form-label">Footer Columns</label>
                <select class="form-select" id="footer_columns" name="footer_columns">
                    <option value="3" {{ ($settings['footer_columns'] ?? 4) == 3 ? 'selected' : '' }}>3 Columns</option>
                    <option value="4" {{ ($settings['footer_columns'] ?? 4) == 4 ? 'selected' : '' }}>4 Columns</option>
                    <option value="5" {{ ($settings['footer_columns'] ?? 4) == 5 ? 'selected' : '' }}>5 Columns</option>
                </select>
            </div>

            <hr>
            <h6 class="mb-3">FOOTER ELEMENTS</h6>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="show_newsletter" name="show_newsletter" value="1" {{ ($settings['show_newsletter'] ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="show_newsletter">
                    Show Newsletter Signup
                </label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="show_social_links" name="show_social_links" value="1" {{ ($settings['show_social_links'] ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="show_social_links">
                    Show Social Links
                </label>
            </div>

            <hr>
            <h6 class="mb-3">QUICK LINKS</h6>

            <p class="text-muted small">Configure which sections appear in the footer menu.</p>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="show_about" name="show_about" value="1" checked>
                <label class="form-check-label" for="show_about">
                    About Us
                </label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="show_contact" name="show_contact" value="1" checked>
                <label class="form-check-label" for="show_contact">
                    Contact Us
                </label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="show_help" name="show_help" value="1" checked>
                <label class="form-check-label" for="show_help">
                    Help Center
                </label>
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
