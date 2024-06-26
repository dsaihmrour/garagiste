<nav class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 ">
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
        <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
            <a class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white"
                href="/">Garagiste</a><button
                class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                type="button" onclick="toggleNavbar('example-collapse-navbar')">
                <i class="text-white fas fa-bars"></i>
            </button>
        </div>
        <div class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden"
            id="example-collapse-navbar">
            <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">

                <li class="flex items-center">
                    <a class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                        href="#"><i
                            class="lg:text-gray-300 text-gray-500 fab fa-facebook text-lg leading-lg "></i><span
                            class="lg:hidden inline-block ml-2">Share</span></a>
                </li>
                <li class="flex items-center">
                    <a class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                        href=""><i
                            class="lg:text-gray-300 text-gray-500 fab fa-twitter text-lg leading-lg "></i><span
                            class="lg:hidden inline-block ml-2">Tweet</span></a>
                </li>
                <li class="flex items-center">
                    <a class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                        href="#"><i
                            class="lg:text-gray-300 text-gray-500 fab fa-github text-lg leading-lg "></i><span
                            class="lg:hidden inline-block ml-2">Star</span></a>
                </li>
                @php
                    $route;
                @endphp
                @if (Route::has('login'))
                    @auth
                        @if (auth()->user()->roles->contains('name', 'admin'))
                            @php
                                $route = route('admin.dashboard');
                            @endphp
                        @endif
                        @if (auth()->user()->roles->contains('name', 'client'))
                            @php
                                $route = route('client.dashboard');
                            @endphp
                        @endif

                        <li class="flex items-center">
                            <a href="{{ $route }}"
                                class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3"
                                type="button" style="transition: all 0.15s ease 0s;">
                                <i class="fas fa-arrow-alt-circle-down"></i> Dashboard
                            </a>
                        </li>
                    @else
                        <li class="flex items-center">
                            <a href="{{ route('login') }}"
                                class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3"
                                type="button" style="transition: all 0.15s ease 0s;">
                                <span class="mr-2">Login</span> <i class="fas fa-sign-in-alt ml-2"></i>
                            </a>
                            @if (Route::has('register'))
                        <li class="flex items-center">
                            <a href="{{ route('register') }}"
                                class="bg-white text-gray-800 active:bg-gray-100 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3"
                                type="button" style="transition: all 0.15s ease 0s;">
                                <span class="mr-2">Register</span><i class="fas fa-user-plus"></i>
                            </a>
                        </li>
                    @endif
                @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
