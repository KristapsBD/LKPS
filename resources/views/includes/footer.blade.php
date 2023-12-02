<footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center center sm:justify-between">
            <a href="{{ route('home')  }}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">LCMS</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
{{--                    TODO IMPLEMENT TRACKING PAGE--}}
                    <a href="{{ route('home') }}" class="hover:underline me-4 md:me-6">Tracking</a>
                </li>
                @auth
                    <li>
                        <a href="{{ route('parcel.step1') }}" class="hover:underline me-4 md:me-6">Create Parcel</a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="hover:underline me-4 md:me-6">Log in</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="hover:underline me-4 md:me-6">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="{{ route('home') }}" class="hover:underline">Logistics and Courier Management System™</a>. All Rights Reserved.</span>
    </div>
</footer>
