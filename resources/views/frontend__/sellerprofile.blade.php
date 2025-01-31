<x-app-layout>
    <style>
        .label_style {
            width: 150px;
            background: #ede5e5;
            padding-left: 10px;
            border: 1px solid #fff;
        }
    </style>
    <?php
    $userName = null;
    if (Auth::guard('seller')) {
        $id = Auth::guard('seller')->user()->id;
        $seller = DB::table('sellers')->where('id', $id)->first();
        $userName = $seller->username;
    }
    ?>
    <div class="container">
        <div class="post-product-container">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-box">
                        <div class="profile-header">
                            <div class="profile-thumb"
                                 style="background: url({!! asset('photo/img/user_avatar.png') !!})"></div>
                        </div>
                        <div class="profile-body">
                            <h6>{!! $userName !!}</h6>
                            <a href="" class="btn btn-info btn-view-profile">View Profile</a>
                            <a href="{{route('sellerprofileUpdate')}}" class="btn btn-info btn-edit-profile">Edit
                                Profile</a>
                        </div>


                    </div>
                </div>
                <div class="col-md-8">
                    <div class="profile-detail">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Username:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>{!! $userName !!}</label>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Account type:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label><?php
                                            if ($seller->status == 0)
                                                echo "Customer";
                                            elseif ($seller->status == 1)
                                                echo "General Account";
                                            elseif ($seller->status == 2)
                                                echo "VIP Account";
                                            ?></label>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Facebook:</label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>{{$seller->facebook}}</label>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Registered :</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label>{{$seller->phone}}</label>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Email:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label>{{$seller->email}}</label>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Profile URL :</label>
                                    </div>
                                    <div class="col-md-8">
                                        <label>{{$seller->facebook}}</label>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>


            </div>

            <?php
            $balance = 0;
            $account = DB::table('accounts')->where('seller_id', $id)->first();
            $total_deposit = DB::table('account_requests')->where([['seller_id', $id], ['transaction_type', 'deposit']])->sum('amount');

            if (!is_null($account))
                $balance = $account->balance;
            ?>


            <div class="row mt-5">
                <div class="col-md-3">

                    <div class="card card-box">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-wallet"></i> BALANCE</h5>
                            <hr>
                            <div class="balance">
                                <span>${!! number_format($balance,2) !!}</span>
                                <h6>គណនេយ្យ</h6>
                            </div>
                            <h6>បានចាយៈ <span>${!! number_format(0,2) !!}</span></h6>
                            <h6>បានបញ្ចូលៈ <span>${{ number_format($total_deposit,2) }}</span></h6>


                            <h5>Top Up</h5>
                            <div class="text-center">
{{--                                <a--}}
{{--                                    --}}{{--                                    href="{{route('page',['page'=>5,'about'=>'Top Up'])}}"--}}
{{--                                    href="{{route('topUpBalance')}}"--}}
{{--                                >--}}
{{--                                    <div style="width:40px; float: left">--}}
{{--                                        <img style="width:40px;" src="{{url('photo/img/aba_icon.png')}}" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div style="width:40px; float:left; margin-left: 20px;">--}}
{{--                                        <img style="width:40px;" src="{{url('photo/img/usdt_icon.png')}}" alt="">--}}
{{--                                    </div>--}}
{{--                                </a>--}}
                                <a
                                    {{--                                    href="{{route('page',['page'=>5,'about'=>'Top Up'])}}"--}}
                                    href="{{route('topUpBalance')}}" class="btn btn-outline-secondary w-100"
                                >ស្នើរដាក់ប្រាក់</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-box">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user"></i> SELLER</h5>
                            <hr>
                            @if($seller->status==0)
                                <a href="{{route('frontend__.becomeseller')}}" class="btn btn-secondary w-100"><i
                                        class="fa-solid fa-user-plus"></i> ចុះឈ្មោះលក់</a>
                            @else
                                <?php
                                // $ex=Expenses::select("categories.names","expenses.detail","amount")->join("categories","categories.id","=","expenses.categories_id")->get();

                                // $sell_today = DB::table('sells')->where([['seller_id_seller', $id], ['dates', date('Y-m-d')]])->sum('grand_total');
                                $sell_today = DB::table('products')
                                    ->join('sell_details', 'products.id', '=', 'sell_details.product_id')
                                    ->join('sells', 'sells.id', '=', 'sell_details.sell_id')
                                    ->where([['seller_id', $id], ['dates', date('Y-m-d')]])->sum('sell_details.price');
                                $sell_all = DB::table('products')
                                    ->join('sell_details', 'products.id', '=', 'sell_details.product_id')
                                    ->join('sells', 'sells.id', '=', 'sell_details.sell_id')
                                    ->where('seller_id', $id)->sum('sell_details.price');
                                $no_product = App\Models\Product::where('seller_id', $id)->count();
                                $find_hold = DB::table('account_requests')->where([['seller_id', $id], ['status', 0]])->sum('amount');

                                ?>
                                <div class="balance">
                                    <span>${!! number_format($sell_today,2) !!}</span>
                                    <h6>លក់ថ្ងៃនេះ</h6>
                                </div>
                                <h6>លក់សរុបៈ <span>${!! number_format($sell_all,2) !!}</span></h6>
                                <h6>ផលិតផលសរុបៈ <span>${{ number_format($no_product,2) }}</span></h6>
                                <h6>ទឺកប្រាក់ on hold <span>${{ number_format($find_hold,2) }}</span></h6>


                                <div>
                                    <a href="{{route('frontend__.monthlysell',['seller'=>$id])}}">របាយការណ៍លក់ប្រចាំខែ</a>
                                </div>

                                {{--<a href="{{route('frontend__.withdraw',['message'=>'Deposit Request '])}}"
                                   class="btn btn-secondary mt-3 w-100">
                                    ស្នើរសុំដកប្រាក់</a>--}}

                                <button type="button" class="btn btn-secondary mt-3 w-100" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                    ស្នើរសុំដកប្រាក់
                                </button>

                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ស្នើរសុំដកប្រាក់</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('frontend__.saverequest') }}">
                                                <div class="modal-body">


                                                    @csrf
                                                    <?php
                                                    $on_hold = 0;
                                                    $find_hold = DB::table('account_requests')->where([['seller_id', $id], ['status', 0]])->sum('amount');
                                                    if (!is_null($find_hold))
                                                        $on_hold = $find_hold;
                                                    ?>
                                                    <?php
                                                    $balance = 0;
                                                    $account = DB::table('accounts')->where('seller_id', $id)->first();
                                                    if (!is_null($account))
                                                        $balance = $account->balance;
                                                    ?>
                                                    <div class="form-group">
                                                        <label>ចំនួនលុយ on hold: <b>${{number_format($on_hold,2)}}</b>
                                                        </label> <br>
                                                        <label>ចំនួនលុយក្នុងគណនី: <b>${{number_format($balance,2)}}</b></label><br>
                                                        <label>ចំនួនលុយស្នើរសុំដក: </label>
                                                        <input type="text" name="amount" class="form-control">
                                                    </div>
                                                    <div class="col-12 ">
                                                        <input type="hidden" name="id_customer"
                                                               value="{{Auth::guard('seller')->user()->id}}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{--                                                    <button type="button" class="btn btn-secondary"--}}
                                                    {{--                                                            data-bs-dismiss="modal">បិទ--}}
                                                    {{--                                                    </button>--}}
                                                    <button type="button" class="btn btn-primary">ដាក់ស្នើរសុំ</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-box">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-comments"></i> CHAT</h5>
                            <hr>
                            <?php
                            $chat_list = DB::table('chat_privates')->where('seller_id_sender', $id)->orWhere('seller_id_receiver', $id)->distinct('seller_id_sender', 'seller_id_receiver')->get();


                            foreach($chat_list as $key=>$cp)
                            {
                            if($cp->seller_id_sender <> $id)
                            {
                            $seller_chat = App\Models\Seller::where('id', $cp->seller_id_sender)->first();
                            ?>
                            <div
                                style="    border: 1px solid #f7c85e; padding: 5px;  color: black;  border-radius: 15px; width:100%; margin-bottom:10px;">
                                <a href="{{route('frontend__.chatseller',['seller'=>$seller_chat->id])}}">
                                    <img src="{{url('photo/img/user_avatar.png')}}"
                                         style="margin-right: 15px; width: 20px; border-radius:15px;"/><?= $seller_chat->full_name ?>
                                </a>
                            </div>
                            <?php
                            }
                            else
                            {
                            $seller_chat = App\Models\Seller::where('id', $cp->seller_id_receiver)->first();


                            ?>
                            <div
                                style="    border: 1px solid #f7c85e; padding: 5px;  color: black;  border-radius: 15px; width:100%; margin-bottom:10px;">
                                <a href="{{route('frontend__.chatseller',['seller'=>$seller_chat->id])}}">
                                    <img src="{{url('photo/img/user_avatar.png')}}"
                                         style="margin-right: 15px; width: 20px; border-radius:15px;"/><?= $seller_chat->full_name ?>
                                </a>


                            </div>
                            <?php
                            }
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-box">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-list-ol"></i> PRODUCT</h5>
                            <hr>
                            <div class="list-group">
                                @if($seller->status==0)
                                    <a href="{{route('frontend__.becomeseller')}}"
                                       class="list-group-item list-group-item-action"><i
                                            class="fa-solid fa-user-plus"></i>ចុះឈ្មោះលក់</a>
                                    <a href="{{route('frontend__.boughtproduct',['buyer'=>$id])}}"
                                       class="list-group-item list-group-item-action"><i class="fas fa-cart-plus"></i>My
                                        Order</a>
                                @else
                                    <a href="{{route('seller-products.index')}}"
                                       class="list-group-item list-group-item-action"><i class="fas fa-list"></i>My
                                        Product</a>
                                    <a href="{{route('seller-products.create')}}"
                                       class="list-group-item list-group-item-action"><i class="fas fa-plus"></i>Add New
                                        Product</a>
                                    <a href="{{route('frontend__.soldproduct',['seller'=>$id])}}"
                                       class="list-group-item list-group-item-action"><i
                                            class="fas fa-cart-arrow-down"></i>Sold Product</a>
                                    <a href="{{route('frontend__.boughtproduct',['buyer'=>$id])}}"
                                       class="list-group-item list-group-item-action"><i class="fas fa-cart-plus"></i>My
                                        Order</a>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            {{--  <h1 style="color:#fff">Proflie </h1>
              <div class="container flex">

                  <div class="card text-white  mb-3"
                       style="min-height: 300px; width: 15rem; border:2px solid #edbf16; margin-left:23px; float:left">
                      <div class="card-header" style="background-color: rgb(153 105 105); text-align: center;">BALANCE
                      </div>
                      <div class="card-body">
                          <?php
                          $balance = 0;
                          $account = DB::table('accounts')->where('seller_id', $id)->first();
                          if (!is_null($account))
                              $balance = $account->balance;
                          ?>
                          <h5 class="card-title" style="color:#edbf16;  text-align:center"><b>{{$balance}}$</b><br>
                              គណនេយ្យ
                          </h5>
                          <?php
                          $total_deposit = DB::table('account_requests')->where([['seller_id', $id], ['transaction_type', 'deposit']])->sum('amount');
                          ?>
                          <p class="card-text">
                              <label style="color:#333">បានចាយៈ </label> <label
                                  style="color:#d10606"><b>0 </b></label><br>
                              <label style="color:#333">បានបញ្ចូលៈ </label><label
                                  style="color:#09bf54"><b>{{ number_format($total_deposit,2) }}
                                      $</b></label><br>
                          <div style="flex: row; margin-top:15px;">
                              <h3 style="text-align:center; color:#08a14d"><b>Top Up</b></h3>
                              <a href="{{route('page',['page'=>5,'about'=>'Top Up'])}}">
                                  <div style="width:40px; float: left">
                                      <img style="width:40px;" src="{{url('photo/img/aba_icon.png')}}" alt="">
                                  </div>
                                  <div style="width:40px; float:left; margin-left: 20px;">
                                      <img style="width:40px;" src="{{url('photo/img/usdt_icon.png')}}" alt="">
                                  </div>
                              </a>
                          </div>
                          </p>
                      </div>
                  </div>


                  <div class="card text-white  mb-3"
                       style="min-height: 300px; max-width: 15rem; border:2px solid #edbf16; margin-left:23px ; float:left">
                      <div class="card-header" style="background-color: rgb(153 105 105); text-align: center;">SELLER
                      </div>
                      <div class="card-body">

                          @if($seller->status==0)
                              <a href="{{route('frontend__.becomeseller')}}" class="btn btn-register"><i
                                      class="fa-solid fa-user-plus"></i> ចុះឈ្មោះលក់</a>
                          @else
                              <?php
                              // $ex=Expenses::select("categories.names","expenses.detail","amount")->join("categories","categories.id","=","expenses.categories_id")->get();

                              // $sell_today = DB::table('sells')->where([['seller_id_seller', $id], ['dates', date('Y-m-d')]])->sum('grand_total');
                              $sell_today = DB::table('products')
                                  ->join('sell_details', 'products.id', '=', 'sell_details.product_id')
                                  ->join('sells', 'sells.id', '=', 'sell_details.sell_id')
                                  ->where([['seller_id', $id], ['dates', date('Y-m-d')]])->sum('sell_details.price');
                              echo '<h5 class="card-title" style="color:#edbf16;  text-align:center"><b>' . $sell_today . '$</b><br>
                  លក់ថ្ងៃនេះ
                  </h5>';
                              ;
                              //$sell_all = DB::table('sells')->where('seller_id_seller', $id)->sum('grand_total');
                              $sell_all = DB::table('products')
                                  ->join('sell_details', 'products.id', '=', 'sell_details.product_id')
                                  ->join('sells', 'sells.id', '=', 'sell_details.sell_id')
                                  ->where('seller_id', $id)->sum('sell_details.price');
                              echo "<div style='color:#333'>លក់សរុបៈ " . number_format($sell_all, 2) . "$</div>";
                              $no_product = App\Models\Product::where('seller_id', $id)->count();
                              echo "<div style='color:#333'>ផលិតផលសរុបៈ $no_product</div>";
                              ?>
                              <div style='color:#333'><a href="{{route('frontend__.monthlysell',['seller'=>$id])}}">របាយការណ៍លក់ប្រចាំខែ</a>
                              </div>
                              <?php
                              $find_hold = DB::table('account_requests')->where([['seller_id', $id], ['status', 0]])->sum('amount');
                              echo "<div style='color:#333'>ទឺកប្រាក់ on hold: <b>" . $find_hold . "$</b></div>";

                              ?>
                              <a href="{{route('frontend__.withdraw',['message'=>'Deposit Request '])}}"
                                 class="btn btn-register">
                                  ស្នើរសុំដកប្រាក់</a>
                          @endif

                      </div>
                  </div>

                  <div class="card text-white  mb-3"
                       style="min-height: 300px; width: 15rem; border:2px solid #edbf16; margin-left:23px; float:left">
                      <div class="card-header" style="background-color: rgb(153 105 105); text-align: center;">
                          CHAT
                      </div>
                      <div class="card-body">
                          <?php
                          $chat_list = DB::table('chat_privates')->where('seller_id_sender', $id)->orWhere('seller_id_receiver', $id)->distinct('seller_id_sender', 'seller_id_receiver')->get();


                          foreach($chat_list as $key=>$cp)
                          {
                          if($cp->seller_id_sender <> $id)
                          {
                          $seller_chat = App\Models\Seller::where('id', $cp->seller_id_sender)->first();
                          ?>
                          <div
                              style="    border: 1px solid #f7c85e; padding: 5px;  color: black;  border-radius: 15px; width:100%; margin-bottom:10px;">
                              <a href="{{route('frontend__.chatseller',['seller'=>$seller_chat->id])}}">
                                  <img src="{{url('photo/img/user_avatar.png')}}"
                                       style="margin-right: 15px; width: 20px; border-radius:15px;"/><?= $seller_chat->full_name ?>
                              </a>
                          </div>
                          <?php
                          }
                          else
                          {
                          $seller_chat = App\Models\Seller::where('id', $cp->seller_id_receiver)->first();


                          ?>
                          <div
                              style="    border: 1px solid #f7c85e; padding: 5px;  color: black;  border-radius: 15px; width:100%; margin-bottom:10px;">
                              <a href="{{route('frontend__.chatseller',['seller'=>$seller_chat->id])}}">
                                  <img src="{{url('photo/img/user_avatar.png')}}"
                                       style="margin-right: 15px; width: 20px; border-radius:15px;"/><?= $seller_chat->full_name ?>
                              </a>


                          </div>
                          <?php
                          }
                          }
                          ?>

                      </div>
                  </div>

                  <div class="card text-white  mb-3"
                       style="min-height: 300px; max-width: 15rem; border:2px solid #edbf16; margin-left:23px; float:left">
                      <div class="card-header" style="background-color: rgb(153 105 105); text-align: center;">
                          PRODUCT
                      </div>
                      <div class="card-body">
                          @if($seller->status==0)
                              <a href="{{route('frontend__.becomeseller')}}" class="btn btn-register"><i
                                      class="fa-solid fa-user-plus"></i> ចុះឈ្មោះលក់</a>
                              <a href="{{route('seller-products.create')}}" class="btn btn-register"> Bought Product</a>
                          @else
                              <a href="{{route('seller-products.index')}}" class="btn btn-register"> My Product List</a>
                              <a href="{{route('seller-products.create')}}" class="btn btn-register"> Add New Product</a>
                              <a href="{{route('frontend__.soldproduct',['seller'=>$id])}}" class="btn btn-default">&raquo
                                  Sold Product</a>
                              <a href="{{route('frontend__.boughtproduct',['buyer'=>$id])}}" class="btn btn-default">&raquo
                                  Bought Product</a>
                          @endif

                      </div>
                  </div>
                  <div class="clearfix"></div>
              </div>--}}
        </div>
    </div>
</x-app-layout>

