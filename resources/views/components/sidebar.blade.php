<aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">
    <div class="h-19">
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="{{ route('home') }}">
            <div class="flex items-center gap-x-2">
                <span class="block ml-1 text-lg font-semibold transition-all duration-200 ease-nav-brand">Dashboard
                    Sepakat</span>
            </div>
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent " />

    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            <li class="mt-0.5 w-full">
                <a class="py-2.7 bg-orange-500/20 text-sm cursor-pointer ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                    href="{{ route('dashboard') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        {{-- <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i> --}}
                        <i class="mr-2 font-semibold text-orange-400 fa-solid fa-desktop"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class=" py-2.7 text-sm ease-nav-brand cursor-pointer hover:bg-orange-500/10 rounded-lg my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.news.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        {{-- <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i> --}}
                        <i class="mr-2 font-semibold text-orange-500 fa-solid fa-newspaper"></i>
                    </div>
                    <span
                        class="ml-1 duration-300 opacity-100 pointer-events-none ease @if (request()->segment(2) == 'news') text-orange-500 font-bold @endif">Berita
                    </span>
                </a>
            </li>
            <li class="mt-0.5 w-full">
                <a class=" py-2.7 text-sm ease-nav-brand cursor-pointer hover:bg-orange-500/10 rounded-lg my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.event.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        {{-- <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i> --}}
                        <i class="mr-2 font-semibold text-orange-700 fa-solid fa-calendar-days"></i>
                    </div>
                    <span
                        class="ml-1 duration-300 opacity-100 pointer-events-none ease @if (request()->segment(2) == 'event') text-orange-700 font-bold @endif">Event
                    </span>
                </a>
            </li>
            <li class="mt-0.5 w-full">
                <a class=" py-2.7 text-sm ease-nav-brand cursor-pointer hover:bg-orange-500/10 rounded-lg my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.survey.index') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        {{-- <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i> --}}
                        <i class="mr-2 font-semibold text-orange-700 fa-solid fa-pencil"></i>
                    </div>
                    <span
                        class="ml-1 duration-300 opacity-100 pointer-events-none ease @if (request()->segment(2) == 'survey') text-orange-700 font-bold @endif">Survey
                    </span>
                </a>
            </li>
        </ul>
    </div>

</aside>
