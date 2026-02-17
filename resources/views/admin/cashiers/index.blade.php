@extends('layouts.admin')

@section('title', 'Cashier Management')
@section('header', 'CASHIER MANAGEMENT')

@section('content')
<!-- Success/Error Messages -->
@if(session('success'))
<div class="neo-card mb-4" style="background: #e6ffe6; border-color: #006400;">
    <div class="p-4 flex items-center">
        <i class="fas fa-check-circle text-green-600 mr-3"></i>
        <span class="text-green-800 font-medium">{{ session('success') }}</span>
    </div>
</div>
@endif

@if(session('error'))
<div class="neo-card mb-4" style="background: #ffe6e6; border-color: #dc143c;">
    <div class="p-4 flex items-center">
        <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
        <span class="text-red-800 font-medium">{{ session('error') }}</span>
    </div>
</div>
@endif

<!-- Search and Filter Bar -->
<div class="neo-card mb-4">
    <div class="p-4">
        <form method="GET" action="{{ route('admin.cashiers') }}" class="flex flex-wrap gap-3">
            <div class="flex-1 min-w-[200px]">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search by name or email..." 
                       class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>
            
            <select name="role" class="px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500">
                <option value="">All Roles</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="cashier" {{ request('role') == 'cashier' ? 'selected' : '' }}>Cashier</option>
            </select>

            <select name="status" class="px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500">
                <option value="">All Status</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            
            <button type="submit" class="neo-button px-4 py-2">
                <i class="fas fa-search mr-2"></i>Search
            </button>
            
            <a href="{{ route('admin.cashiers') }}" class="neo-button px-4 py-2" style="background: #f0f0f0;">
                <i class="fas fa-redo mr-2"></i>Reset
            </a>

            <a href="{{ route('admin.cashiers.create') }}" class="neo-button px-4 py-2" style="background: linear-gradient(180deg, #90ee90 0%, #32cd32 100%);">
                <i class="fas fa-plus mr-2"></i>Add Cashier
            </a>
        </form>
    </div>
</div>

<!-- Cashiers Table -->
<div class="neo-card">
    <div class="classic-panel-header">
        Cashiers & Users
    </div>
    <div class="overflow-x-auto">
        <table class="w-full neo-table">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Role</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Created</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cashiers as $cashier)
                <tr>
                    <td class="px-4 py-2">
                        <div class="flex items-center">
                            @if($cashier->avatar)
                                <img src="{{ $cashier->avatar }}" alt="{{ $cashier->name }}" class="w-8 h-8 rounded-full mr-2">
                            @else
                                <div class="w-8 h-8 rounded-full mr-2 flex items-center justify-center" style="background: linear-gradient(180deg, #87ceeb 0%, #4682b4 100%);">
                                    <span class="text-white font-bold text-sm">{{ strtoupper(substr($cashier->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <span class="font-semibold text-gray-900">{{ $cashier->name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $cashier->email }}</td>
                    <td class="px-4 py-2">
                        <span class="neo-badge" style="background: {{ $cashier->role === 'admin' ? '#ffe6e6' : '#e6f2ff' }}; color: {{ $cashier->role === 'admin' ? '#8b0000' : '#003d7a' }};">
                            {{ ucfirst($cashier->role) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <span class="neo-badge" style="background: {{ $cashier->is_active ? '#e6ffe6' : '#f0f0f0' }}; color: {{ $cashier->is_active ? '#006400' : '#666' }};">
                            {{ $cashier->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $cashier->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-2">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.cashiers.edit', $cashier->id) }}" 
                               class="neo-button px-3 py-1 text-sm" 
                               style="background: linear-gradient(180deg, #ffd700 0%, #daa520 100%);">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            
                            @if($cashier->id !== auth()->id())
                            <form method="POST" 
                                  action="{{ route('admin.cashiers.delete', $cashier->id) }}" 
                                  onsubmit="return confirm('Are you sure you want to delete this cashier?');"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="neo-button px-3 py-1 text-sm" 
                                        style="background: linear-gradient(180deg, #ff6b6b 0%, #ee5a52 100%);">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-users text-4xl text-gray-400 mb-2"></i>
                            <p class="font-medium text-gray-500 text-sm">No cashiers found</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $cashiers->links() }}
</div>
@endsection
