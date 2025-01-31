<div class="form-group">
    <label for="coupon_name">Coupon Name</label>
    <input type="text" name="coupon_name" class="form-control" value="{{ $coupon->coupon_name ?? old('coupon_name') }}" required>
</div>
<div class="form-group">
    <label for="coupon_code">Coupon Code</label>
    <input type="text" name="coupon_code" class="form-control" value="{{ $coupon->coupon_code ?? old('coupon_code') }}" required>
</div>
<div class="form-group">
    <label for="percentage">Percentage</label>
    <input type="number" step="0.01" name="percentage" class="form-control" value="{{ $coupon->percentage ?? old('percentage') }}" required>
</div>
<div class="form-group">
    <label for="expired_date">Expired Date</label>
    <input type="date" name="expired_date" class="form-control" value="{{ $coupon->expired_date ?? old('expired_date') }}" required>
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select name="status" class="form-control">
        <option value="active" {{ (isset($coupon) && $coupon->status == 'active') ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ (isset($coupon) && $coupon->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
