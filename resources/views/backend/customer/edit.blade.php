<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Customer') }}
        </h2>
    </x-slot>
    @include('backend.Lib.edit',[
    'route'=>'customers.update',
    'id'=>'customer_form',
    'form'=>'backend.customer.form',
    'formName'=>'customer_form',
    'title'=>'Update Customer',
    'model'=>$model
])
</x-admin-layout>