@extends('layouts.app')
@section('body')
    <main class="w-screen h-full min-h-screen bg-gradient-to-b from-premier from-75% to-orange-600 py-6 px-4 pb-24">
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
            <span class="block text-xl text-white underline sm:text-2xl md:text-4xl font-batik">Aktivitas Terbaru</span>
            <div
                class="w-full px-2 py-1 mt-6 overflow-x-hidden overflow-y-hidden border-white h-[420px] sm:h-[400px] border-x-2">
                <div class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden">
                    <div id="slider"
                        class="flex items-center justify-start h-full transition duration-700 ease-out lg:gap-8 md:gap-6 gap-14">
                        <div aria-label="cards" class="w-full overflow-hidden bg-white rounded shadow sm:w-2/3 lg:w-1/2">
                            <div class="relative w-full">
                                <img tabindex="0"
                                    class="object-cover object-center w-full h-48 rounded-t shadow focus:outline-none"
                                    src="https://tuk-cdn.s3.amazonaws.com/assets/components/grid_cards/gc_29.png"
                                    alt="mountains cover" />
                            </div>
                            <div class="w-full px-5 pt-2 pb-6 xl:px-7">
                                <div class="w-full ">
                                    <h2 class="mb-3 text-2xl font-medium tracking-normal xl:mb-0 xl:mr-4">
                                        Marshall Mathers</h2>
                                    {{-- <div
                                        class="flex flex-col items-center justify-between mb-3 text-center xl:text-left xl:mb-0 xl:flex-row xl:justify-start">
                                        <a tabindex="0" class="text-gray-800 focus:outline-none ">
                                        </a>
                                    </div> --}}
                                    <p tabindex="0"
                                        class="mt-2 mb-4 text-sm leading-5 tracking-normal text-gray-600 focus:outline-none xl:text-left">
                                        HI, I am a direct response copywriter from the US. When you work with me, we
                                        have the same goal. Maximizing your ROI
                                    </p>
                                    <a href=""
                                        class="inline-block mt-auto mb-2 font-semibold underline cursor-pointer text-slate-500">Baca
                                        Selengkapnya <i class="ml-2 fa-solid fa-up-right-from-square"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <button aria-label="slide backward"
                    class="absolute left-0 z-30 ml-10 cursor-pointer focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
                    id="prev">
                    <svg class="dark:text-gray-900" width="8" height="14" viewBox="0 0 8 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <button aria-label="slide forward"
                    class="absolute right-0 z-30 mr-10 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
                    id="next">
                    <svg class="dark:text-gray-900" width="8" height="14" viewBox="0 0 8 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button> --}}
                {{-- <div class="relative flex items-center justify-center w-full">
                </div> --}}
                {{-- <div class="flex items-center justify-center w-full h-full px-4 py-24 sm:py-8">
                </div> --}}




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
