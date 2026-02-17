@extends('layouts.admin')

@section('title', 'Edit Cashier')
@section('header', 'EDIT CASHIER')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="neo-card">
        <div class="classic-panel-header">
            Edit Cashier Information
        </div>
        
        <form method="POST" action="{{ route('admin.cashiers.update', $cashier->id) }}" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Name -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-user mr-1"></i>Full Name
                </label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name', $cashier->name) }}"
                       required
                       class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-envelope mr-1"></i>Email Address
                </label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email', $cashier->email) }}"
                       required
                       class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-user-tag mr-1"></i>Role
                </label>
                <select name="role" 
                        required
                        class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('role') border-red-500 @enderror">
                    <option value="cashier" {{ old('role', $cashier->role) === 'cashier' ? 'selected' : '' }}>Cashier</option>
                    <option value="admin" {{ old('role', $cashier->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-toggle-on mr-1"></i>Status
                </label>
                <select name="is_active" 
                        required
                        class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('is_active') border-red-500 @enderror">
                    <option value="1" {{ old('is_active', $cashier->is_active) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $cashier->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('is_active')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password (Optional) -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-lock mr-1"></i>New Password (Leave blank to keep current)
                </label>
                <input type="password" 
                       name="password" 
                       class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-lock mr-1"></i>Confirm New Password
                </label>
                <input type="password" 
                       name="password_confirmation" 
                       class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <button type="submit" class="neo-button px-6 py-2" style="background: linear-gradient(180deg, #90ee90 0%, #32cd32 100%);">
                    <i class="fas fa-save mr-2"></i>Save Changes
                </button>
                
                <a href="{{ route('admin.cashiers') }}" class="neo-button px-6 py-2" style="background: #f0f0f0;">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Additional Info Card -->
    <div class="neo-card mt-4">
        <div class="p-4">
            <h3 class="font-semibold text-gray-700 mb-2">
                <i class="fas fa-info-circle mr-2"></i>Account Information
            </h3>
            <div class="text-sm text-gray-600 space-y-1">
                <p><strong>Account Created:</strong> {{ $cashier->created_at->format('F d, Y H:i') }}</p>
                <p><strong>Last Updated:</strong> {{ $cashier->updated_at->format('F d, Y H:i') }}</p>
                @if($cashier->google_id)
                    <p><strong>Google OAuth:</strong> Connected</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
