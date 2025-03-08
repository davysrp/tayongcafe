
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Admin') }}
        </h2>
    </x-slot>
    @include('backend.Lib.create',[
    'route'=>'users.store',
    'id'=>'product_form',
    'form'=>'backend.users.form',
    'formName'=>'product_form',
    'title'=>'Create User Admin'
])

</x-admin-layout>
