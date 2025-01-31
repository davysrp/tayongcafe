<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Coupon Code') }}
        </h2>
    </x-slot>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('coupon-code.update', $coupon->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="coupon_name">Coupon Name</label>
                    <input type="text" name="coupon_name" class="form-control" value="{{ $coupon->coupon_name }}" required>
                </div>

                <div class="form-group">
                    <label for="coupon_code">Coupon Code</label>
                    <input type="text" name="coupon_code" class="form-control" value="{{ $coupon->coupon_code }}" required>
                </div>

                <div class="form-group">
                    <label for="percentage">Percentage</label>
                    <input type="number" step="0.01" name="percentage" class="form-control" value="{{ $coupon->percentage }}" required>
                </div>

                <div class="form-group">
                    <label for="discount_cap">Discount Cap</label>
                    <input type="number" step="0.01" name="discount_cap" class="form-control" value="{{ $coupon->discount_cap }}">
                </div>

                <div class="form-group">
                    <label for="max_use">Max Use</label>
                    <input type="number" name="max_use" class="form-control" value="{{ $coupon->max_use }}">
                </div>

                <div class="form-group">
                    <label for="use_per_customer">Use Per Customer</label>
                    <input type="number" name="use_per_customer" class="form-control" value="{{ $coupon->use_per_customer }}">
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $coupon->start_date }}" required>
                </div>

                <div class="form-group">
                    <label for="expired_date">Expired Date</label>
                    <input type="date" name="expired_date" class="form-control" value="{{ $coupon->expired_date }}" required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active" {{ $coupon->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $coupon->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('coupon-code.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</x-admin-layout>
