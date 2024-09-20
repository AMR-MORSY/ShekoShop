<x-dashboard-layout>
    <x-admin-form :route="route('category.update',['category'=>$category->id])" title="Edit Category" target='Edit'>

        <div class=" col-span-2 md:col-span-1">
            <x-input-label for="devision_name" :value="__('Name')" />
            <!-- category name -->
            <x-text-input id="category_name" class="block mt-1 w-full" type="text" name="category_name" :value="old('category_name', $category->category_name)"
                required autofocus autocomplete="category_name" />
            <x-input-error :messages="$errors->get('category_name')" class="mt-2" />
        </div>

        <!---category desc -->

        <div class=" mt-4 col-span-2 md:col-span-1">
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" required
                autocomplete="description" :value="old('description', $category->description)" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!------Category devisoin Id------->

        <select name="devision_id" id="devision_id">
            @foreach ($devisions as $devision)
                <option value="{{ $devision->id }}" @selected($category->devision->id == $devision->id)>
                    {{ $devision->devision_name }}</option>
            @endforeach


        </select>

    </x-admin-form>

</x-dashboard-layout>
