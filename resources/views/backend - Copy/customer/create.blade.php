<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer') }}
        </h2>
    </x-slot>
    @include('backend.Lib.create',[
    'route'=>'customers.store',
    'id'=>'customer_form',
    'form'=>'backend.customer.form',
    'formName'=>'customer_form',
    'title'=>'Create Customer'
])
</x-admin-layout>