@extends('layouts.admin')

@section('title', 'KKD Dashboard')
@section('header', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="neo-stat-card p-4">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-xs font-medium text-gray-600 mb-1">Today's Sales</p>
                <p class="khmer-small text-gray-500 mb-2">ការលក់ថ្ងៃនេះ</p>
                <p class="text-2xl font-bold text-gray-900">${{ number_format($todaySales, 2) }}</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center" style="background: linear-gradient(180deg, #ffd700 0%, #daa520 100%); border: 1px solid #b8860b; box-shadow: inset 1px 1px 0 rgba(255,255,255,0.5);">
                <i class="fas fa-dollar-sign text-white text-lg" style="text-shadow: 1px 1px 1px rgba(0,0,0,0.3);"></i>
            </div>
        </div>
    </div>

    <div class="neo-stat-card p-4">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-xs font-medium text-gray-600 mb-1">Total Sales</p>
                <p class="khmer-small text-gray-500 mb-2">ការលក់សរុប</p>
                <p class="text-2xl font-bold text-gray-900">${{ number_format($totalSales, 2) }}</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center" style="background: linear-gradient(180deg, #90ee90 0%, #32cd32 100%); border: 1px solid #228b22; box-shadow: inset 1px 1px 0 rgba(255,255,255,0.5);">
                <i class="fas fa-chart-line text-white text-lg" style="text-shadow: 1px 1px 1px rgba(0,0,0,0.3);"></i>
            </div>
        </div>
    </div>

    <div class="neo-stat-card p-4">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-xs font-medium text-gray-600 mb-1">Total Products</p>
                <p class="khmer-small text-gray-500 mb-2">ទំនិញសរុប</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center" style="background: linear-gradient(180deg, #dda0dd 0%, #ba55d3 100%); border: 1px solid #9932cc; box-shadow: inset 1px 1px 0 rgba(255,255,255,0.5);">
                <i class="fas fa-box text-white text-lg" style="text-shadow: 1px 1px 1px rgba(0,0,0,0.3);"></i>
            </div>
        </div>
    </div>

    <div class="neo-stat-card p-4">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-xs font-medium text-gray-600 mb-1">Low Stock</p>
                <p class="text-2xl font-bold text-gray-900">{{ $lowStockProducts }}</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center" style="background: linear-gradient(180deg, #ff6b6b 0%, #ee5a52 100%); border: 1px solid #dc143c; box-shadow: inset 1px 1px 0 rgba(255,255,255,0.5);">
                <i class="fas fa-exclamation-triangle text-white text-lg" style="text-shadow: 1px 1px 1px rgba(0,0,0,0.3);"></i>
            </div>
        </div>
    </div>
</div>

<!-- Customer Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div class="neo-stat-card p-4">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-xs font-medium text-gray-600 mb-1">Total Customers</p>
                <p class="khmer-small text-gray-500 mb-2">អតិថិជនសរុប</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($totalCustomers) }}</p>
                <a href="{{ route('admin.customers') }}" class="text-xs font-medium text-blue-700 hover:text-blue-900 mt-2 inline-block mixed-text" style="text-decoration: underline;">
                    <i class="fas fa-arrow-right mr-1"></i>Manage Customers / គ្រប់គ្រងអតិថិជន
                </a>
            </div>
            <div class="w-12 h-12 flex items-center justify-center" style="background: linear-gradient(180deg, #87ceeb 0%, #4682b4 100%); border: 1px solid #4169e1; box-shadow: inset 1px 1px 0 rgba(255,255,255,0.5);">
                <i class="fas fa-users text-white text-lg" style="text-shadow: 1px 1px 1px rgba(0,0,0,0.3);"></i>
            </div>
        </div>
    </div>

    <div class="neo-stat-card p-4">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-xs font-medium text-gray-600 mb-1">Available Points</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($totalPointsAvailable) }}</p>
                <p class="text-xs font-medium text-orange-700 mt-2">
                    <i class="fas fa-dollar-sign mr-1"></i>Worth ${{ number_format($totalPointsAvailable, 2) }}
                </p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center" style="background: linear-gradient(180deg, #ffa500 0%, #ff8c00 100%); border: 1px solid #ff6347; box-shadow: inset 1px 1px 0 rgba(255,255,255,0.5);">
                <i class="fas fa-star text-white text-lg" style="text-shadow: 1px 1px 1px rgba(0,0,0,0.3);"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Sales Table -->
<div class="neo-card">
    <div class="classic-panel-header">
        Recent Sales
    </div>
    <div class="overflow-x-auto">
        <table class="w-full neo-table">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Invoice</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Items</th>
                    <th class="px-4 py-2 text-left">Total</th>
                    <th class="px-4 py-2 text-left">Payment</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentSales as $sale)
                <tr>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.sale.details', $sale->id) }}" class="font-semibold text-blue-700 hover:text-blue-900" style="text-decoration: underline;">
                            {{ $sale->invoice_number }}
                        </a>
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $sale->created_at->format('M d, Y H:i') }}</td>
                    <td class="px-4 py-2">
                        <span class="neo-badge" style="background: #e6f2ff; color: #003d7a;">
                            {{ $sale->items->count() }} items
                        </span>
                    </td>
                    <td class="px-4 py-2 font-semibold text-gray-900">${{ number_format($sale->total, 2) }}</td>
                    <td class="px-4 py-2">
                        <span class="neo-badge" style="background: #e6ffe6; color: #006400;">
                            {{ $sale->payment_method }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-inbox text-4xl text-gray-400 mb-2"></i>
                            <p class="font-medium text-gray-500 text-sm">No sales yet</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
