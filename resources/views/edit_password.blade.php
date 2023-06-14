@extends('layouts.dashboard', ['plain' => true])
@section('body')
    <!-- Page title starts -->
    <div class="relative z-10 pt-8 pb-16 bg-premier">
        <div class="container flex flex-col items-start justify-between px-6 mx-auto lg:flex-row lg:items-center">
            <div class="flex flex-col items-start lg:items-center">
                <div class="flex justify-between my-6 ml-0 lg:ml-20 lg:my-0 gap-x-6">
                    {{-- <h4 class="mb-2 text-2xl font-bold leading-tight text-white">Profile</h4> --}}
                    <a href="{{ route('profile') }}"
                        class="px-8 py-2 text-sm font-semibold text-white transition duration-150 ease-in-out border rounded bg-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-400 hover:bg-orange-600"><i
                            class="mr-2 fa-solid fa-arrow-left-long"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page title ends -->
    <div class="container relative z-20 px-6 mx-auto -mt-8">
        <form action="{{ route('user.update_password', $user->id) }}" method="POST" enctype="multipart/form-data"
            class="relative flex flex-col w-3/4 min-w-0 mx-auto break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
            @csrf
            @method('put')
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <div class="flex items-center">
                    <button type="submit"
                        class="inline-block px-8 py-2 mb-4 ml-auto text-xs font-bold leading-normal text-center text-white align-middle transition-all ease-in !bg-orange-500 border-0 rounded-lg shadow-md cursor-pointer tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">Simpan</button>
                </div>
            </div>
            <div class="flex-auto p-6">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full h-48 max-w-full px-3 mb-4 overflow-hidden rounded-md shrink-0 md:flex-0"
                        id="image-preview" style="display: none">

                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="password"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">PASSWORD</label>
                            <input type="password" name="password"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-500 focus:outline-none" />
                            @error('password')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="password_confirmation"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">KONFIRMASI PASSWORD</label>
                            <input type="password" name="password_confirmation"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-500 focus:outline-none" />
                            @error('password_confirmation')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('components.bottom-nav')
@endsection
