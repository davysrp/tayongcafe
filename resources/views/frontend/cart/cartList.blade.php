<x-app-layout>
    <div class="container">
        <div class="product-wrap">
            <div class="row">
                <div class="col-md-8">
                    <div class="trending-title">
                        <h1><i class="fas fa-cart-plus"></i> Cart List</h1>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                                $i = 1;
                            @endphp

                            @if(session('cart') && is_array(session('cart')))
                            @foreach(session('cart') as $id => $details)
                                @if($details && isset($details['name']))
                                    <tr data-id="{{ $id }}">
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td data-th="Product" align="center">
                                            <div class="row product-cart">
                                                <div class="col-sm-4 hidden-xs">
                                                    <div class="cart-thumb"
                                                         style="background: url({{ isset($details['photo']) ? asset('uploads/'.$details['photo']) : '' }})">
                                                    </div>
                                                </div>
                                                <div class="col-sm-8 text-start">
                                                    <p class="nomargin">{{ $details['name'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-th="Price" align="center">${{ $details['price'] }}</td>
                                        <td data-th="Quantity" align="center" width="25%">
                                            {!! Form::open(['route' => 'updateCart', 'method' => 'POST']) !!}
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-number" disabled
                                                            data-type="minus" data-field="quantity[{{ $id }}]">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </span>
                                                <input type="text" name="quantity[{{ $id }}]" class="form-control form-control-sm input-number text-center"
                                                       value="{{ $details['quantity'] }}" min="1" max="10">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="plus"
                                                            data-field="quantity[{{ $id }}]">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                </span>
                                            </div>
                                            {!! Form::close() !!}
                                        </td>
                                        <td data-th="Subtotal" align="center">
                                            ${{ $details['price'] * $details['quantity'] }}
                                        </td>
                                        <td class="actions" align="center">
                                            <button data-href="{{ route('removeFromCart', $id) }}" class="btn btn-danger btn-sm remove-from-cart">
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" align="center">Your cart is empty.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="col-md-4">
                    <div class="trending-title">
                        <h1><i class="fas fa-window-maximize"></i> Order Summary</h1>
                    </div>

                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td>Cart Total:</td>
                            <td>${{ number_format($total, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Total Discount (<b>{{ $price['coupon_code'] ?? 'N/A' }}</b>):</td>
                            <td>${{ isset($price['discount_price']) ? number_format($price['discount_price'], 2) : '0.00' }}</td>
                        </tr>
                        <tr>
                            <td>Grand Total:</td>
                            <td>${{ isset($price['grand_total']) ? number_format($price['grand_total'], 2) : number_format($total, 2) }}</td>
                        </tr>
                    </table>

                    {!! Form::open(['route' => 'applyCouponCode', 'method' => 'POST']) !!}
                    <h4 class="coupon-title">Apply Coupon Code</h4>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Coupon code" name="coupon_code">
                        <div class="input-group-append">
                            <button class="input-group-text btn-apply" type="submit">
                                <i class="far fa-check-circle"></i> Apply
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                    {!! Form::open(['route' => 'placeOrder']) !!}
                    @if(isset($paymentMethod) && $paymentMethod->count() > 0)
                        @foreach($paymentMethod as $method)
                            <div class="form-check">
                                <input class="form-check-input payment_method_id" type="radio" name="payment_method_id"
                                       value="{{ $method->id }}" id="{{ $method->id }}" {{ $method->id == 4 ? 'checked' : '' }}>
                                <label class="form-check-label w-100" for="{{ $method->id }}">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="icon-box"
                                                 style="background: url({{ asset('photo/'.$method->icon) }})"></div>
                                        </div>
                                        <div class="col-md-9">
                                            <b>{{ $method->names }}</b>
                                            @if($method->id == 4)
                                                <p>Your account balance is: ${{ number_format($balance->balance, 2) }}</p>
                                            @else
                                                <p>{{ $method->small_line }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    @else
                        <p>No payment methods available.</p>
                    @endif

                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="discount" value="{{ $price['discount_price'] ?? 0 }}">
                    <input type="hidden" name="grand_total" value="{{ $price['grand_total'] ?? $total }}">
                    <input type="hidden" name="coupon_code_id" value="{{ $price['coupon_id'] ?? null }}">
                    <button class="btn btn-checkout" id="checkout" type="button">
                        <i class="fas fa-check"></i> Proceed to Checkout
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Modals and Scripts -->
    <div class="khqr-form">
        <!-- KHQR Modal Content Here -->
    </div>

    <div class="modal fade" id="qtyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Quantity Modal Content Here -->
    </div>

    <x-slot name="script">
        <script src="{!! asset('frontend__/khqr/khqr-1.0.16.min.js') !!}"></script>
        <script src="{!! asset('frontend__/khqr/request.js') !!}"></script>
        <script src="{!! asset('frontend__/khqr/khqr-form.js') !!}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function () {
                var token = null
                var merchantInfoData = null;
                var optionalData_ = null;

                $('.payment_method_id').on('change', function () {
                    var id = $(this).val();
                    $.get("{!! route('getPaymentMethod') !!}", {id: id}, function (data) {
                        if (data.success == true) {
                            token = data.data.method.token;
                            merchantInfoData = data.data.merchantInfoData;
                            optionalData_ = data.data.optionalData_;
                        }
                    });
                    setTimeout(function () {
                        // console.log(token);
                    }, 1000); // 1000 milliseconds = 1 second
                })
                $(document).delegate('.update-from-cart', 'click', function () {
                    var id = $(this).data('id');
                    var qty = $(this).data('quantity');
                    $('#qtyModal').modal('show');
                    $('#id').val(id);
                    $('#quantity').val(qty);
                })
                $(document).delegate('.remove-from-cart', 'click', function () {
                    var link = $(this).data('href');
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.get(link, function (data) {
                                if (data) {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    });
                                    location.reload();
                                }
                            })

                        }
                    });
                });


                $(document).ready(function () {
                    var md5 = null;
                    $('#checkout').on('click', function () {
                        var paymentMethod = $('.payment_method_id:checked').val();
                        var grand_total = $('#grand_total').val();

                        $.get("{!! route('getPaymentMethod') !!}", {id: paymentMethod}, function (data) {
                            if (data.success == true) {
                                token = data.data.method.token;
                                merchantInfoData = data.data.merchantInfoData;
                                optionalData_ = data.data.optionalData_;
                            }
                        });


                        if (paymentMethod) {
                            Swal.fire({
                                title: "Continue to checkout?",
                                // text: "You won't be able to revert this!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes!"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    var orderLink = "{!! route('placeOrder') !!}";

                                    var orderData = {
                                        total: $('#total').val(),
                                        discount: $('#discount').val(),
                                        grand_total: $('#grand_total').val(),
                                        payment_method_id: paymentMethod,
                                        coupon_code_id: $('#coupon_code_id').val(),
                                        invoice_no: optionalData_.billNumber,
                                        customer: {!! Auth::guard('seller')->user()->id !!},
                                    };
                                    if (paymentMethod == 4) {


                                        /*Show Loading */
                                        let timerInterval;
                                        Swal.fire({
                                            title: "ការទិញកំពុងដំណើរការ!",
                                            timer: 2000,
                                            timerProgressBar: true,
                                            didOpen: () => {
                                                Swal.showLoading();
                                                const timer = Swal.getPopup().querySelector("b");
                                                timerInterval = setInterval(() => {
                                                    timer.textContent = `${Swal.getTimerLeft()}`;
                                                }, 100);
                                            },
                                            willClose: () => {
                                                clearInterval(timerInterval);
                                            }
                                        })


                                        $.post(orderLink, orderData, function (data) {
                                            if (data.success == true) {
                                                window.location = "{!! route('khqrPaymentSuccess') !!}?invoice=" + optionalData_.billNumber;
                                            }
                                        })
                                    }
                                    if (paymentMethod == 1) {
                                        $('.home-amount').text(grand_total);
                                        var qrData = generateKhqr(parseFloat(grand_total), merchantInfoData, optionalData_, orderData, orderLink);
                                        var qrUrl = generateQRCode(qrData.qr)
                                        md5 = qrData.md5
                                        $('#qrCode').attr('src', qrUrl)
                                        $('body').addClass("modal-show");
                                        updateCountdown(180);
                                        // Call the function to initiate the process
                                        checkTransactionData(md5, orderData, optionalData_.billNumber);
                                    }
                                }
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                icon: 'error',
                                title: 'Please select payment method',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                        }


                    });

                    $('.close-modal').on('click', function () {
                        $('body').removeClass("modal-show");
                        $('.home-minutes').text(180);
                    });


                    function checkTransactionData(md5, orderData, inv) {
                        let intervalId;

                        function refresh() {
                            $.post("{!! route('checkTransactionOrder') !!}", {
                                md5: md5,
                                payment_method_id: orderData.payment_method_id,
                                orderData: orderData
                            }, function (data) {
                                if (data.success == true) {
                                    window.location = "{!! route('khqrPaymentSuccess') !!}?invoice=" + inv;
                                    clearInterval(intervalId);
                                }
                            });
                        }

                        intervalId = setInterval(refresh, 5000);
                    }
                });

                $('.btn-number').click(function(e){
                    e.preventDefault();

                    fieldName = $(this).attr('data-field');
                    type      = $(this).attr('data-type');
                    var input = $("input[name='"+fieldName+"']");
                    var currentVal = parseInt(input.val());
                    if (!isNaN(currentVal)) {
                        if(type == 'minus') {

                            if(currentVal > input.attr('min')) {
                                input.val(currentVal - 1).change();
                            }
                            if(parseInt(input.val()) == input.attr('min')) {
                                $(this).attr('disabled', true);
                            }

                        } else if(type == 'plus') {

                            if(currentVal < input.attr('max')) {
                                input.val(currentVal + 1).change();
                            }
                            if(parseInt(input.val()) == input.attr('max')) {
                                $(this).attr('disabled', true);
                            }

                        }
                    } else {
                        input.val(0);
                    }
                });
                $('.input-number').focusin(function(){
                    $(this).data('oldValue', $(this).val());
                });
                $('.input-number').change(function() {

                    minValue =  parseInt($(this).attr('min'));
                    maxValue =  parseInt($(this).attr('max'));
                    valueCurrent = parseInt($(this).val());

                    name = $(this).attr('name');
                    if(valueCurrent >= minValue) {
                        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
                    } else {
                        alert('Sorry, the minimum value was reached');
                        $(this).val($(this).data('oldValue'));
                    }
                    if(valueCurrent <= maxValue) {
                        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
                    } else {
                        alert('Sorry, the maximum value was reached');
                        $(this).val($(this).data('oldValue'));
                    }


                });
                $(".input-number").keydown(function (e) {
                    // Allow: backspace, delete, tab, escape, enter and .
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                        // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true) ||
                        // Allow: home, end, left, right
                        (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });

            });
        </script>
    </x-slot>
</x-app-layout>
