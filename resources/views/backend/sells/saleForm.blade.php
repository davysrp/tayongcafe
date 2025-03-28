<x-admin-layout>

    <style>
        .table td, .table th {
            padding: 0.3rem;
        }
    </style>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="{!! route('saleDashboard') !!}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Back</a>
        </div>
        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-5 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <input type="hidden" id="table_id" value="{!! $table !!}">
                        <table class="table table-striped" id="orderItemList">
                            <thead>
                            <tr>
                                <td>Item</td>
                                <td>Qty</td>
                                <td>Price</td>
                                <td>Total</td>
                                <td>#</td>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <table class="table table-striped">
                            <tr>
                                <td width="70%">Subtotal</td>
                                <td width="30%" id="Subtotal">0</td>
                            </tr>
                            <tr>
                                <td>Discount <span id="coupon-label" class="font-weight-bold"></span></td>
                                <td id="Discount">0</td>
                            </tr>
                            <tr>
                                <td>Grand Total
                                    <input type="hidden" id="textGrandTotal">

                                </td>
                                <td id="GrandTotal">0</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-3 p-1">
                                <select class="form-control" name="customer_id" required>
                                    <option value="" disabled selected>Customer</option>

                                    @foreach($customers as $customer)
                                        <option @if($customer->is_general==1) selected @endif
                                            value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3  p-1">
                                <select class="form-control" placeholder="Coupon Code" id="coupon_code_id">
                                    <option disabled selected>Coupon Code</option>
                                </select>
                            </div>
                            <div class="col-md-3  p-1">
                                <button type="button" class="btn btn-outline-secondary" id="applyCoupon">Apply</button>
                            </div>

                            <!-- Shipping Method Dropdown -->
                            {{-- <div class="col-md-3 p-1">
                                <select class="form-control" name="shipping_method_id" required>
                                    <option value="" disabled selected>Select Shipping Method</option>
                                    @foreach($shippingMethods as $method)
                                        <option value="{{ $method->id }}">{{ $method->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}


                            {{-- <div class="col-md-3 p-1">
                                <input type="text" name="remark" class="form-control" placeholder="Enter remark (optional)">
                            </div> --}}

                            <div class="col-md-3 p-1">
                                <button type="button" class="btn btn-outline-primary" id="confirm-payment">
                                    Confirm Payment
                                </button>
                            </div>

                            <!-- Invoice Buttons: Show Only If Order is Paid -->

                            {{-- @if(isset($order) && $order->status === 'paid' && $order->id)
                            <div class="col-md-3 p-1">
                                <a href="{{ route('invoice.view', $order->id) }}" class="btn btn-info">View Invoice</a>
                            </div>
                            <div class="col-md-3 p-1">
                                <a href="{{ route('invoice.download', $order->id) }}" class="btn btn-success">Download Invoice</a>
                            </div>
                        @endif --}}


                            <div class="row">
                                <div class="col-md-12">
                                    @foreach($paymentMethods as $item)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input payment-method" type="radio"
                                                   name="payment_method_id"
                                                   id="payment_{{ $item->id }}" value="{{ $item->id }}">
                                            <label class="form-check-label"
                                                   for="payment_{{ $item->id }}">{{ $item->names }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach($category as $item)
                                        <button type="button"
                                                class="btn btn-primary btn-icon-split mr-1"
                                                id="category"
                                                data-id="{!! $item->id !!}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-utensils"></i>
                                        </span>
                                            <span class="text">{!! $item->names !!}</span>
                                        </button>
                                    @endforeach

                                    <div class="row mt-3" id="productItem"></div>
                                </div>
                            </div>
                </div>


            @include('backend.sells.khqr')

            <!-- Modal -->
                <div class="modal fade" id="productVariant" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row" id="item-variant"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <x-slot name="css">
                    <link rel="stylesheet" href="{!! asset('assets/js/select2/css/select2.min.css') !!}">
                    <link rel="stylesheet"
                          href="{!! asset('assets/js/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
                    <link href="{!! asset('assets/khqr/style.css?v='.time()) !!}" rel="stylesheet">

                </x-slot>
                <x-slot name="script">



                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script src="{!! asset('assets/js/select2/js/select2.full.min.js') !!}"></script>
                    <script src="{!! asset('assets/khqr/khqr-1.0.16.min.js') !!}"></script>
                    <script src="{!! asset('assets/khqr/request.js?v='.time()) !!}"></script>
                    <script src="{!! asset('assets/khqr/khqr-form.js') !!}"></script>

                    <script>
                        $(document).ready(function () {
                            $('select').select2({theme: 'bootstrap4'});

                            $("#coupon_code_id").select2({
                                theme: 'bootstrap4',
                                ajax: {
                                    url: '{!! route('getCouponCode') !!}',
                                    dataType: 'json',
                                    processResults: function (response) {
                                        return {
                                            results: response,
                                        }
                                    },
                                    cache: true
                                }
                            });
                            $("#customer_id").select2({
                                theme: 'bootstrap4',
                                ajax: {
                                    url: '{!! route('getCustomer') !!}',
                                    dataType: 'json',
                                    processResults: function (response) {
                                        return {
                                            results: response,
                                        }
                                    },
                                    cache: true
                                }
                            });


                            // getProductByCategory
                            var productData = null
                            orderItemList();

                            $('body').delegate('#category', 'click', function () {
                                var categoryId = $(this).data('id')
                                $.get('{!! route('getProductByCategory') !!}', {category_id: categoryId}, function (data) {
                                    var html = '';
                                    if (data.success === true) {
                                        productData = data.data;
                                        $.each(data.data, function (key, value) {
                                            html += '<div class="col-md-3">' +
                                                '                                <button type="button" class="btn btn-secondary btn-icon-split w-100" id="product"' +
                                                '                                        data-id="' + value.id + '" data-title="' + value.names + '"> ' +
                                                '                                    <span class="text">' + value.names + '</span>' +
                                                '                                </button>' +
                                                '                            </div>'
                                        })

                                        $('#productItem').html(html);
                                    }
                                })
                            });
                            $('body').delegate('#product', 'click', function () {
                                var productId = $(this).data('id');
                                var title = $(this).data('title');
                                var table_id = $('#table_id').val();
                                $('#exampleModalCenterTitle').text(title)

                                var result = productData.find(item => item.id === productId);
                                var html = '';
                                if (result.product_variant.length != 0) {
                                    $('#productVariant').modal('show');
                                    $.each(result.product_variant, function (key, value) {
                                        html += '<div class="col-md-4 p-1">' +
                                            '                                <button type="button" class="btn btn-secondary btn-icon-split w-100" id="product-variant"' +
                                            '                                        data-productid="' + productId + '" data-id="' + value.id + '"  data-title="' + value.variant_code + '"> ' +
                                            '                                    <span class="text">' + value.variant_name + '</span>' +
                                            '                                </button>' +
                                            '                            </div>'
                                    });
                                    $('#item-variant').html(html);
                                } else {
                                    $('#item-variant').html('');
                                    addCart(table_id, productId, null, 1);
                                }

                            });

                            $('body').delegate('#product-variant', 'click', function () {
                                    var productId = $(this).data('productid');
                                    var variantId = $(this).data('id');
                                    var table_id = $('#table_id').val();
                                    addCart(table_id, productId, variantId, 1);
                                }
                            );


                            $('#applyCoupon').click(function () {
                                var couponId = $('#coupon_code_id').val();
                                var table_id = $('#table_id').val();

                                $.post('{!! route('applyCouponCodeAdmin') !!}', {
                                    coupon_code_id: couponId,
                                    table_id: table_id
                                }, function (data) {
                                    if (data.success === true) {
                                        orderItemList();
                                    }
                                })
                            })

                            function addCart(table, product_id, product_variant_id, qty) {
                                $.post('{!! route('addCardItem') !!}', {
                                    table_id: table,
                                    product_id: product_id,
                                    product_variant_id: product_variant_id,
                                    qty: qty
                                }, function (data) {
                                    if (data) {
                                        orderItemList();
                                    }

                                })
                            }


                            function orderItemList() {
                                var table_id = $('#table_id').val();

                                var subtotal = 0;
                                var discount = 0;
                                var grandTotal = 0;
                                var couponLabel = '';
                                $.get('{!! route('orderItemList') !!}', {table_id: table_id}, function (data) {
                                    var html = '';
                                    if (data.success == true) {
                                        grandTotal = data.data.grand_total
                                        discount = data.data.discount ? data.data.discount : 0;
                                        console.log(discount);
                                        couponLabel = data.data.coupon_code != null ? data.data.coupon_code.coupon_code : null;

                                        var i = 1;
                                        $.each(data.data.sell_detail, function (key, value) {
                                            
                                            /*if (value.product_variant) {
                                                html += '  <li class="list-group-item">' + value.product.names + '-' + value.product_variant.variant_name + ' - ( X '+value.qty + ' $'+  value.price+  ' )</li>';
                                            }else{
                                                html += '  <li class="list-group-item">' + value.product.names + '</li>';

                                            }*/
                                            if (value.product_variant) {
                                                html += "<tr>" +
                                                    "<td>" + value.product.names + '-' + value.product_variant.variant_name + "</td>" +
                                                    "<td>" + value.qty + "</td>" +
                                                    "<td>" + value.price + "</td>" +
                                                    "<td>" + value.total + "</td>" +
                                                    '<td><div class="btn-group" role="group" aria-label="Basic example">' +
                                                    '  <button type="button" class="btn btn-secondary btn-sm update-remove" data-type="minus" data-id="' + value.id + '"><i class="fas fa-minus"></i></button>' +
                                                    '  <button type="button" class="btn btn-warning btn-sm update-remove" data-type="plus" data-id="' + value.id + '"><i class="fas fa-plus"></i></button>' +
                                                    '  <button type="button" class="btn btn-danger btn-sm update-remove" data-type="remove" data-id="' + value.id + '"><i class="fas fa-trash-alt"></i></button>' +
                                                    '</div></td>' +
                                                    "</tr>";

                                            } else {
                                                // html += '  <li class="list-group-item">' + value.product.names + '</li>';
                                                html += "<tr>" +
                                                    "<td>" + value.product.names + "</td>" +
                                                    "<td>" + value.qty + "</td>" +
                                                    "<td>" + value.price + "</td>" +
                                                    "<td>" + value.total + "</td>" +
                                                    '<td><div class="btn-group" role="group" aria-label="Basic example">' +
                                                    '  <button type="button" class="btn btn-secondary btn-sm update-remove" data-type="minus" data-id="' + value.id + '"><i class="fas fa-minus"></i></button>' +
                                                    '  <button type="button" class="btn btn-warning btn-sm update-remove" data-type="plus" data-id="' + value.id + '"><i class="fas fa-plus"></i></button>' +
                                                    '  <button type="button" class="btn btn-danger btn-sm update-remove" data-type="remove" data-id="' + value.id + '"><i class="fas fa-trash-alt"></i></button>' +
                                                    '</div></td>' +

                                                    "</tr>";
                                            }


                                            subtotal = subtotal + parseFloat(value.total);

                                            i++;
                                        })
                                    }
                                    $('#orderItemList tbody').html(html)


                                    if (discount === 0) {
                                        grandTotal = subtotal;
                                    }
                                    const subtotals = new Intl.NumberFormat('en-US', {
                                        style: 'currency',
                                        currency: 'USD',
                                    }).format(subtotal);
                                    const discounts = new Intl.NumberFormat('en-US', {
                                        style: 'currency',
                                        currency: 'USD',
                                    }).format(discount);
                                    const grandTotals = new Intl.NumberFormat('en-US', {
                                        style: 'currency',
                                        currency: 'USD',
                                    }).format(grandTotal);


                                    $('#Subtotal').text(subtotals)
                                    $('#Discount').text(discounts)
                                    $('#GrandTotal').text(grandTotals)
                                    $('#textGrandTotal').val(grandTotal)
                                    $('#coupon-label').text(couponLabel)


                                });

                            }

                            $('body').delegate('.update-remove', 'click', function () {
                                    var type = $(this).data('type');
                                    var id = $(this).data('id');
                                    if (type === 'remove') {
                                        Swal.fire({
                                            title: "Do you want to remove?",
                                            showDenyButton: true,
                                            confirmButtonText: "Yes",
                                        }).then((result) => {
                                            /* Read more about isConfirmed, isDenied below */
                                            if (result.isConfirmed) {
                                                updateRemoveQty(type, id, 1);
                                            }
                                        });
                                    } else {
                                        updateRemoveQty(type, id, 1);
                                    }

                                }
                            );

                            function updateRemoveQty(type, id, qty) {
                                $.post('{!! route('updateRemoveQty') !!}', {
                                    type: type,
                                    id: id,
                                    qty: qty
                                }, function (data) {
                                    if (data) {
                                        orderItemList();
                                    }
                                })
                            }
                        });


                        var token = null
                        var merchantInfoData = null;
                        var optionalData_ = null;


                        $(document).ready(function () {
                            var md5 = null;
                            $('#confirm-payment').on('click', function () {
                                var table_id = $('#table_id').val();
                                var grand_total = $('#textGrandTotal').val();
                                var customer_id = $('#customer_id').val();
                                // var grand_total = 0.01;
                                if (grand_total == 0) grand_total = 0.01;
                                var merchantInfoData = null
                                var optionalData_ = null
                                $('.home-amount').val(grand_total)
                                const paymentMethod = $('input[name="payment_method_id"]:checked').val();
                                console.log(paymentMethod);

                                if (paymentMethod) {

                                    Swal.fire({
                                        title: "Do you want to confirm order?",
                                        showDenyButton: true,
                                        confirmButtonText: "Yes",
                                    }).then((result) => {
                                        /* Read more about isConfirmed, isDenied below */
                                        // if (result.isConfirmed) {
                                        // // Show Loading Indicator

                                        // Swal.fire({

                                        //     title: 'Processing Payment...',
                                        //     text: 'Please wait while we process your payment.',
                                        //     allowOutsideClick: false,
                                        //     allowEscapeKey: false,
                                        //     showConfirmButton: false,
                                        //     didOpen: () => {
                                        //         Swal.showLoading();
                                        //     }
                                        // });

                                        //     $.get("{!! route('getPaymentMethodAdmin') !!}", {id: paymentMethod}, function (data) {
                                        //         if (data.success == true) {
                                        //             token = data.data.method.token;
                                        //             merchantInfoData = data.data.merchantInfoData;
                                        //             optionalData_ = data.data.optionalData_;
                                        //         }
                                        //     });

                                        //     sleep(1000).then(() => {
                                        //         var orderLink = "{!! route('placeOrderAdmin') !!}";
                                        //         var orderData = {
                                        //             payment_method_id: paymentMethod,
                                        //             invoice_no: optionalData_.billNumber,
                                        //             customer_id: customer_id,
                                        //             table_id: table_id,
                                        //             is_order: paymentMethod === 1 ? 0 : 1,
                                        //         };
                                        //         if (paymentMethod == 1) {
                                        //             $('.home-amount').text(grand_total);
                                        //             var qrData = generateKhqr(grand_total, merchantInfoData, optionalData_);
                                        //             var qrUrl = generateQRCode(qrData.qr)
                                        //             md5 = qrData.md5
                                        //             $('#qrCode').attr('src', qrUrl)
                                        //             $('body').addClass("modal-show");
                                        //             $('#KHqrModal').modal('show')
                                        //             updateCountdown(180);
                                        //             // Call the function to initiate the process
                                        //             checkTransactionData(md5, orderData, optionalData_.billNumber);
                                        //         } else {
                                        //             checkTransactionData(md5, orderData, optionalData_.billNumber);
                                        //         }
                                        //     });
                                        // }



                                        if (result.isConfirmed) {
                                            


                                            $.get("{!! route('getPaymentMethodAdmin') !!}", { id: paymentMethod }, function (data) {
                                                if (data.success == true) {
                                                    token = data.data.method.token;
                                                    merchantInfoData = data.data.merchantInfoData;
                                                    optionalData_ = data.data.optionalData_;
                                                }
                                            });

                                            sleep(1000).then(() => {
                                                var orderLink = "{!! route('placeOrderAdmin') !!}";
                                                var orderData = {
                                                    payment_method_id: paymentMethod,
                                                    invoice_no: optionalData_.billNumber,
                                                    customer_id: customer_id,
                                                    table_id: table_id,
                                                    is_order: paymentMethod === 1 ? 0 : 1,
                                                };
                                            
                                                if (paymentMethod == 1) {
                                                    // KHQR selected — skip Swal loading and show KHQR modal instead
                                                    $('.home-amount').text(grand_total);
                                                    var qrData = generateKhqr(grand_total, merchantInfoData, optionalData_);
                                                    var qrUrl = generateQRCode(qrData.qr)
                                                    md5 = qrData.md5;
                                                    $('#qrCode').attr('src', qrUrl);
                                                    $('body').addClass("modal-show");
                                                    $('#KHqrModal').modal('show');
                                                    updateCountdown(180);
                                                    checkTransactionData(md5, orderData, optionalData_.billNumber);
                                                
                                                } else {
                                                    // Not KHQR — show Swal loading
                                                    Swal.fire({
                                                        title: 'Processing Payment...',
                                                        text: 'Please wait while we process your payment.',
                                                        allowOutsideClick: false,
                                                        allowEscapeKey: false,
                                                        showConfirmButton: false,
                                                        didOpen: () => {
                                                            Swal.showLoading();
                                                        }
                                                    });
                                                
                                                    checkTransactionData(md5, orderData, optionalData_.billNumber);
                                                }
                                            });
                                            }


                                    });


                                } else {
                                    // alert('Please select Payment method before confirm payment')
                                    Swal.fire("Please select Payment method before confirm payment");
                                }

                            });

                                           

                            function checkTransactionData(md5, orderData, inv) {
                                let intervalId;

                                function refresh() {
                                    $.post("{!! route('checkTransactionOrderAdmin') !!}", {
                                        md5: md5,
                                        payment_method_id: orderData.payment_method_id,
                                        orderData: orderData
                                    }, function (data) {
                                        console.log(data.data.id);
                                        if (data.success == true) {
                                            $('#KHqrModal').modal('hide');

                                            // Show Payment Success Popup with Embedded Invoice
                                            Swal.fire({
                                                title: 'Payment Successful!',
                                                
                                                html: '<iframe src="{{ route('invoice.view', $order->id??0) }}?order_id=' + data.data.id + '" width="100%" height="400px" style="border: none;"></iframe>',

                                                icon: 'success',
                                                showCancelButton: true,
                                                confirmButtonText: 'Download Invoice',
                                                cancelButtonText: 'Close',
                                                width: '600px'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = "{{ route('invoice.download', $order->id??0) }}?order_id=" + data.data.id;
                                                }
                                            });

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

</x-admin-layout>


