@extends('layouts.admin')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
        <li class="breadcrumb-item active">Manage Roles</li>
    </ol>
</nav>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>
            <i class="fas fa-lock"></i> Roles & Permissions
        </span>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Role
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Role Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Users</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles ?? [] as $role)
                        <tr>
                            <td>
                                <strong>{{ $role->name }}</strong>
                                @if ($role->is_system)
                                    <span class="badge bg-secondary">System</span>
                                @endif
                            </td>
                            <td><code>{{ $role->slug }}</code></td>
                            <td>{{ Str::limit($role->description, 40) }}</td>
                            <td>
                                <span class="badge bg-info">{{ $role->users()->count() }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success">{{ $role->permissions()->count() }}</span>
                            </td>
                            <td>
                                @if (!$role->is_system)
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No roles found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
