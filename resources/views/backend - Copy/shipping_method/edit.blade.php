<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Shipping Method') }}
        </h2>
    </x-slot>
    @include('backend.Lib.edit', [
        'route' => 'shipping-methods.update',
        'id' => 'shipping_method_form',
        'form' => 'backend.shipping_method.form',
        'formName' => 'shipping_method_form',
        'title' => 'Update Shipping Method',
        'model' => $model
    ])
</x-admin-layout>
