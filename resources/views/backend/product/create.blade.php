
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>
    @include('backend.Lib.create',[
    'route'=>'products.store',
    'id'=>'product_form',
    'form'=>'backend.product.form',
    'formName'=>'product_form',
    'title'=>'Create Product'
])

</x-admin-layout>
