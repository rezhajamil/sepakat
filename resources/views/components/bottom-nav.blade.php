<div
    class="fixed z-50 w-10/12 px-2 py-1 mx-auto bg-white rounded-lg shadow-xl md:w-1/3 drop-shadow-xl left-4 right-4 bottom-2">
    <div class="flex justify-around w-full gap-x-3 h-fit">
        <a href="{{ route('home') }}"
            class="flex flex-col items-center w-full p-2 text-xs font-semibold text-orange-600 transition-all ease-in-out rounded whitespace-nowrap sm:text-base hover:bg-orange-600 hover:text-white">
            <i class="fa-solid fa-home"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('survey.index') }}"
            class="flex flex-col items-center w-full p-2 text-xs font-semibold text-orange-600 transition-all ease-in-out rounded whitespace-nowrap sm:text-base hover:bg-orange-600 hover:text-white">
            <i class="fa-solid fa-pencil"></i>
            <span>Survey</span>
        </a>
        @auth
            <a href="{{ route('profile') }}"
                class="flex flex-col items-center w-full p-2 text-xs font-semibold text-orange-600 transition-all ease-in-out rounded whitespace-nowrap sm:text-base hover:bg-orange-600 hover:text-white">
                <i class="fa-solid fa-user"></i>
                <span>Profile</span>
            </a>
            <a href="{{ route('logout') }}"
                class="flex flex-col items-center w-full p-2 text-xs font-semibold text-orange-600 transition-all ease-in-out rounded whitespace-nowrap sm:text-base hover:bg-orange-600 hover:text-white">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Sign Out</span>
            </a>
        @else
            <a href="{{ route('login') }}"
                class="flex flex-col items-center w-full p-2 text-xs font-semibold text-orange-600 transition-all ease-in-out rounded whitespace-nowrap sm:text-base hover:bg-orange-600 hover:text-white">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Sign In</span>
            </a>
        @endauth
    </div>
</div>
