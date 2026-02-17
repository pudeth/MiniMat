@extends('layouts.admin')

@section('title', 'Sale Details - ' . $sale->invoice_number)
@section('header', 'SALE DETAILS')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.sales') }}" class="text-blue-600 hover:text-blue-800">
        <i class="fas fa-arrow-left mr-2"></i>Back to Sales
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Sale Information -->
    <div class="lg:col-span-2">
        <div class="neo-card mb-6">
            <div class="classic-panel-header">
                Sale Information
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Invoice Number</p>
                        <p class="font-semibold text-lg">{{ $sale->invoice_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Date & Time</p>
                        <p class="font-semibold">{{ $sale->created_at->format('M d, Y H:i:s') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Cashier</p>
                        <p class="font-semibold">{{ $sale->user->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Payment Method</p>
                        <span class="neo-badge" style="background: #e6ffe6; color: #006400;">
                            {{ strtoupper($sale->payment_method) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        @if($sale->customer_name || $sale->customer_phone)
        <div class="neo-card mb-6">
            <div class="classic-panel-header">
                Customer Information
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    @if($sale->customer_name)
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-semibold">{{ $sale->customer_name }}</p>
                    </div>
                    @endif
                    @if($sale->customer_phone)
                    <div>
                        <p class="text-sm text-gray-600">Phone</p>
                        <p class="font-semibold">{{ $sale->customer_phone }}</p>
                    </div>
                    @endif
                    @if($sale->points_earned > 0)
                    <div>
                        <p class="text-sm text-gray-600">Points Earned</p>
                        <p class="font-semibold text-orange-600">
                            <i class="fas fa-star mr-1"></i>{{ $sale->points_earned }} points
                        </p>
                    </div>
                    @endif
                    @if($sale->points_redeemed > 0)
                    <div>
                        <p class="text-sm text-gray-600">Points Redeemed</p>
                        <p class="font-semibold text-blue-600">
                            <i class="fas fa-gift mr-1"></i>{{ $sale->points_redeemed }} points
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Items -->
        <div class="neo-card">
            <div class="classic-panel-header">
                Items ({{ $sale->items->count() }})
            </div>
            <div class="overflow-x-auto">
                <table class="w-full neo-table">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Product</th>
                            <th class="px-4 py-2 text-center">Quantity</th>
                            <th class="px-4 py-2 text-right">Price</th>
                            <th class="px-4 py-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->items as $item)
                        <tr>
                            <td class="px-4 py-2">
                                <div>
                                    <p class="font-semibold">{{ $item->product->name ?? 'Product Deleted' }}</p>
                                    @if($item->product && $item->product->name_kh)
                                    <p class="text-sm text-gray-600 khmer-small">{{ $item->product->name_kh }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-2 text-center">{{ $item->quantity }}</td>
                            <td class="px-4 py-2 text-right">${{ number_format($item->price, 2) }}</td>
                            <td class="px-4 py-2 text-right font-semibold">${{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Summary -->
    <div class="lg:col-span-1">
        <div class="neo-card sticky top-4">
            <div class="classic-panel-header">
                Summary
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-semibold">${{ number_format($sale->subtotal, 2) }}</span>
                    </div>
                    
                    @if($sale->discount > 0)
                    <div class="flex justify-between text-red-600">
                        <span>Discount</span>
                        <span class="font-semibold">-${{ number_format($sale->discount, 2) }}</span>
                    </div>
                    @endif
                    
                    @if($sale->points_discount > 0)
                    <div class="flex justify-between text-blue-600">
                        <span>Points Discount</span>
                        <span class="font-semibold">-${{ number_format($sale->points_discount, 2) }}</span>
                    </div>
                    @endif
                    
                    <div class="border-t pt-3 flex justify-between text-lg">
                        <span class="font-bold">Total</span>
                        <span class="font-bold text-green-600">${{ number_format($sale->total, 2) }}</span>
                    </div>
                </div>

                @if($sale->payment)
                <div class="mt-6 pt-6 border-t">
                    <h4 class="font-semibold mb-3">Payment Details</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status</span>
                            <span class="neo-badge {{ $sale->payment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($sale->payment->status) }}
                            </span>
                        </div>
                        @if($sale->payment->transaction_id)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Transaction ID</span>
                            <span class="font-mono text-xs">{{ $sale->payment->transaction_id }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
