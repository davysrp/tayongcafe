<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Intervention\Image\Facades\Image;

class Helper
{

    public static function navbar()
    {
        return [
            [
                'menu_name' => 'Dashboard',
                'icon' => '<i class="fas fa-fw fa-tachometer-alt"></i>',
                'permission' => '',
                'route' => \Route::has('adminDashboard') ? route("adminDashboard") : '#',
            ],


            [
                'menu_name' => 'Web Page',
                'icon' => '<i class="fas fa-globe"></i>',
                'permission' => '',
                'route' => \Route::has('web-pages.index') ? route("web-pages.index") : '#',
                
                
                
            ],

            
            // [
            //     'menu_name' => 'Sell Management',
            //     'icon' => '<i class="fas fa-money-check-alt"></i>',
            //     'permission' => '',
            //     'child' => [
            //         // [
            //         //     'menu_name' => 'Sale Dashboard',
            //         //     'icon' => '',
            //         //     'permission' => '',
            //         //     'route' => \Route::has('saleDashboard') ? route('saleDashboard') : '#',
            //         // ],
            //         [
            //             'menu_name' => 'Sales by Table',
            //             'icon' => '',
            //             'permission' => '',
            //             'route' => \Route::has('saleForm') ? route('saleForm', ['table' => 1]) : '#', // Default table = 1
            //         ],
            //     ]
            // ],
            

            [
                'menu_name' => 'Sell Dashboard',
                'icon' => '<i class="fas fa-money-check-alt"></i>',
                'permission' => '',
                // 'route' => \Route::has('saleDashboard') ? route("saleDashboard") : '#',
                'route' => \Route::has('saleForm') ? route('saleForm', ['table' => 1]) : '#',
            ],

            
            [
                'menu_name' => 'Product',
                'icon' => '',
                'permission' => '',
                'child' => [
                    [
                        'menu_name' => 'Category',
                        'icon' => '',
                        'permission' => '',
                        'route' => \Route::has('categories.index') ? route("categories.index") : '#',
                    ],
                    [
                        'menu_name' => 'Product',
                        'icon' => '',
                        'permission' => '',
                        'route' => \Route::has('products.index') ? route("products.index") : '#',
                    ],

                ]
                ],

            [
                'menu_name' => 'Coupon Code',
                'icon' => '<i class="fas fa-gifts"></i>',
                'permission' => '',
                'route' => \Route::has('coupon-code.index') ? route("coupon-code.index") : '#',
            ],

            [
                'menu_name' => 'Customers',
                'icon' => '<i class="fas fa-gifts"></i>',
                'permission' => '',
                'route' => \Route::has('customers.index') ? route("customers.index") : '#',
            ],

            [
                'menu_name' => 'Admin',
                'icon' => '<i class="fas fa-users"></i>',
                'permission' => '',
                'route' => \Route::has('users.index') ? route("users.index") : '#',
            ],

            [
                'menu_name' => 'Payment Method',
                'icon' => '<i class="fas fa-money-check"></i>',
                'permission' => '',
                'route' => \Route::has('payment-method.index') ? route("payment-method.index") : '#',
            ],

            // [
            //     'menu_name' => 'Shipping Method',
            //     'icon' => '<i class="fas fa-money-check"></i>',
            //     'permission' => '',
            //    // 'route' => \Route::has('shipping-method.index') ? route("shipping-method.index") : '#',
            //     'route' => \Route::has('shipping-methods.index') ? route("shipping-methods.index") : '#',

            // ],




                [
                    'menu_name' => 'Reports',
                    'icon' => '<i class="fas fa-money-check"></i>',
                    'permission' => '',
                    'route' => \Route::has('report.index') ? route("report.index") : '#',
                    
                ],
        ];
    }

    public static function datatable($fields, $table_name, $addNew = 1,$route)
    {
        $html = $addNew ? '<a class="btn btn-primary"  href="'.$route.'" ><i class="fas fa-plus"></i> Add New</a>' : '';
        $html .= '<div class="row mb-3"></div>';
        $html .= '<table id="' . $table_name . '" class="table table-bordered" width="100%">';
        $html .= '<thead> <tr>';
        foreach ($fields as $field) {
            $html .= '<th>' . $field['label'] . '</th>';
        }
        $html .= '</tr></thead>';
        $html .= '<tbody></tbody>';
        $html .= '<table>';
        return $html;
    }

    public static function Form($model, $size, $title, $modalBody, $route, $formName)
    {


        $html = \Form::open(['route' => $route, 'id' => $formName, 'enctype' => 'multipart/form-data']);
        $html .=$modalBody;
        $html .= \Form::close();

        return $html;
    }

    public static function alertSuccess()
    {
        $script = 'Swal.fire({
  title: "Success!",
  text: "Record save successfully",
  icon: "success"
});';
        return $script;
    }

    public static function alertDeleteSuccess()
    {
        $script = 'Swal.fire({
  title: "Success!",
  text: "Record delete successfully",
  icon: "success"
});';
        return $script;
    }

    public static function alertError($message)
    {
        $script = 'Swal.fire({
  icon: "error",
  title: "Oops...",
  text: ' . $message . ',
});';
        return $script;

    }


    public static function dateFormat($date)
    {
        return Carbon::parse($date)->format('d/m/Y H:i:s');
    }

    public static function statusLabel($status)
    {
        $msg = '';
        if ($status == 0) $msg = '<span class="badge badge-danger">Inactive</span>';
        if ($status == 1) $msg = '<span class="badge badge-danger">Active</span>';
        return $msg;
    }

    public function uploadImage(Request $request)
    {

    }

    public static function imageOpt($photo, $destinationPath)
    {
        $newName = rand(100000, 999999) . date('YmdHis');
        $imgwidth = Image::make($photo->path())->getWidth();
        $imgHeigh = Image::make($photo->path())->getHeight();
        $percentOptm = 100 - (720 * 100 / $imgwidth);
        $width = $imgwidth - (($imgwidth / 100) * $percentOptm);
        $height = $imgHeigh - (($imgHeigh / 100) * $percentOptm);

        $imageFile = $newName . '.jpg';
        $img = Image::make($photo->path());
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($destinationPath . '/' . $imageFile);
        return $imageFile;
    }

    public static function alertSuccessToast($message)
    {
        $mgs = 'Swal.fire({
                        toast: true,
                        icon: "hh",
                        title:"hh",
                        animation: false,
                        position:"mjjj",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener(\'mouseenter\', Swal.stopTimer)
                          toast.addEventListener(\'mouseleave\', Swal.resumeTimer)
                        }
                      })';
        return $mgs;
    }

    public static function merchantInfo()
    {
        return [
            'bakongAccountID' => "sophath_9999@aclb",
            "merchantName" => "KHMMO.COM",
            "merchantCity" => "Phnom Penh",
            "merchantId" => "007168",
            "acquiringBank" => "Bakong Bank",
        ];
    }

    public static function merchantOptionalInfo()
    {
        $inv = \Str::upper(uniqid());
        $invoice = substr($inv, 0, 4) . '-' . substr($inv, 4, 5) . '-' . substr($inv, 9);
        return [
            "mobileNumber" => "85599330067",
            "storeLabel" => "KHMMO.COM",
            "terminalLabel" => "khqr",
            "billNumber" => $invoice,
        ];
    }

    public  function invoice()
    {
        $inv = \Str::upper(uniqid());
        $invoice = substr($inv, 0, 4) . '-' . substr($inv, 4, 5) . '-' . substr($inv, 9);
        return $invoice;
    }

}
