@extends('layouts.admin')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Brands</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>
            <i class="fas fa-trademark"></i> Brands
        </span>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Brand
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Brand Name</th>
                        <th>Slug</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands ?? [] as $brand)
                        <tr>
                            <td>
                                @if ($brand->logo)
                                    <img src="{{ $brand->logo }}" alt="{{ $brand->name }}" style="max-height: 30px; margin-right: 10px;">
                                @endif
                                <strong>{{ $brand->name }}</strong>
                            </td>
                            <td><code>{{ $brand->slug }}</code></td>
                            <td>
                                <span class="badge bg-info">{{ $brand->products()->count() }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $brand->active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $brand->active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.brands.destroy', $brand->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No brands found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
