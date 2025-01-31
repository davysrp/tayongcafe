
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>
    @include('backend.Lib.edit',[
    'route'=>'products.update',
    'id'=>'product_form',
    'form'=>'backend.product.form',
    'formName'=>'product_form',
    'title'=>'Update Product',
    'model'=>$model
])

</x-admin-layout>
