@extends('layouts.admin')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
        <li class="breadcrumb-item active">Order {{ $order->order_number }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    <i class="fas fa-receipt"></i> Order Details
                </span>
                <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" class="d-inline">
                    @csrf
                    <div class="input-group input-group-sm">
                        <select name="status" class="form-select">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="packed" {{ $order->status === 'packed' ? 'selected' : '' }}>Packed</option>
                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">CUSTOMER INFORMATION</h6>
                        <p>
                            <strong>{{ $order->customer_name }}</strong><br>
                            {{ $order->customer_email }}<br>
                            {{ $order->customer_phone }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">ORDER INFORMATION</h6>
                        <p>
                            <strong>Order #:</strong> {{ $order->order_number }}<br>
                            <strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}<br>
                            <strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                        </p>
                    </div>
                </div>

                <hr>

                <h6 class="text-muted mb-3">SHIPPING ADDRESS</h6>
                <p>
                    {{ $order->shipping_address }}<br>
                    {{ $order->city }}, {{ $order->state }} {{ $order->postal_code }}<br>
                    {{ $order->country }}
                </p>

                <hr>

                <h6 class="text-muted mb-3">ORDER ITEMS</h6>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-dollar-sign"></i> Order Summary
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal:</span>
                    <strong>${{ number_format($order->subtotal, 2) }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Discount:</span>
                    <strong>-${{ number_format($order->discount_amount, 2) }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Tax:</span>
                    <strong>${{ number_format($order->tax_amount, 2) }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Shipping:</span>
                    <strong>${{ number_format($order->shipping_amount, 2) }}</strong>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bold">Total:</span>
                    <strong class="fs-5" style="color: var(--primary-color);">${{ number_format($order->total_amount, 2) }}</strong>
                </div>
                <a href="#" class="btn btn-primary w-100 mb-2">
                    <i class="fas fa-download"></i> Download Invoice
                </a>
                <a href="#" class="btn btn-secondary w-100">
                    <i class="fas fa-envelope"></i> Send Email
                </a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Status
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item {{ in_array($order->status, ['confirmed', 'processing', 'packed', 'shipped', 'delivered']) ? 'completed' : '' }}">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h6>Order Confirmed</h6>
                            <p class="text-muted small">{{ $order->confirmed_at?->format('M d, Y') ?? 'Pending' }}</p>
                        </div>
                    </div>
                    <div class="timeline-item {{ in_array($order->status, ['shipped', 'delivered']) ? 'completed' : '' }}">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h6>Shipped</h6>
                            <p class="text-muted small">{{ $order->shipped_at?->format('M d, Y') ?? 'Pending' }}</p>
                        </div>
                    </div>
                    <div class="timeline-item {{ $order->status === 'delivered' ? 'completed' : '' }}">
                        <div class="timeline-marker"></div>
                        <div class="timeline-content">
                            <h6>Delivered</h6>
                            <p class="text-muted small">{{ $order->delivered_at?->format('M d, Y') ?? 'Pending' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .timeline {
        position: relative;
        padding: 20px 0;
    }
    .timeline-item {
        display: flex;
        margin-bottom: 30px;
        position: relative;
    }
    .timeline-item.completed .timeline-marker {
        background-color: #4ECDC4;
    }
    .timeline-marker {
        width: 20px;
        height: 20px;
        background-color: #ddd;
        border-radius: 50%;
        margin-right: 20px;
        margin-top: 5px;
        flex-shrink: 0;
    }
    .timeline-content h6 {
        margin: 0 0 5px 0;
    }
</style>
@endpush

@endsection
