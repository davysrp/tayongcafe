<x-app-layout>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="fas fa-shopping-cart me-2"></i> Your Shopping Cart</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th width="35%">Product</th>
                                    <th width="15%" class="text-center">Price</th>
                                    <th width="20%" class="text-center">Quantity</th>
                                    <th width="15%" class="text-center">Subtotal</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0; ?>
                                @if(session('cart'))
                                    <?php
                                    $card = session('cart');
                                    $price = session('price_cart');
                                    $i = 1;
                                    ?>
                                    @foreach(session('cart') as $id => $details)
                                        <tr data-id="{{ $id }}" class="cart-item">
                                            <td class="text-center">{!! $i !!}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img
                                                        src="{{ isset($details['photo']) ? asset('storage/product/' . $details['photo']) : asset('images/default-product.png') }}"
                                                        alt="{{ $details['name'] ?? 'Product image' }}"
                                                        class="rounded me-3"
                                                        width="60"
                                                        height="60">
                                                    <div>
                                                        <h6 class="mb-1">{{ $details['name'] ?? '' }}</h6>
                                                        @if(!empty($details['variant_name'] ?? null))
                                                            <small
                                                                class="text-muted d-block">Variant: {{ $details['variant_name'] }}</small>
                                                            <small
                                                                class="text-muted">Size: {{ $details['variant_size'] ?? '' }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">${{ number_format($details['price'], 2) }}</td>
                                            <td>
                                                {!! Form::open(['route'=>'cart.update', 'method'=>'POST', 'class'=>'mb-0 update-form']) !!}
                                                <div class="input-group input-group-sm">
                                                    <button type="button" class="btn btn-outline-secondary btn-number"
                                                            data-type="minus" data-id="{{ $id }}">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="number" name="quantity"
                                                           class="form-control form-control-sm input-number text-center"
                                                           value="{{ $details['quantity'] }}" min="1" max="10">
                                                    <button type="button" class="btn btn-outline-primary btn-number"
                                                            data-type="plus" data-id="{{ $id }}">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                {!! Form::hidden('id', $id) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td class="text-center subtotal" data-th="Subtotal">
                                                ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                            </td>


                                            {{-- <td class="text-center">
                                                <button class="btn btn-danger btn-sm remove-from-cart"
                                                        data-id="{{ $id }}"
                                                        data-url="{{ route('cart.remove') }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td> --}}

                                            <td class="text-center">
                                                <button type="button"
                                                        class="btn-delete remove-from-cart"
                                                        data-id="{{ $id }}"
                                                        data-url="{{ route('cart.remove') }}">
                                                    <img src="{{ asset('assets/img/delete.png') }}" width="30"
                                                         height="30" alt="Delete">
                                                </button>
                                            </td>

                                        </tr>
                                        <?php
                                        $total = $total + ($details['price'] * $details['quantity']);
                                        $i++ ?>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="fas fa-receipt me-2"></i> Order Summary</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <strong>$<span id="cart-subtotal">{{ number_format($total, 2) }}</span></strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Discount ({!! $price['coupon_code'] ?? 'No coupon' !!}):</span>
                            <strong class="text-danger">-$<span
                                    id="cart-discount">{{ isset($price['discount_price']) ? number_format($price['discount_price'], 2) : '0.00' }}</span></strong>
                        </div>
                        <hr>

                    {{-- <div class="d-flex justify-content-between mb-3">
                        <span class="h5">Total:</span>
                        <span class="h5 text-primary">
                            <strong>$<span id="grand-total">{{ isset($price['grand_total']) ? number_format($price['grand_total'], 2) : number_format($total, 2) }}</span></strong>
                        </span>
                    </div> --}}

                    <!-- In your order summary section -->
                        <div class="d-flex justify-content-between mb-3">
                            <span class="h5">Total:</span>
                            <span class="h5 text-primary">
        <strong>$<span id="grand-total">{{ number_format($total, 2) }}</span></strong>
    </span>
                        </div>

                        <!-- Cart count badge somewhere in your layout -->
                        <span id="cart-count" class="badge bg-primary">
    {{ count(session('cart', [])) }}
</span>


                        {!! Form::open(['route'=>'checkout.process', 'class'=>'mt-4','id'=>'CheckoutForm']) !!}
{{--                        <form class="mt-4" id="CheckoutForm" >--}}
                        <h5 class="mb-3"><i class="fas fa-credit-card me-2"></i> Payment Method</h5>

                        <div class="list-group mb-4">
                            @foreach($paymentMethods as $method)
                                <label class="list-group-item list-group-item-action rounded mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <input class="form-check-input me-1 payment_method_id" type="radio"
                                                   name="payment_method_id" value="{!! $method->id !!}"
                                                {!! $method->id==4? 'checked':null !!}>
                                        </div>
                                        <img src="{!! asset('photo/'.$method->icon) !!}" alt="{!! $method->names !!}"
                                             width="40" class="me-3">
                                        <div>
                                            <h6 class="mb-1">{!! $method->names !!}</h6>
                                            <small class="text-muted">{!! $method->small_line !!}</small>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <input type="hidden" value="1" name="table_id" id="table_id">
                        <input type="hidden" value="{!! $total !!}" name="total" id="total">
                        <input type="hidden"
                               value="{!! isset($price['discount_price']) ? $price['discount_price']: 0 !!}"
                               name="discount" id="discount">
                        <input type="hidden"
                               value="{!! isset($price['grand_total']) ? $price['grand_total'] : $total !!}"
                               name="grand_total" id="grand_total">
                        <input type="hidden" value="{!! isset($price['coupon_id']) ? $price['coupon_id'] : null !!}"
                               name="coupon_code_id" id="coupon_code_id">

                        <button class="btn btn-primary btn-lg w-100 py-3"  type="submit">
                            <i class="fas fa-check-circle me-2"></i> Proceed to Checkout
                        </button>

                        {{-- <div class="text-end mt-3">
                            <h5><strong>Total:</strong> $<span id="total-amount">{{ number_format($total, 2) }}</span></h5>
                            <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
                        </div> --}}

{{--                        </form>--}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
        <style>
            .cart-item:hover {
                background-color: #f8f9fa;
            }
            .card {
                border-radius: 10px;
                overflow: hidden;
            }
            .card-header {
                border-radius: 0 !important;
            }
            .table th {
                border-top: none;
            }
            .input-group-sm {
                width: 120px;
            }
            .list-group-item {
                cursor: pointer;
            }
            .list-group-item:hover {
                background-color: #f8f9fa;
            }
            .form-check-input:checked + .list-group-item {
                border-color: #0d6efd;
                background-color: #f0f7ff;
            }


            .btn-delete {

                background: none;
                border: none;
                padding: 0;
                cursor: pointer;
            }

            .btn-delete img {
                transition: transform 0.2s;
            }

            .btn-delete:hover img {
                transform: scale(1.1);
            }



        </style> --}}
    @include('frontend.cart.khqr')
    <x-slot name="script">

        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{!! asset('assets/khqr/khqr-1.0.16.min.js') !!}"></script>
        <script src="{!! asset('assets/khqr/request.js?v='.time()) !!}"></script>
        <script src="{!! asset('assets/khqr/khqr-form.js') !!}"></script>
        <script>
            $(document).ready(function () {
                var md5 = null;
               /* $('#checkout').on('click', function () {
                    var table_id = $('#table_id').val();
                    var grand_total = $('#grand_total').val();
                    var customer_id = $('#customer_id').val();
                    // var grand_total = 0.01;
                    // if (grand_total == 0) grand_total = 0.01;
                    grand_total = parseFloat(grand_total)
                    var merchantInfoData = null
                    var optionalData_ = null
                    $('.home-amount').val(grand_total)
                    const paymentMethod = $('input[name="payment_method_id"]:checked').val();
                    if (paymentMethod) {
                        if (confirm("Are you sure want to checkout?") == true) {
                            $.get("{!! route('getPaymentMethodUser') !!}", {id: paymentMethod}, function (data) {
                                if (data.success == true) {
                                    token = data.data.method.token;
                                    merchantInfoData = data.data.merchantInfoData;
                                    optionalData_ = data.data.optionalData_;
                                }
                            });

                            sleep(1000).then(() => {
                                var orderLink = "{!! route('checkout.process') !!}";
                                var orderData = {
                                    payment_method_id: paymentMethod,
                                    invoice_no: optionalData_.billNumber,
                                    customer_id: customer_id,
                                    table_id: table_id,
                                    is_order: paymentMethod === 1 ? 0 : 1,
                                };

                                if (paymentMethod == 1) {

                                    $('.home-amount').text(grand_total);
                                    var qrData = generateKhqr(grand_total, merchantInfoData, optionalData_);
                                    var qrUrl = generateQRCode(qrData.qr)
                                    console.log(grand_total);
                                    md5 = qrData.md5
                                    $('#qrCode').attr('src', qrUrl)
                                    $('body').addClass("modal-show");
                                    $('#KHqrModal').modal('show')
                                    updateCountdown(180);
                                    // Call the function to initiate the process
                                    checkTransactionData(md5, orderData, optionalData_.billNumber);
                                } else {

                                    checkTransactionData(md5, orderData, optionalData_.billNumber);
                                }
                            });
                        }

                    } else {
                        // alert('Please select Payment method before confirm payment')
                        alert('Please select Payment method before confirm payment')
                    }

                });*/


                $('#CheckoutForm').on('submit', function (e) {
                    e.preventDefault(); // Stop form from submitting normally
                    var formData = $(this).serialize();
                    /*$.post('{!! route('checkTransactionOrderUser') !!}', formData,function () {

                    })
                        .done(function (data) {
                            $('#response').html('<p style="color:green;">' + data.message + '</p>');
                        })
                        .fail(function (xhr) {
                            let errorMsg = xhr.responseJSON?.message || 'Something went wrong!';
                            $('#response').html('<p style="color:red;">' + errorMsg + '</p>');
                        });*/
                    var table_id = $('#table_id').val();
                    var grand_total = $('#grand_total').val();
                    var customer_id = $('#customer_id').val();
                    // var grand_total = 0.01;
                    // if (grand_total == 0) grand_total = 0.01;
                    grand_total = parseFloat(grand_total)
                    var merchantInfoData = null
                    var optionalData_ = null
                    $('.home-amount').val(grand_total)
                    const paymentMethod = $('input[name="payment_method_id"]:checked').val();
                    if (paymentMethod) {
                        if (confirm("Are you sure want to checkout?") == true) {
                            $.get("{!! route('getPaymentMethodUser') !!}", {id: paymentMethod}, function (data) {
                                if (data.success == true) {
                                    token = data.data.method.token;
                                    merchantInfoData = data.data.merchantInfoData;
                                    optionalData_ = data.data.optionalData_;
                                }
                            });

                            sleep(1000).then(() => {
                                var orderLink = "{!! route('checkout.process') !!}";
                                var orderData = {
                                    payment_method_id: paymentMethod,
                                    invoice_no: optionalData_.billNumber,
                                    customer_id: customer_id,
                                    table_id: table_id,
                                    is_order: paymentMethod === 1 ? 0 : 1,
                                };

                                if (paymentMethod == 1) {

                                    $('.home-amount').text(grand_total);
                                    var qrData = generateKhqr(grand_total, merchantInfoData, optionalData_);
                                    var qrUrl = generateQRCode(qrData.qr)
                                    console.log(grand_total);
                                    md5 = qrData.md5
                                    $('#qrCode').attr('src', qrUrl)
                                    $('body').addClass("modal-show");
                                    $('#KHqrModal').modal('show')
                                    updateCountdown(180);
                                    // Call the function to initiate the process
                                    checkTransactionData(md5, orderData, optionalData_.billNumber);
                                } else {

                                    checkTransactionData(md5, orderData, optionalData_.billNumber);
                                }
                            });
                        }

                    } else {
                        // alert('Please select Payment method before confirm payment')
                        alert('Please select Payment method before confirm payment')
                    }
                });


                function checkTransactionData(md5, orderData, inv) {
                    let intervalId;

                    function refresh() {
                        $.post("{!! route('checkTransactionOrderUser') !!}", {
                            md5: md5,
                            payment_method_id: orderData.payment_method_id,
                            orderData: orderData
                        }, function (data) {
                            if (data.success == true) {
                                $('#KHqrModal').modal('hide');
                                clearInterval(intervalId);
                            }
                        });
                    }

                    intervalId = setInterval(refresh, 500);
                }
            })
            ;

            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }


        </script>

    </x-slot>
</x-app-layout>
