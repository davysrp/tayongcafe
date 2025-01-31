<x-app-layout>

    <div class="container">
        <div class="post-product-container">
            <h1 style="text-align:center; font-size: 32px;">ស្នើរដាក់ប្រាក់ចូលគណនី</h1>
            {!! Form::open( ['route' => ['submitTopUpBalance'],'method'=>'POST','id'=>'profileForm','enctype'=>'multipart/form-data']) !!}
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('amount') !!}
                        {!! Form::number('amount',null,['class'=>"form-control"]) !!}
                    </div>
                    {{--                    <div class="form-group">--}}
                    {{--                        {!! Form::label('bank_name') !!}--}}
                    {{--                        {!! Form::select('bank_name',['aba'=>'ABA Bank','acleda'=>'Acleda Bank','other'=>"Other"],null,['class'=>"form-control",'placeholder'=>'Select Bank name']) !!}--}}
                    {{--                    </div>--}}
                    {{--                    <div  class="form-group">--}}
                    {{--                        <label for="largeFile"--}}
                    {{--                               class="form-label">--}}
                    {{--                            Bank Transcript--}}
                    {{--                        </label>--}}
                    {{--                        <input class="form-control" id="largeFile" name="bank_transcript"--}}
                    {{--                               type="file" >--}}
                    {{--                    </div>--}}
                    <div class="form-group">
                        {!! Form::button('ដាក់ស្នើរ',['class'=>"btn btn-secondary w-100",'id'=>'topUp']) !!}
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
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


    <x-slot name="script">
        <script>
            $("#profileForm").validate({
                rules: {
                    amount: "required",
                    bank_name: "required",
                    bank_transcript: "required",
                },
                /*messages: {
                    names: "Please enter your name",
                    detail: "Please enter your content detail",
                    category_id: "Please select category",
                    product_number: "Please enter number of product",
                },*/
                errorElement: "em",
                errorPlacement: function (error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.next("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });

        </script>
    </x-slot>

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
                var md5 = null;
                var token = null
                var merchantInfoData = null;
                var optionalData_ = null;
                var billNumber = null


                $('#topUp').on('click', function () {
                    var amount = $('#amount').val();
                    var paymentMethod = 1;
                    $.get("{!! route('getPaymentMethod') !!}", {id: paymentMethod}, function (data) {
                        if (data.success == true) {
                            token = data.data.method.token;
                            merchantInfoData = data.data.merchantInfoData;
                            optionalData_ = data.data.optionalData_;
                            billNumber = optionalData_.billNumber;
                            console.log(data);
                        }
                    });
                    var i = 1;
                    setTimeout(function(){
                        if(i==1) {
                            if (paymentMethod) {
                                var orderData = {
                                    amount: amount,
                                    payment_method_id: paymentMethod,
                                    invoice_no: optionalData_.billNumber,
                                    customer: {!! Auth::guard('seller')->user()->id !!},
                                };

                                var orderLink = "{!! route('submitTopUpBalance') !!}";
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
                                        $('.home-amount').text(amount);
                                        var qrData = generateKhqr(parseFloat(amount), merchantInfoData, optionalData_, orderData, orderLink);
                                        var qrUrl = generateQRCode(qrData.qr)
                                        md5 = qrData.md5
                                        $('#qrCode').attr('src', qrUrl)
                                        $('body').addClass("modal-show");
                                        updateCountdown(180);
                                        // Call the function to initiate the process
                                        checkTransactionData(md5, orderData, optionalData_.billNumber);
                                    }
                                });
                            }
                        }
                        i++;
                    }, 1000);

                });

                $('.close-modal').on('click', function () {
                    $('body').removeClass("modal-show");
                    $('.home-minutes').text(180);
                });


                function checkTransactionData(md5, orderData, inv) {
                    let intervalId;

                    function refresh() {
                        $.post("{!! route('submitTopUpBalance') !!}", {
                            md5: md5,
                            payment_method_id: orderData.payment_method_id,
                            orderData: orderData
                        }, function (data) {
                            if (data.success == true) {
                                {{--window.location = "{!! route('khqrPaymentSuccess') !!}?invoice=" + inv;--}}
                                Swal.fire("បញ្ចូលប្រាក់ជោគជ័យ!", "", "success");
                                window.location = "{!! route('sellerprofile') !!}?invoice=" + inv;
                                clearInterval(intervalId);
                            }
                        });
                    }

                    intervalId = setInterval(refresh, 5000);
                }
            });
        </script>
    </x-slot>


</x-app-layout>
