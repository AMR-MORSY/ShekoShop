<x-guest-layout>
    <x-slot  name='title'>
        {{ $title }}
    </x-slot>
    <x-slot name='description'>
        {{ $description }}
    </x-slot>
   



    <x-intro-section title="{{$title}}"></x-intro-section>




    <section>
      {{$slot}}
    </section>

    

</x-guest-layout>
