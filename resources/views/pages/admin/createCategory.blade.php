<x-dashboard-layout>
    <x-admin-form route="category.store" title="Create Category" target='Create'>

          <!-- category name -->

        <div class=" col-span-4 lg:col-span-1">
            <x-input-label for="devision_name" :value="__('Name')" />
          
                <x-text-input id="category_name" class="block mt-1 w-full" type="text" name="category_name"
                    :value="old('category_name')" required autofocus autocomplete="category_name" />
            <x-input-error :messages="$errors->get('category_name')" class="mt-2" />

        </div>

        <!---category desc -->

        <div class="col-span-4 lg:col-span-3">
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" required
                autocomplete="description" :value="old('description')" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!------Category devisoin Id------->
        <div class="col-span-4 md:col-span-2">
            <x-input-label for="devision_id" :value="__('Devision')" />
        <select name="devision_id" id="devision_id" class="product-text-input">
            @foreach ($devisions as $devision)
                <option value="{{ $devision->id }}">{{ $devision->devision_name }}</option>
            @endforeach


        </select>
        </div>
    </x-admin-form>

</x-dashboard-layout>
