@extends('layouts.dashboard', ['plain' => false])
@section('content')
    <div class="w-full max-w-full px-3 mx-auto shrink-0 md:w-11/12 md:flex-0">
        <div
            class="relative flex flex-col w-full min-w-0 px-12 py-4 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
            <div class="w-10/12 mx-auto overflow-hidden rounded h-96">
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}"
                    class="object-cover object-center w-full">
            </div>
            <div class="w-10/12 mx-auto">
                <span class="block mt-4 text-lg font-bold text-gray-600">{{ $event->title }}</span>
                <div class="flex justify-between w-full gap-x-2">
                    <span class="block text-sm text-right text-gray-500 font-base"><i
                            class="mr-2 fa-solid fa-calendar-day"></i>{{ $event->date }}
                    </span>
                    <span class="block text-sm text-right text-gray-500 font-base"><i
                            class="mr-2 fa-solid fa-location-dot"></i>{{ $event->location }}
                    </span>
                    <span class="block text-sm text-right text-gray-500 font-base"><i
                            class="mr-2 fa-solid fa-pencil"></i>{{ $event->author->name }}
                    </span>
                </div>
                <div class="w-full px-4 mt-6 border-gray-500 border-x">
                    {!! $event->caption !!}
                </div>
            </div>
        </div>
    </div>
@endsection
