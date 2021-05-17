@unless ($breadcrumbs->isEmpty())

<nav class="py-3 max-w-screen-xl w-full mx-auto px-4 flex space-x-4 sm:px-6 lg:px-8" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-4">
        @foreach ($breadcrumbs as $breadcrumb)
        <li>
            <div class="flex items-center">
                @if(!$loop->first)
                <!-- Heroicon name: solid/chevron-right -->
                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
                @endif
                {{-- <a href="#" class="text-gray-400 hover:text-gray-500">
                    <!-- Heroicon name: solid/home -->
                    <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <span class="sr-only">Home</span>
                </a> --}}

                @if (!is_null($breadcrumb->url) && !$loop->last)
                <a href="{{ $breadcrumb->url }}"
                    class="{{ !$loop->first ? 'ml-4' : '' }} text-sm font-medium text-gray-500 hover:text-gray-700">{{ $breadcrumb->title }}</a>
                @else
                <span class="{{ !$loop->first ? 'ml-4' : '' }} text-sm font-medium text-gray-700">
                    {{ $breadcrumb->title }}
                </span>
                @endif
            </div>
        </li>
        @endforeach
    </ol>
</nav>

@endunless