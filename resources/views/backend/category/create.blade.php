
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catagory') }}
        </h2>
    </x-slot>
    @include('backend.Lib.create',[
    'route'=>'categories.store',
    'id'=>'product_form',
    'form'=>'backend.category.form',
    'formName'=>'product_form',
    'title'=>'Create Catagory'
])

</x-admin-layout>
