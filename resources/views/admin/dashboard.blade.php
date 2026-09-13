@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</nav>

<!-- Stats Row -->
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-card-value">${{ number_format($stats['total_revenue'] ?? 0, 2) }}</div>
            <div class="stat-card-label">Total Revenue</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card secondary">
            <div class="stat-card-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-card-value">{{ $stats['total_orders'] ?? 0 }}</div>
            <div class="stat-card-label">Total Orders</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card accent">
            <div class="stat-card-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-card-value">{{ $stats['total_customers'] ?? 0 }}</div>
            <div class="stat-card-label">Total Customers</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-card-value">{{ $stats['total_products'] ?? 0 }}</div>
            <div class="stat-card-label">Total Products</div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-bar"></i> Revenue Overview
            </div>
            <div class="card-body">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-pie"></i> Order Distribution
            </div>
            <div class="card-body">
                <canvas id="orderChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-list"></i> Recent Orders
                </span>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">
                    View All
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recent_orders ?? [] as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>${{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status === 'delivered' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-3">
                                        No orders yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue',
                data: [12000, 19000, 3000, 5000, 2000, 3000],
                borderColor: '#FF6B6B',
                backgroundColor: 'rgba(255, 107, 107, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Order Chart
    const orderCtx = document.getElementById('orderChart').getContext('2d');
    new Chart(orderCtx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending', 'Processing'],
            datasets: [{
                data: [300, 100, 50],
                backgroundColor: [
                    '#4ECDC4',
                    '#FF6B6B',
                    '#FFE66D'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endpush
@endsection
