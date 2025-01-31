<x-app-layout>
    <div class="container">
<?php
$is_me=Auth::guard('seller')->user()->id;
$receiver=$seller;
$id_chat="";
$chk1=App\Models\ChatPrivate::where([['seller_id_sender',$is_me],['seller_id_receiver',$receiver]])->first();
if(is_null($chk1))
{
    $chk2=App\Models\ChatPrivate::where([['seller_id_sender',$receiver],['seller_id_receiver',$is_me]])->first();
    if(is_null($chk2))
    {
        $add_chat=new App\Models\ChatPrivate();
        $add_chat->seller_id_sender=$is_me;
        $add_chat->seller_id_receiver=$receiver;
        $add_chat->owner_id=$is_me;
        $add_chat->save();

        $id_chat=$add_chat->id;

    }
    else{
        $id_chat=$chk2->id;
    }
}
else{
    $id_chat=$chk1->id;
}

$chat_list=DB::table('chat_details')->where('chat_id',$id_chat)->get();

foreach($chat_list as $key=>$chat)
{
    $seller=DB::table('sellers')->where('id',$chat->seller_id)->first();
    if($chat->seller_id==$is_me)
    {
        $css=" padding:5px; background:#b0eba9; border-radius:15px; ";
        $box="margin-left:50%; margin-bottom:15px;";
    }
    else{
        $css=" padding:5px; background:#e5c0c0; border-radius:15px; ";
        $box="float:left; width:40%; margin-bottom:10px;";
    }

    echo"
    <div style='$box'>";
    ?>
    <p style="float:left; margin-bottom:0"><img src="{{url('photo/img/user_avatar.png')}}" style="margin-right: 15px; width: 20px; border-radius:15px;" /><?= $seller->full_name ?></p>

    <?php

    echo"<p style='margin-bottom:-10px; float:left; padding-left:20px; padding-top:5px; color: #6e6868; font-size: 12px; font-style: italic;'>$chat->created_at</p>";
    echo"<div style='clear:both'></div>";
    echo"  <div style='$css'>$chat->message</div>


    </div>
    ";
   echo"<div style='clear:both'></div>";

}
echo"<div style='clear:both'></div>";
?>
<form action="{{route('frontend__.sendchat')}}" method="POST">
@csrf
@method('post')
    <input type="hidden" name="sender" value="{{$is_me}}" />
    <input type="hidden" name="receiver" value="{{$receiver}}">
<input type="hidden" name="chat_id" value="{{$id_chat}}" />
<div style="width:80%">
<div style="width:80%; float:left">
    <textarea class="form-control" name="message" id="" cols="30" rows="2"></textarea>
</div>
<div style="width:20%; float:left">
    <input class="btn btn-register" type="submit" name="sub" value="Send">
</div>
</div>
</form>
    </div>
</x-app-layout>
