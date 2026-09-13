@extends('admin.settings.layout')
@section('settings_content')

<div class="card">
    <div class="card-header">
        <i class="fas fa-cog"></i> General Settings
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.store.general') }}">
            @csrf

            <div class="mb-3">
                <label for="app_name" class="form-label">Website Name</label>
                <input type="text" class="form-control" id="app_name" name="app_name" value="{{ $settings['app_name'] ?? '' }}">
            </div>

            <div class="mb-3">
                <label for="app_url" class="form-label">Website URL</label>
                <input type="url" class="form-control" id="app_url" name="app_url" value="{{ $settings['app_url'] ?? '' }}">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="app_timezone" class="form-label">Timezone</label>
                        <select class="form-select" id="app_timezone" name="app_timezone">
                            <option value="UTC" {{ ($settings['app_timezone'] ?? 'UTC') === 'UTC' ? 'selected' : '' }}>UTC</option>
                            <option value="America/New_York" {{ ($settings['app_timezone'] ?? '') === 'America/New_York' ? 'selected' : '' }}>Eastern Time</option>
                            <option value="America/Chicago" {{ ($settings['app_timezone'] ?? '') === 'America/Chicago' ? 'selected' : '' }}>Central Time</option>
                            <option value="America/Denver" {{ ($settings['app_timezone'] ?? '') === 'America/Denver' ? 'selected' : '' }}>Mountain Time</option>
                            <option value="America/Los_Angeles" {{ ($settings['app_timezone'] ?? '') === 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time</option>
                            <option value="Europe/London" {{ ($settings['app_timezone'] ?? '') === 'Europe/London' ? 'selected' : '' }}>GMT</option>
                            <option value="Asia/Dhaka" {{ ($settings['app_timezone'] ?? '') === 'Asia/Dhaka' ? 'selected' : '' }}>Bangladesh</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <select class="form-select" id="currency" name="currency">
                            <option value="USD" {{ ($settings['currency'] ?? 'USD') === 'USD' ? 'selected' : '' }}>USD ($)</option>
                            <option value="EUR" {{ ($settings['currency'] ?? '') === 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                            <option value="GBP" {{ ($settings['currency'] ?? '') === 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                            <option value="BDT" {{ ($settings['currency'] ?? '') === 'BDT' ? 'selected' : '' }}>BDT (৳)</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr>
            <h6 class="mb-3">BUSINESS INFORMATION</h6>

            <div class="mb-3">
                <label for="business_name" class="form-label">Business Name</label>
                <input type="text" class="form-control" id="business_name" name="business_name" value="{{ $settings['business_name'] ?? '' }}">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="business_email" class="form-label">Business Email</label>
                        <input type="email" class="form-control" id="business_email" name="business_email" value="{{ $settings['business_email'] ?? '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="business_phone" class="form-label">Business Phone</label>
                        <input type="tel" class="form-control" id="business_phone" name="business_phone" value="{{ $settings['business_phone'] ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" id="country" name="country">
                    <option value="US" {{ ($settings['country'] ?? 'US') === 'US' ? 'selected' : '' }}>United States</option>
                    <option value="UK" {{ ($settings['country'] ?? '') === 'UK' ? 'selected' : '' }}>United Kingdom</option>
                    <option value="BD" {{ ($settings['country'] ?? '') === 'BD' ? 'selected' : '' }}>Bangladesh</option>
                    <option value="IN" {{ ($settings['country'] ?? '') === 'IN' ? 'selected' : '' }}>India</option>
                </select>
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
