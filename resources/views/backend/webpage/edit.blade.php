
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Webpage') }}
        </h2>
    </x-slot>
    @include('backend.Lib.edit',[
    'route'=>'web-pages.update',
    'id'=>'product_form',
    'form'=>'backend.webpage.form',
    'formName'=>'category_form',
    'title'=>'Update Webpage',
    'model'=>$model
])

</x-admin-layout>
