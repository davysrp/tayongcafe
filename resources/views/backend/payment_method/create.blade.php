{{-- 
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Method') }}
        </h2>
    </x-slot>
    @include('backend.Lib.create',[
    'route'=>'payment-method.store',
    'id'=>'product_form',
    'form'=>'backend.payment_method.form',
    'formName'=>'product_form',
    'title'=>'Create Payment Method',
])

</x-admin-layout> --}}


<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Method') }}
        </h2>
    </x-slot>
    @include('backend.Lib.create',[
    'route'=>'payment-method.store',
    'id'=>'product_form',
    'form'=>'backend.payment_method.form',
    'formName'=>'product_form',
    'title'=>'Create Payment Method',
])
</x-admin-layout>
