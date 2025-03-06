<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Shipping Method') }}
        </h2>
    </x-slot>
    @include('backend.Lib.create', [
        'route' => 'shipping-methods.store',
        'id' => 'shipping_method_form',
        'form' => 'backend.shipping_method.form',
        'formName' => 'shipping_method_form',
        'title' => 'Create Shipping Method'
    ])
</x-admin-layout>
