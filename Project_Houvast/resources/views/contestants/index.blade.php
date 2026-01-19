<x-layouts.app :title="__('Contestants')">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group flex items-center w-full justify-between">
                    <!-- Links -->
                    <form method="GET" action="{{ route('Contestants_list') }}" class="flex items-center gap-5">
                        <input
                            id="contestant-search"
                            data-live-search="true"
                            data-list="#contestants-list"
                            data-url="{{ route('Contestants_list') }}"
                            data-debounce="300"
                            type="text"
                            class="form-control border-2 rounded-md border-black h-12"
                            name="query"
                            value="{{ request('query') }}"
                            placeholder="Search contestants"
                            style="width: 300px;"
                            wire:ignore
                            onkeydown="if(event.keyCode === 13) event.preventDefault();" />

                        <button type="submit" class="hidden">Search</button>

                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('storage/images/scanner.png') }}"
                                alt="scanner icon"
                                style="width:65px;height:48px;" />
                        </a>
                    </form>

                    <!-- Rechts -->
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-red-700 transition focus:outline-none focus:ring-2 focus:ring-red-300" aria-label="Create poules">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Create poules
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="contestants-list" wire:ignore>
        @include('contestants._list')
    </div>

    
</x-layouts.app>