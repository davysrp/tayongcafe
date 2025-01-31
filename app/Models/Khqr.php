<?php


namespace App\Models;


use Illuminate\Support\Str;

class Khqr
{
    public static function merchantInfo()
    {
        return [
            'bakongAccountID' => "sophath_9999@aclb",
            "merchantName" => "Tanyong Cafe",
            "merchantCity" => "Phnom Penh",
            "merchantId" => "007168",
            "acquiringBank" => "Bakong Bank",
        ];
    }

    public static function merchantOptionalInfo()
    {
        $inv = Str::upper(uniqid());
//        $invoice = substr($inv, 0, 4) . '-' . substr($inv, 4, 5) . '-' . substr($inv, 9);
        $invoice = Sell::invoiceNo();
        return [
            "mobileNumber" => "85599330067",
            "merchantName" => "Tanyong Cafe",
            "terminalLabel" => "khqr",
            "billNumber" => $invoice,
        ];
    }

    public  function invoice()
    {
        $inv = Str::upper(uniqid());
        $invoice = substr($inv, 0, 4) . '-' . substr($inv, 4, 5) . '-' . substr($inv, 9);
        return $invoice;
    }
}
