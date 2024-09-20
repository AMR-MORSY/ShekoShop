<x-dashboard-layout>


    <x-admin-form :route="route('devision.update',['devision'=>$devision->id])" title="Edit Devision" target='Edit'>

         <!-- devision name -->
        <div class=" col-span-2 md:col-span-1">
            <x-input-label for="devision_name" :value="__('Name')" />
                <x-text-input id="devision_name" class="block mt-1 w-full" type="text" name="devision_name"
                    :value="old('devision_name', $devision->devision_name)" required autofocus autocomplete="devision_name" />
            <x-input-error :messages="$errors->get('devision_name')" class="mt-2" />

        </div>




        <!---devision desc -->

        <div class=" mt-4 col-span-2">
            <x-input-label for="description" :value="__('Description')" />
                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" required
                    autocomplete="description" :value="old('description', $devision->description)" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

    </x-admin-form>

</x-dashboard-layout>