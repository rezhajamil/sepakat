@extends('layouts.app')
@section('body')
    <main class="h-full min-h-screen bg-gradient-to-b from-premier from-75% to-orange-600 py-6 px-4 pb-24">
        <span class="inline-block w-full text-2xl text-center text-white sm:text-5xl md:text-3xl font-batik">
            {{ $event->title }}
        </span>
        <div class="w-full mx-auto overflow-hidden rounded-lg sm:w-10/12 h-64 sm:h-[500px] mt-8 mb-4">
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                class="object-cover object-center w-full h-full">
        </div>
        <div class="flex justify-between w-full py-1 mx-auto border-b-2 border-white sm:w-10/12">
            <div class="flex items-center text-sm font-semibold text-white gap-x-2">
                <i class="fa-solid fa-calendar-days"></i>
                <span class="">{{ date('d M Y', strtotime($event->date)) }}</span>
            </div>
            <div class="flex items-center text-sm font-semibold text-white gap-x-2">
                <i class="fa-solid fa-location-dot"></i>
                <span class="">{{ $event->location ?? '-' }}</span>
            </div>
            <div class="flex items-center text-sm font-semibold text-white gap-x-2">
                <i class="fa-solid fa-pencil"></i>
                <span class="">{{ $event->author->name }}</span>
            </div>
        </div>
        <div class="flex justify-between w-full py-2 mx-auto text-white sm:w-10/12">
            {!! $event->caption !!}
        </div>
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
