<x-dashboard-layout>
    <h1 class="text-5xl m-3">View Role</h1>
    <div class=" flex flex-col items-center ">
        <div class=" w-full mx-auto rounded-lg  bg-white">
            <div class=" flex justify-around rounded-t-lg bg-blue-200">
                <div class=" w-10 flex-none p-3">Id</div>
                <div class=" w-32 flex-none p-3">Name</div>
                <div class=" w-48 flex-1 text-start p-3">Permissions</div>

            </div>
            <div class=" flex justify-around">
                <div class=" w-10 flex-none p-3">{{ $role->id }}</div>
                <div class="  w-32 flex-none p-3">{{ $role->name }}</div>
                <div class=" w-48 flex-1 text-start p-3">
                    @if (count($permissions) > 0)
                        <div class=" grid grid-cols-4">
                            @foreach ($permissions as $permission)
                         
                                <chip-component lable="{!! $permission !!}"></chip-component>
                            @endforeach

                        </div>
                    @else
                        <p>No Permissions </p>
                    @endif





                </div>
            </div>
            <div class=" border-t-2 border-blue-300 p-2">
                <a type="button"
                    class=" focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 "href="{{ route('role.edit', ['role' => $role->id]) }}">Edit
                </a>
            </div>

        </div>



    </div>


</x-dashboard-layout>
