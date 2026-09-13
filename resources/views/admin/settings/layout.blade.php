@extends('layouts.admin')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Settings</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.settings.general') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> General
                </a>
                <a href="{{ route('admin.settings.branding') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.settings.branding') ? 'active' : '' }}">
                    <i class="fas fa-palette"></i> Branding
                </a>
                <a href="{{ route('admin.settings.theme') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.settings.theme') ? 'active' : '' }}">
                    <i class="fas fa-paint-brush"></i> Theme
                </a>
                <a href="{{ route('admin.settings.header') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.settings.header') ? 'active' : '' }}">
                    <i class="fas fa-window-maximize"></i> Header
                </a>
                <a href="{{ route('admin.settings.footer') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.settings.footer') ? 'active' : '' }}">
                    <i class="fas fa-window-minimize"></i> Footer
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        @yield('settings_content')
    </div>
</div>

@endsection
