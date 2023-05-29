@extends('layouts.dashboard', ['plain' => false])
@section('content')
    <!-- cards -->
    <div class="w-full px-6 py-6 mx-auto">
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">
            <!-- card1 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal ">
                                        Jumlah Member</p>
                                    <h5 class="mb-2 font-bold">{{ $members }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div
                                    class="flex items-center justify-center w-12 h-12 text-center rounded-circle bg-gradient-to-br from-orange-500 from-90% !to-orange-500/60">
                                    <i class="text-lg font-bold text-white fa-solid fa-user-group"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- end cards -->
@endsection
