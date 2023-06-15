@extends('layouts.dashboard', ['plain' => false])
@section('content')
    <div class="w-full max-w-full px-3 mx-auto shrink-0 md:w-8/12 md:flex-0">
        <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data"
            class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
            @csrf
            <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                <div class="flex items-center">
                    <p class="mb-0 ">Tambah Event</p>
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
                            <label for="title" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Nama
                                Event</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-500 focus:outline-none" />
                            @error('title')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                        <div class="mb-4">
                            <label for="date" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Tanggal
                                Event</label>
                            <input type="date" name="date" value="{{ old('date') }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-500 focus:outline-none" />
                            @error('date')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:w-12/12 md:flex-0">
                        <div class="mb-4">
                            <label for="location" class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Lokasi
                                Event</label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-500 focus:outline-none" />
                            @error('location')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                        <div class="mb-4">
                            <label for="image"
                                class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Caption</label>
                            <textarea name="caption" id="caption" cols="30" rows="10" class="hidden">{!! old('caption') !!}</textarea>
                            <div class="mt-2 col-span-full">
                                <trix-editor input="caption"></trix-editor>
                            </div>
                            <input type="file" name="image" accept="image/jpg, image/png, image/gif, image/jpeg"
                                class="focus:shadow-primary-outline hidden text-sm leading-5.6 ease w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-500 focus:outline-none" />
                            @error('image')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 shrink-0 md:flex-0">
                        <div class="mb-4">
                            <span class="inline-block mb-2 ml-1 text-xs font-bold text-slate-700 ">Gambar</span>
                            <label for="image"
                                class="text-white block w-fit px-3 py-2 rounded-md shadow bg-gradient-to-br from-orange-500 !to-orange-600">
                                <i class="mr-2 fa-solid fa-image"></i><span id="file-name">Tambah Gambar</span>
                            </label>
                            <input type="file" name="image" id="image"
                                accept="image/jpg, image/png, image/gif, image/jpeg"
                                class="focus:shadow-primary-outline hidden text-sm leading-5.6 ease w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-orange-500 focus:outline-none" />
                            @error('image')
                                <span class="text-sm italic font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#image").change(function(e) {
                previewImages(this);

                var fileName = e.target.files[0].name;
                $('#file-name').text(fileName);
            });
        });

        function previewImages(input) {
            var preview = $('#image-preview');
            // console.log(input.files);
            preview.show()

            if (input.files) {
                for (var i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var cover = Math.floor(Math.random() * 51);
                        // console.log(e.target.result);
                        // console.log(input.files);
                        preview.prepend(
                            `<img src="${e.target.result}" class="object-cover w-full"/>`
                        );
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>
@endsection
