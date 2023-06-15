@extends('layouts.app')
@section('body')
    <main class="h-full min-h-screen bg-gradient-to-b from-premier from-75% to-orange-600 py-6 px-4 pb-24">
        <span class="inline-block w-full text-4xl text-center text-white sm:text-5xl md:text-7xl font-batik">
            SEPAKAT NEWS
        </span>
        <div class="px-4 py-2 mx-auto mt-4 bg-white rounded-full shadow-lg sm:px-9 md:px-10 w-fit aspect-auto">
            <div class="flex items-center gap-x-3 sm:gap-x-6">
                <div class="overflow-hidden rounded-md w-fit h-fit">
                    <img src="{{ asset('images/logo-red.png') }}" alt="Logo Telkomsel" class="h-6 sm:h-6 md:h-9">
                </div>
                <div class="overflow-hidden rounded-md w-fit h-fit">
                    <img src="{{ asset('images/logo_sepakat.png') }}" alt="Logo Sepakat" class="h-6 sm:h-6 md:h-9">
                </div>
                <div class="overflow-hidden rounded-md w-fit h-fit">
                    <img src="{{ asset('images/logo-dpw-sepakat-sumbagut.jpeg') }}" alt="Logo DPW Sumbagut"
                        class="w-8 sm:w-10 md:w-12">
                </div>
            </div>
        </div>
        <section id="activity" class="w-full px-3 mt-12">
            <a href="{{ route('news.index') }}"
                class="block text-xl text-white underline sm:text-2xl md:text-4xl font-batik">Aktivitas
                Terbaru <i class="ml-2 text-xs sm:text-sm fa-solid fa-up-right-from-square"></i></a>
            <div
                class="w-full px-2 py-1 mt-6 overflow-x-hidden overflow-y-hidden border-white h-[420px] sm:h-[400px] border-x-2">
                <div class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden">
                    <div id="slider"
                        class="flex items-center justify-start h-full overflow-x-auto transition duration-700 ease-out sm:overflow-x-visible lg:gap-8 md:gap-6 gap-14">
                        @foreach ($news as $key => $news)
                            <div aria-label="cards"
                                class="flex-shrink-0 w-full overflow-hidden bg-white rounded shadow sm:w-2/3 lg:w-1/2">
                                <div class="relative w-full">
                                    <img tabindex="0"
                                        class="object-cover object-center w-full h-48 rounded-t shadow focus:outline-none"
                                        src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->slug }}" />
                                </div>
                                <div class="w-full px-5 pt-2 pb-6 xl:px-7">
                                    <div class="w-full ">
                                        <h2 class="mb-3 text-xl font-bold tracking-normal text-orange-900 xl:mb-0 xl:mr-4">
                                            {{ $news->title }}</h2>
                                        <p tabindex="0"
                                            class="mt-2 mb-4 text-sm leading-5 tracking-normal text-gray-600 focus:outline-none xl:text-left">
                                            {{ $news->headline }}
                                        </p>
                                        <a href="{{ route('news.show', $news->slug) }}"
                                            class="inline-block mt-auto mb-2 font-semibold underline cursor-pointer text-slate-500">Baca
                                            Selengkapnya <i class="ml-2 fa-solid fa-up-right-from-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="justify-center hidden w-full sm:flex gap-x-4">
                <button aria-label="slide backward"
                    class="cursor-pointer focus:outline-none bg-gradient-to-b from-premier from-20% shadow-md hover:shadow-xl transition-all px-3 py-2 rounded-md to-orange-600"
                    id="prev">
                    <svg class="font-bold text-white" width="8" height="14" viewBox="0 0 8 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <button aria-label="slide forward"
                    class="cursor-pointer focus:outline-none bg-gradient-to-b from-premier from-20% shadow-md hover:shadow-xl transition-all px-3 py-2 rounded-md to-orange-600"
                    id="next">
                    <svg class="font-bold text-white" width="8" height="14" viewBox="0 0 8 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-col mx-auto text-center text-white sm:hidden">
                <i class="text-4xl fa-solid fa-left-right"></i>
                <span class="text-lg font-semibold">Swipe</span>
            </div>
        </section>
        <section id="event" class="w-full px-3 mt-12">
            <a href="{{ route('event.index') }}"
                class="block text-xl text-white underline sm:text-2xl md:text-4xl font-batik">Event
                Terdekat<i class="ml-2 text-xs sm:text-sm fa-solid fa-up-right-from-square"></i></a>
            <div class="flex flex-col gap-4 mt-3">
                @forelse ($events as $event)
                    <a href="{{ route('event.show', $event->id) }}"
                        class="flex justify-between items-center p-3 font-semibold text-white transition-all rounded-md hover:shadow-lg hover:to-orange-600 duration-1000 ease-in-out hover:from-40% bg-gradient-to-r from-premier to-premier/70">
                        <div class="flex flex-col w-10/12 gap-y-1">
                            <span class="text-xs italic">{{ date('d M Y', strtotime($event->date)) }}</span>
                            <span class="text-left truncate">{{ $event->title }}</span>
                        </div>
                        <i class="px-2 my-auto text-right align-middle fa-solid fa-angle-right"></i>
                    </a>
                @empty
                    <span class="text-lg text-white">Tidak Ada Event Terbaru</span>
                @endforelse
            </div>
        </section>
    </main>
    @include('components.bottom-nav')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            let defaultTransform = 0;

            $("#next").on("click", goNext);
            $("#prev").on("click", goPrev);

            function goNext() {
                defaultTransform -= 398;
                var slider = $("#slider");
                if (Math.abs(defaultTransform) >= slider[0].scrollWidth / 1.7) {
                    defaultTransform = 0;
                }
                slider.css("transform", "translateX(" + defaultTransform + "px)");
            }

            function goPrev() {
                var slider = $("#slider");
                if (Math.abs(defaultTransform) === 0) {
                    defaultTransform = 0;
                } else {
                    defaultTransform += 398;
                }
                slider.css("transform", "translateX(" + defaultTransform + "px)");
            }

        })
    </script>
@endsection
