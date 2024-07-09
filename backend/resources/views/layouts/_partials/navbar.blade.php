<nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
        <a href="{{ route('post.index') }}" class="flex items-center">
            <!-- <img src="https://www.svgrepo.com/show/499962/music.svg" class="h-6 mr-3 sm:h-9" alt="Landwind Logo"> -->
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">FerreCol</span>
        </a>
        <div class="flex items-center lg:order-2">
            <div class="hidden mt-2 mr-4 sm:inline-block">
                <span></span>
            </div>
            
            <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
                <button type="button" data-dropdown-toggle="language-dropdown-menu" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">
                    {{ '@'.Auth::user()->username }}
                </button>
                <!-- Dropdown -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700" id="language-dropdown-menu">
                    <ul class="py-2 font-medium" role="none">
                    <li>
                        <a href="{{ route('user.show', Auth::user()->id) }}" class="block font-semibold px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                        <div class="inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>

                            Perfil
                        </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 font-semibold dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                        <div class="inline-flex items-center">
                            
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z" clip-rule="evenodd" />
                        </svg>


                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit">Salir</button>
                            </form>

                        </div>
                        </a>
                    </li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</nav>