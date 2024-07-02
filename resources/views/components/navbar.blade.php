<nav class="bg-Purple text-white">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <div class="hidden w-full md:block md:w-auto" id="navbar-default">

            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0  md:dark:bg-gray-900">
                <li>
                    <a href="/"
                        class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent  md:p-0 md:dark:text-blue-500"
                        aria-current="page">Home</a>
                </li>
                @foreach ($devisions as $devision)
                    <li>
                        <a href="{{ route('usersDevision.show', ['devision' => $devision->slug]) }}"
                            class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent  md:p-0 md:dark:text-blue-500"
                            aria-current="page">{{ $devision->devision_name }}</a>
                    </li>
                @endforeach
                @hasanyrole('Super-Admin|Admin')
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent">Dashboard</a>
                    </li>
                @endhasanyrole





                @if (Auth::check())
                    @session('logout')
                    <div>
                        <logging />
                    </div>
                        
                    @endsession
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent">Logout</button>
                        </form>

                    </li>
                    <li>
                        welcome! {{ Auth::user()->first_name }}
                    </li>
                    <div>
                        <logging user={{ Auth::user() }} />
                    </div>

              


                @endif
                @if (!Auth::check())
                    <li>
                        <a href="{{ route('register') }}"
                            class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent">Register</a>


                    </li>
                    <li>
                        <a href="{{ route('login') }}"
                            class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent">Login</a>
                    </li>
                @endif
                <div>
                    <cart-icon />
                </div>
                <div>
                    <cart-products-count />
                </div>










            </ul>
          



        </div>



    </div>
</nav>
