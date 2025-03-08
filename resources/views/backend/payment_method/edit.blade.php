{{-- 
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Payment Method') }}
        </h2>
    </x-slot>
    @include('backend.Lib.edit',[
    'route'=>'payment-method.update',
    'id'=>'product_form',
    'form'=>'backend.payment_method.form',
    'formName'=>'category_form',
    'title'=>'Update Payment',
    'model'=>$model
])

</x-admin-layout> --}}

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Payment Method') }}
        </h2>
    </x-slot>
    @include('backend.Lib.edit',[
    'route'=>'payment-method.update',
    'id'=>'product_form',
    'form'=>'backend.payment_method.form',
    'formName'=>'category_form',
    'title'=>'Update Payment',
    'model'=>$model
])
</x-admin-layout>