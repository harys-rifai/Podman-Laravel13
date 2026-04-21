@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0">Dashboard</h4>
            <p class="text-muted mb-0">Welcome back, {{ Auth::user()->name }}!</p>
        </div>
        <div class="avatar avatar-lg">
            {{ substr(Auth::user()->name, 0, 1) }}
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card card-stat h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon bg-primary">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ms-3">
                        <p class="text-muted mb-0">Total Users</p>
                        <h4 class="mb-0">{{ \App\Models\User::count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon bg-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="ms-3">
                        <p class="text-muted mb-0">Active</p>
                        <h4 class="mb-0">{{ \App\Models\User::count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon bg-info">
                        <i class="bi bi-bar-chart"></i>
                    </div>
                    <div class="ms-3">
                        <p class="text-muted mb-0">Sessions</p>
                        <h4 class="mb-0">0</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="icon bg-warning">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="ms-3">
                        <p class="text-muted mb-0">Pending</p>
                        <h4 class="mb-0">0</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i>Recent Activity</h5>
            </div>
            <div class="card-body">
                <div class="text-center text-muted py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                    <p class="mt-2">No recent activity</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-gear me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <i class="bi bi-person-plus me-2"></i>Add User
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-people me-2"></i>Manage Users
                    </a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-person-circle me-2"></i>Profile Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection