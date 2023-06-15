@extends('layouts.app')
@section('body')
    <main class="h-full min-h-screen bg-gradient-to-b from-premier from-75% to-orange-600 py-6 px-6 pb-24">
        <span class="inline-block w-full text-3xl text-center text-white sm:text-5xl font-batik">
            AKTIVITAS SEPAKAT
        </span>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2">
            @forelse ($news as $key => $data)
                <div aria-label="cards" class="flex-shrink-0 w-full overflow-hidden bg-white rounded shadow 1">
                    <div class="relative w-full 2">
                        <img tabindex="0" class="object-cover object-center w-full h-48 rounded-t shadow focus:outline-none"
                            src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->slug }}" />
                    </div>
                    <div class="w-full px-5 pt-2 pb-6 xl:px-7">
                        <div class="w-full ">
                            <h2 class="mb-3 text-xl font-bold tracking-normal text-orange-900 xl:mb-0 xl:mr-4">
                                {{ $data->title }}</h2>
                            <p tabindex="0"
                                class="mt-2 mb-4 text-sm leading-5 tracking-normal text-gray-600 focus:outline-none xl:text-left">
                                {{ $data->headline }}
                            </p>
                            <a href="{{ route('news.show', $data->slug) }}"
                                class="inline-block mt-auto mb-2 font-semibold underline cursor-pointer text-slate-500">Baca
                                Selengkapnya <i class="ml-2 fa-solid fa-up-right-from-square"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <span class="text-lg italic text-center text-gray-200 col-span-full ">Tidak Ada Aktivitas</span>
            @endforelse
        </div>
        @if ($news)
            <div class="my-6">
                {{ $news->links('components.pagination', ['data' => $news]) }}
            </div>
        @endif
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
