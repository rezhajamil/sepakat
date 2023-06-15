<div class="flex justify-center w-full p-2">
    <nav class="inline-flex -space-x-px rounded-md shadow-sm isolate" aria-label="Pagination">
        @if (!$data->onFirstPage())
            <a href="{{ $data->previousPageUrl() }}"
                class="relative inline-flex items-center px-2 py-2 text-white rounded-l-md ring-1 ring-inset ring-gray-300 hover:bg-orange-800 focus:z-20 focus:outline-offset-0">
                <span class="sr-only">Previous</span>
                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        @endif
        <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-orange-800 focus:outline-offset-0" -->
        @for ($i = 1; $i <= $data->lastPage(); $i++)
            @if ($i <= 3 && $i >= $data->lastPage() - 2)
                <a href="{{ $data->url($i) }}"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-semibold  {{ $i == $data->currentPage() ? 'bg-orange-600 text-white' : '' }} text-white ring-1 ring-inset ring-gray-300 hover:bg-orange-800 focus:z-20 focus:outline-offset-0">{{ $i }}</a>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
            @endif
        @endfor

        @if (!$data->onLastPage())
            <a href="{{ $data->nextPageUrl() }}"
                class="relative inline-flex items-center px-2 py-2 text-white rounded-r-md ring-1 ring-inset ring-gray-300 hover:bg-orange-800 focus:z-20 focus:outline-offset-0">
                <span class="sr-only">Next</span>
                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        @endif
    </nav>
</div>
