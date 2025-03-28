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
                            <th align="center">ល.រ</th>
                            <th align="center">ឈ្មោះផលិតផល</th>
                            <th align="center">តម្លៃ</th>
                            <th align="center">ចំនួន</th>
                            <th align="center">តម្លៃ</th>
                            <th align="center">#</th>
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
                                {{--                                @php $total += $details['price'] * $details['quantity'] @endphp--}}
                                <tr data-id="{{ $id }}">
                                    <td align="center">{!! $i !!}</td>
                                    <td data-th="Product" align="center">
                                    <td class="text-start">
                                        <div class="d-flex align-items-center">
                                            <img
                                                src="{{ isset($details['photo']) ? asset('storage/product/' . $details['photo']) : asset('images/default-product.png') }}"
                                                alt="{{ $details['name'] ?? 'Product image' }}"
                                                class="product-thumb me-3"
                                                width="80"
                                                height="80">
                                            <div>
                                                <strong>{{ $details['name'] ?? '' }}</strong><br>
                                                @if(!empty($details['variant_name'] ?? null))
                                                    <small
                                                        class="text-muted">Variant: {{ $details['variant_name'] }}</small>
                                                    <br>
                                                    <small
                                                        class="text-muted">Size: {{ $details['variant_size'] ?? '' }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    </td>
                                    <td data-th="Price" align="center">${{ $details['price'] }}</td>
                                    <td data-th="Quantity" align="center" width="25%">
                                        {!! Form::open(['route'=>'cart.update','id'=>'','method'=>'POST']) !!}
                                        <div class="input-group">
                <span class="input-group-prepend">
                    <button type="button" class="btn btn-outline-secondary btn-sm btn-number" disabled="disabled"
                            data-type="minus" data-field="quantity[{!! $id !!}]">
                        <span class="fa fa-minus"></span>
                    </button>
                </span>
                                            <input type="text" name="quantity[{!! $id !!}]"
                                                   class="form-control form-control-sm input-number text-center"
                                                   value="{{ $details['quantity'] }}" min="1" max="10">
                                            <span class="input-group-append">


                              <button type="submit"
                                      class="btn btn-primary btn-sm">
                                             Update
                                        </button>

                </span>
                                        </div>


                                        {!! Form::hidden('id',$id,['class'=>'form-control','id'=>'id']) !!}



                                        {!! Form::close() !!}
                                    </td>
                                    <td data-th="Subtotal" class="text-center" align="center">
                                        ${{ $details['price'] * $details['quantity'] }}</td>
                                    <td class="actions" data-th="" align="center">
                                        <button data-href="{!! route('cart.remove',$id) !!}"
                                                class="btn btn-danger btn-sm remove-from-cart"><i
                                                class="fas fa-trash-alt"></i></button>

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

                <div class="col-md-4">
                    <div class="trending-title">
                        <h1><i class="fas fa-window-maximize"></i> Order Summary</h1>
                    </div>
                    <?php

                    ?>
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td>Cart Total:</td>
                            <td>${!! number_format($total,2) !!}</td>
                        </tr>
                        <tr>
                            <td>Total Discount (<b>{!! $price['coupon_code'] ?? null !!}</b>):</td>
                            <td>
                                ${!!  isset($price['discount_price']) ? number_format($price['discount_price'],2): 0 !!}</td>
                        </tr>
                        <tr>
                            <td>Grand Total:</td>
                            <td>
                                ${!! isset($price['grand_total']) ?  number_format($price['grand_total'],2) : $total!!}</td>
                        </tr>
                    </table>

                    {{-- {!! Form::open(['route'=>'applyCouponCode']) !!}
                    <h4 class="coupon-title">Apply Coupon code</h4>
                    <div class="input-group mb-3">

                        <input type="text" class="form-control" placeholder="Coupon code"
                               aria-label="Recipient's username" name="coupon_code" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="input-group-text btn-apply" id="basic-addon2"><i
                                    class="far fa-check-circle"></i> Apply
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!} --}}
                    {!! Form::open(['route'=>'checkout.process']) !!}

                    @foreach($paymentMethods as $method)
                        <div class="form-check">
                            <input class="form-check-input payment_method_id " type="radio" name="payment_method_id"
                                   value="{!! $method->id !!}"
                                   id="{!! $method->id !!}" {!! $method->id==4? 'checked':null !!}>
                            <label class="form-check-label w-100" for="{!! $method->id !!}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="icon-box"
                                             style="background: url({!! asset('photo/'.$method->icon) !!})"></div>
                                    </div>
                                    <div class="col-md-9">
                                        <b>{!! $method->names !!}</b>
                                        <p>{!! $method->small_line !!}</p>
                                    </div>
                                </div>
                            </label>
                        </div>

                    @endforeach

                    <input type="hidden" value="1" name="table_id" id="table_id">
                    <input type="hidden" value="{!!  $total !!}" name="total" id="total">
                    <input type="hidden" value="{!!  isset($price['discount_price']) ? $price['discount_price']: 0 !!}"
                           name="discount" id="discount">
                    <input type="hidden" value="{!! isset($price['grand_total']) ?  $price['grand_total'] : $total !!} "
                           name="grand_total" id="grand_total">
                    <input type="hidden" value="{!! isset($price['coupon_id']) ?  $price['coupon_id'] : null !!} "
                           name="coupon_code_id" id="coupon_code_id">

                    <button class="btn btn-primary w-100" id="checkout" type="button"><i class="fas fa-check"></i>
                        Proceed to
                        checkout
                    </button>
                    {!! Form::close() !!}

                </div>
            </div>


        </div>
    </div>


    @include('frontend.cart.khqr')
    <x-slot name="script">

        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{!! asset('assets/khqr/khqr-1.0.16.min.js') !!}"></script>
        <script src="{!! asset('assets/khqr/request.js?v='.time()) !!}"></script>
        <script src="{!! asset('assets/khqr/khqr-form.js') !!}"></script>
        <script>
            $(document).ready(function () {
                var md5 = null;
                $('#checkout').on('click', function () {
                    var table_id = $('#table_id').val();
                    var grand_total = $('#grand_total').val();
                    var customer_id = $('#customer_id').val();
                    // var grand_total = 0.01;
                    // if (grand_total == 0) grand_total = 0.01;
                    grand_total=parseFloat(grand_total)
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
            });

            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }


        </script>

    </x-slot>
</x-app-layout>
