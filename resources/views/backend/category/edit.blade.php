
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>
    @include('backend.Lib.edit',[
    'route'=>'categories.update',
    'id'=>'product_form',
    'form'=>'backend.category.form',
    'formName'=>'category_form',
    'title'=>'Update Category',
    'model'=>$model
])

</x-admin-layout>
