<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
    
        <div class="row">
            <!-- Earnings (Daily) -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Earnings (Daily)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ isset($totalDailySales) ? number_format($totalDailySales, 2) : '0.00' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Earnings (Weekly) -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Earnings (Weekly)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ isset($totalWeeklySales) ? number_format($totalWeeklySales, 2) : '0.00' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Earnings (Monthly) -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Earnings (Monthly)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ isset($totalMonthlySales) ? number_format($totalMonthlySales, 2) : '0.00' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    
            <!-- Earnings (Yearly) -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Earnings (Annual)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    ${{ isset($totalYearlySales) ? number_format($totalYearlySales, 2) : '0.00' }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>

          <!-- Notifications -->
    @if($newOrders->count())
    <audio id="orderSound" autoplay>
    <source src="{{ asset('sounds/order_notification.mp3') }}" type="audio/mpeg">
</audio>

    <div class="card mt-4">
        <div class="card-header bg-warning text-white">
            <strong>🛎 New Order Notifications</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Invoice No</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($newOrders as $index => $order)
                    <tr class="text-dark">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->invoice_no }}</td>
                        <td>
                            @if($order->customer)
                                {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                            @else
                                <span class="text-danger">No Customer</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $total = $order->sellDetail->sum(fn($item) => $item->price * $item->qty);
                            @endphp
                            ${{ number_format($total, 2) }}
                        </td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>
                            <form action="{{ url('/admin/accept-sell-order/'.$order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">✅ Accept</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div class="border rounded bg-light p-3 text-dark">
                                <strong style="font-size: 1.5rem;"> Order Items:</strong> {{-- Increase font size --}}
                                <div class="row mt-2">
                                    @foreach($order->sellDetail as $item)
                                        <div class="col-md-6">
                                            <div class="mb-2">
                                                <strong>+ Item: {{ $item->product->names ?? 'Product Deleted' }}</strong><br>
                                                - Qty: {{ $item->qty }}<br>
                                                - Price: ${{ number_format($item->price, 2) }}<br>
                                                - Subtotal: ${{ number_format($item->price * $item->qty, 2) }}<br>
                                                ______________________
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <script>
    let previousCount = {{ $newOrders->count() }};

    setInterval(() => {
        fetch("{{ url('/admin/check-new-orders') }}")
            .then(response => response.json())
            .then(data => {
                if (data.count > previousCount) {
                    previousCount = data.count;

                    if (orderSound) {
                        orderSound.play().catch(err => console.warn("Sound blocked:", err));
                    }

                    location.reload();
                }
            })
            .catch(error => console.error('Error checking new orders:', error));
    }, 10000); // Check every 10 seconds
</script>


</x-admin-layout>
