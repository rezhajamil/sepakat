@extends('layouts.dashboard', ['plain' => true])
@section('body')
    <!-- Page title starts -->
    <div class="relative z-10 pt-8 pb-16 bg-premier">
        <div class="container flex flex-col items-start justify-between px-6 mx-auto lg:flex-row lg:items-center">
            <div class="flex flex-col items-start lg:items-center">
                <div class="flex items-center">
                    <img role="img" class="mr-3 border-2 border-gray-600 rounded-full shadow w-14 h-14 aspect-square"
                        src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/profile.png') }}"
                        alt="{{ $user->name }}" />
                    <div>
                        <p class="mb-1 leading-4 text-white">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="flex justify-between my-6 ml-0 lg:ml-20 lg:my-0 gap-x-6">
                    {{-- <h4 class="mb-2 text-2xl font-bold leading-tight text-white">Profile</h4> --}}
                    <a href="{{ route('user.edit', $user->id) }}"
                        class="px-8 py-2 text-sm font-semibold text-white transition duration-150 ease-in-out bg-orange-600 border rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-700 hover:bg-slate-400">Edit
                        Profile</a>
                    <a href="{{ route('user.edit_password', $user->id) }}"
                        class="px-8 py-2 text-sm font-semibold text-white transition duration-150 ease-in-out border rounded bg-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-400 hover:bg-orange-600">Ganti
                        Password</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page title ends -->
    <div class="container px-6 mx-auto">
        <!-- Remove class [ h-64 ] when adding a card block -->
        <div
            class="relative z-10 flex flex-col gap-x-8 h-fit gap-y-4 px-6 sm:px-16 py-6 mx-auto mb-8 -mt-8 text-lg bg-white rounded shadow sm:!flex-row text-slate-500 w-fit">
            <div class="flex items-center text-sm gap-x-2 sm:text-base">
                <i class="fa-solid fa-id-card"></i>
                <span class="">{{ $user->nik }}</span>
            </div>
            <div class="flex items-center text-sm gap-x-2 sm:text-base">
                <i class="fa-solid fa-phone"></i>
                <span class="">{{ $user->phone }}</span>
            </div>
            <div class="flex items-center text-sm gap-x-2 sm:text-base">
                <i class="fa-solid fa-envelope"></i>
                <span class="">{{ $user->email }}</span>
            </div>
        </div>
    </div>
    @include('components.bottom-nav')
@endsection
