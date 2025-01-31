<x-app-layout>
    <?php
    $id = Auth::guard('seller')->user()->id;
    $seller = App\Models\Seller::find($id);

    ?>
    <div style="padding-top:50px;">
        <div class="container">

            <div class="post-product-container">
                <h1 style="text-align:center; font-size: 32px;">ស្នើរសុំដកប្រាក់</h1>


                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{$err}}</li>
                        @endforeach
                    </ul>
                @endif

                <div style="text-align:center; color:#fd1313">
                    <?php
                    if (request()->has('message')) {
                        //echo request()->has('message');
                    } else {
                        echo $message;
                    }
                    ?>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">


                        <form method="POST" action="{{ route('frontend__.saverequest') }}">

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
                                <label>ចំនួនលុយ on hold: <b>${{number_format($on_hold,2)}}</b> </label> <br>
                                <label>ចំនួនលុយក្នុងគណនី: <b>${{number_format($balance,2)}}</b></label><br>
                                <label>ចំនួនលុយស្នើរសុំដក: </label>
                                <input type="text" name="amount" class="form-control">
                            </div>


                            <div class="col-12 ">
                                <input type="hidden" name="id_customer" value="{{Auth::guard('seller')->user()->id}}">
                                <button type="submit" class="btn btn-primary">ដាក់ស្នើរសុំ</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
