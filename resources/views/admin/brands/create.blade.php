@extends('layouts.admin')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Brands</a></li>
        <li class="breadcrumb-item active">Create Brand</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-plus"></i> Create New Brand
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.brands.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Brand Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug *</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" required>
                        @error('slug')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo URL</label>
                        <input type="url" class="form-control" id="logo" name="logo" value="{{ old('logo') }}" placeholder="https://example.com/logo.png">
                    </div>

                    <div class="mb-3">
                        <label for="website" class="form-label">Website URL</label>
                        <input type="url" class="form-control" id="website" name="website" value="{{ old('website') }}" placeholder="https://brand-website.com">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Brand
                        </button>
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
