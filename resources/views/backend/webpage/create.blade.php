
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('WebPage') }}
        </h2>
    </x-slot>
    @include('backend.Lib.create',[
    'route'=>'web-pages.store',
    'id'=>'product_form',
    'form'=>'backend.webpage.form',
    'formName'=>'product_form',
    'title'=>'Create Web Page',
])

</x-admin-layout>
