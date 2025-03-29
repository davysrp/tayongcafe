{{--<button type="button" class="btn btn-secondary" id="openQr">
    Open QR
</button>--}}

<div class="modal fade" id="KHqrModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">KHQR Payment</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="home-container1">
                            <div class="home-bodyqr">
                                <span class="home-currency">$</span>
                                <span class="home-amount">100</span>
                                <span class="home-name"><span>Tanyong Cafe</span>
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
                        <div class="qr-construction">
                            <h6>How to make the payment?</h6>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                
            </div>
        </div>
    </div>
</div>





