<x-app-layout>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h3 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>ការបញ្ជាទិញរបស់អ្នក</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                   <th width="5%" class="text-center">#</th>
                                    <th width="35%">ផលិតផល</th>
                                    <th width="15%" class="text-center">តម្លៃ</th>
                                    <th width="20%" class="text-center">ចំនួន</th>
                                    <th width="15%" class="text-center">តម្លៃសរុប</th>
                                    <th width="10%" class="text-center">#</th>
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
            <?php
            $price_cart = session()->get('price_cart');
            ?>
            
            <div class="col-lg-4">
                <div class="card-header bg-dark text-white" style="top: 20px;">
                    {{-- <div class="card-header bg-primary text-white"> --}}
                        <h3 class="mb-0"><i class="fas fa-receipt me-2"></i>កន្លែងទូទាត់សាច់ប្រាក់</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>តម្លៃសរុប :</span>
                            <strong>$<span id="cart-subtotal">{{ number_format($total, 2) }}</span></strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>ប្រមូដកូដ ({!! $price_cart['coupon_code'] ?? 'មិនមាន' !!}):</span>
                            <strong class="text-danger">-$<span
                                    id="cart-discount">{{ isset($price_cart['discount_price']) ? number_format($price_cart['discount_price'], 2) : '0.00' }}</span></strong>
                        </div>
                        <hr>


                        <!-- In your order summary section -->
                        <div class="d-flex justify-content-between mb-3">
                            <span class="h5">តម្លៃដើម :</span>
                            <span class="h5 text-primary">
        <strong>$<span id="grand-total">{{ number_format($total, 2) }}</span></strong>
    </span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="h5">ទឹកប្រាក់ត្រូវបង់សរុប :</span>
                            <span class="h5 text-primary">
                            <strong>$<span
                                    id="grand-total">{{ isset($price_cart['grand_total']) ? number_format($price_cart['grand_total'], 2) : number_format($total, 2) }}</span></strong>
                        </span>
                        </div>
                        
                        <!-- Cart count badge somewhere in your layout -->
                        {{-- <span id="cart-count" class="badge bg-primary"> {{ count(session('cart', [])) }} </span> --}}

                        {{-- {!! Form::open(['route' => 'applyCouponCustomer', 'method' => 'POST']) !!}
                        <h4 class="coupon-title">បញ្ចូលកូដបញ្ចុះតម្លៃ</h4>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Coupon code" name="coupon_code">
                            <div class="input-group-append">
                                <button class="input-group-text btn-apply" type="submit">
                                    <i class="far fa-check-circle"></i> បញ្ជាក់
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!} --}}
                                            
                                    

                        {!! Form::open(['route' => 'applyCouponCustomer', 'method' => 'POST']) !!}
                        <div class="form-inline">
                            {{-- <label class="mr-2 font-weight-bold">បញ្ចូលកូដបញ្ចុះតម្លៃ</label> --}}
                            {{-- <input type="text" class="form-control mr-2" name="coupon_code" placeholder="Coupon code"> --}}
                             <input type="text" class="form-control mr-2" name="coupon_code" placeholder="បញ្ចូលកូដបញ្ចុះតម្លៃ">
                            <button class="btn btn-primary" type="submit">
                                <i class="far fa-check-circle"></i> បញ្ជាក់
                            </button>
                        </div>
                        {!! Form::close() !!}


                    <!-- Remark -->
                        <div class="mb-3">
                            <label for="remark" class="form-label">កំណត់ចំណាំសម្រាប់ហាង (មិនមានក៏បាន)</label>
                            <textarea name="remark" id="remark" class="form-control" rows="2"></textarea>
                        </div>
                    
                        <div class="mb-4">
                            <label for="shipping_method_id" class="form-label fw-semibold text-white">
                                <i class="fas fa-shipping-fast me-2"></i>មធ្យោបាយទទួលទំនិញ
                            </label>
                            <select name="shipping_method_id"
                                    id="shipping_method_id"
                                    class="form-select bg-dark text-white border border-secondary shadow-sm"
                                    required>
                                <option value="" disabled selected>ទទួលទំនិញ</option>
                                @foreach($shippingMethods as $method)
                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        
                        {!! Form::open(['route'=>'checkout.process', 'class'=>'mt-4','id'=>'CheckoutForm']) !!}
                        <h5 class="mb-3"><i class="fas fa-credit-card me-2"></i>វិធីទូទាត់សាច់ប្រាក់</h5>

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
                               value="{!! isset($price_cart['discount_price']) ? $price_cart['discount_price']: 0 !!}"
                               name="discount" id="discount">
                        <input type="hidden"
                               value="{!! isset($price_cart['grand_total']) ? $price_cart['grand_total'] : $total !!}"
                               name="grand_total" id="grand_total">
                        <input type="hidden"
                               value="{!! isset($price['coupon_id']) ? $price_cart['coupon_id'] : null !!}"
                               name="coupon_code_id" id="coupon_code_id">

                        <button class="btn btn-primary btn-lg w-100 py-3" type="submit">
                            <i class="fas fa-check-circle me-2"></i> យល់ព្រមទិញ
                        </button>
                        {!! Form::close() !!}
                    </div>
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


                $('#CheckoutForm').on('submit', function (e) {
                    e.preventDefault(); // Stop form from submitting normally
                    var formData = $(this).serialize();

                    var table_id = $('#table_id').val();
                    var grand_total = $('#grand_total').val();
                    var customer_id = $('#customer_id').val();
                    // var grand_total = 0.01;
                    // if (grand_total == 0) grand_total = 0.01;
                    grand_total = parseFloat(grand_total)
                    grand_total=grand_total.toFixed(2);
                    console.log(grand_total);
                    var merchantInfoData = null
                    var optionalData_ = null
                    $('.home-amount').val(grand_total)
                    const paymentMethod = $('input[name="payment_method_id"]:checked').val();
                    if (paymentMethod) {
                        if (confirm("តើអ្នកយល់ព្រមក្នុងការទូរទាត់សាច់ប្រាក់នេះឬ?") == true) {
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
                        alert('សូមជ្រើសរើសវិធីទូទាត់!')
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
                               window.location.href = '{{ route("checkout.success") }}'; 
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
