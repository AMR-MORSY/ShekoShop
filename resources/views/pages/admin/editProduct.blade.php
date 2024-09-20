<x-dashboard-layout>

  
    <x-admin-form :route="route('product.update',['product'=>$product->id])" title="Edit Product" target='Edit'>

        <x-create-product-form-attributes target='create' :displayAttribute="$displayAttribute" :product="$product"/>
    </x-admin-form>
</x-dashboard-layout>