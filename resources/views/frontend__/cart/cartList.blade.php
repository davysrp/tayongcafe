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
                            <th align="center">No</th>
                            <th align="center">Product Name</th>
                            <th align="center">Price</th>
                            <th align="center">Qty</th>
                            <th align="center">Total</th>
                            <th align="center">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total = 0; ?>
                        @if(session('cart'))
                            <?php
                            $price = session('price_cart');
                            $i = 1;

                            ?>
                            @foreach(session('cart') as $id => $details)
                                {{--                                @php $total += $details['price'] * $details['quantity'] @endphp--}}
                                <tr data-id="{{ $id }}">
                                    <td align="center">{!! $i !!}</td>
                                    <td data-th="Product" align="center">
                                        <div class="row product-cart">
                                            <div class="col-sm-4 hidden-xs">
                                                <div class="cart-thumb"
                                                     style="background: url({!! isset($details['photo']) ? asset('uploads/'.$details['photo']) :'' !!})"></div>
                                            </div>
                                            <div class="col-sm-8 text-start">
                                                <p class="nomargin">{{ isset($details['name']) ?$details['name'] : '' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price" align="center">${{ $details['price'] }}</td>
                                    <td data-th="Quantity" align="center" width="25%">
                                        {!! Form::open(['route'=>'updateCart','id'=>'','method'=>'POST']) !!}
                                        <div class="input-group">
                <span class="input-group-prepend">
                    <button type="button" class="btn btn-outline-secondary btn-sm btn-number" disabled="disabled"
                            data-type="minus" data-field="quantity[{!! $id !!}]" data-stock="{!! $details['product_stock'] !!}">
                        <span class="fa fa-minus"></span>
                    </button>
                </span>
                                            <input type="text" name="quantity[{!! $id !!}]" class="form-control form-control-sm input-number text-center"
                                                   value="{{ $details['quantity'] }}" min="1" max="10">
                                            <span class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary btn-sm btn-number" data-type="plus"
                            data-field="quantity[{!! $id !!}]" data-stock="{!! $details['product_stock'] !!}">
                        <span class="fa fa-plus"></span>
                    </button>

                              <button type="submit"
                                      class="btn btn-primary btn-sm">
                                             Update
                                        </button>

                </span>
                                        </div>


                                        @if($details['is_product_stock'])
                                            @if($details['product_stock']<=$details['quantity'])
                                                <small
                                                    class="text-danger">នៅសល់ក្នុងស្តុក {!! $details['product_stock'] !!}</small>
                                            @endif
                                        @endif


                                        {!! Form::hidden('id',$id,['class'=>'form-control','id'=>'id']) !!}
                                        {!! Form::hidden('is_product_stock',$details['is_product_stock'],['class'=>'form-control','id'=>'id']) !!}
                                        {!! Form::hidden('product_stock',$details['product_stock'],['class'=>'form-control','id'=>'id']) !!}

                                        {!! Form::close() !!}
                                    </td>
                                    <td data-th="Subtotal" class="text-center" align="center">
                                        ${{ $details['price'] * $details['quantity'] }}</td>
                                    <td class="actions" data-th="" align="center">
                                        <button data-href="{!! route('removeCart',$id) !!}"
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
                    $cart = collect(session('cart'))->sum('total');

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

                    {!! Form::open(['route'=>'applyCouponCode']) !!}
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
                    {!! Form::close() !!}
                    {!! Form::open(['route'=>'placeOrder']) !!}

                    @foreach($paymentMethod as $method)
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
                                        @if($method->id==4)
                                            <p>You account balance is: ${!! number_format($balance->balance,2) !!}</p>
                                        @else
                                            <p>{!! $method->small_line !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </label>
                        </div>

                    @endforeach

                    <input type="hidden" value="{!!  $total !!}" name="total" id="total">
                    <input type="hidden" value="{!!  isset($price['discount_price']) ? $price['discount_price']: 0 !!}"
                           name="discount" id="discount">
                    <input type="hidden" value="{!! isset($price['grand_total']) ?  $price['grand_total'] : $total !!} "
                           name="grand_total" id="grand_total">
                    <input type="hidden" value="{!! isset($price['coupon_id']) ?  $price['coupon_id'] : null !!} "
                           name="coupon_code_id" id="coupon_code_id">
                    {{--  <button class="btn btn-checkout" type="submit"><i class="fas fa-check"></i> Proceed to checkout
                      </button>--}}
                    <button class="btn btn-checkout" id="checkout" type="button"><i class="fas fa-check"></i> Proceed to
                        checkout
                    </button>
                    {!! Form::close() !!}

                </div>
            </div>


        </div>
    </div>
    <div class="khqr-form">
        <div id="custom-modal" class="custom-modal">
            <div class="custom-modal-dialog">
                <div class="custom-modal-content">
                    <span class="close-modal"><i class="fas fa-times"></i></span>
                    <div class="custom-modal-body">
                        <div class="custom-modal-inner">
                            <div class="row">
                                <div class="col">
                                    <div class="home-container1">
                                        <div class="home-bodyqr">
                                            <span class="home-currency">$</span>
                                            <span class="home-amount">22</span>
                                            <span class="home-name"><span>KHMMO.COM</span>
                                          <br/>
                                          <br/>
                                        </span>
                                            <div class="home-container2 triangle-left"></div>
                                            <div class="home-container3">
                                                <img
                                                    alt="image"
                                                    src="https://checkout.payway.com.kh/images/khqr-icon.svg"
                                                    class="home-logo"
                                                />
                                            </div>
                                            <div class="home-container4"></div>
                                            <div class="home-qrcode">
                                                <img alt="image" class="home-image" id="qrCode"/>
                                                <img
                                                    alt="image"
                                                    src="https://checkout.payway.com.kh/images/usd-khqr-logo.svg"
                                                    class="home-image1"
                                                />
                                            </div>
                                        </div>
                                        <div class="minutes">
                                            <img src="https://checkout.payway.com.kh/images/loading.svg" alt="image"
                                                 class="home-loading">
                                            <span class="home-minutes"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <h5>How to make the payment?</h5>
                                    <ul>
                                        <ol>1.Open Bakong App</ol>
                                        <ol>2.Tab "QR pay"</ol>
                                        <ol>3.Scan</ol>
                                        <ol>4.Confirm and Done</ol>
                                    </ul>
                                    <hr>
                                    <ul>
                                        <ol>1.Open any Mobile Banking Aps that support KHQR</ol>
                                        <ol>2.Scan QR Code</ol>
                                        <ol>3.Confirm and Done</ol>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="qtyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route'=>'updateCart','id'=>'','method'=>'POST']) !!}
                <div class="modal-body">

                    <div class="form-group">
                        {!! Form::label('Quantity') !!}
                        {!! Form::number('quantity',null,['class'=>'form-control','id'=>'quantity']) !!}
                        {!! Form::hidden('id',null,['class'=>'form-control','id'=>'id']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
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
