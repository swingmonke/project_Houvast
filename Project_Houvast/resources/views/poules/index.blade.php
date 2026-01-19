<x-layouts.app :title="__('Contestants_list')">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group flex items-center w-full justify-between">
                    <!-- Links -->
                    <div class="flex items-center gap-5">
                        <form method="GET" action="{{ route('poule') }}" class="flex items-center gap-2">
                            <input
                                type="text"
                                class="form-control border-2 rounded-md border-black h-12"
                                name="query"
                                placeholder="Search Poules"
                                value="{{ $query ?? '' }}"
                                style="width: 300px;" />
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>

                    <!-- Rechts -->
                    <a href="{{ route('dashboard') }}" class="text-black text-sm bg-green-500"
                     style="width: 10%;">
                        Make Brackets
                    </a>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                
<div class="mt-4">
    <h3 class="text-xl font-semibold mb-4">All Poules</h3>

    <div class="space-y-7">
        @foreach($poules as $poule)
            <div class="flex items-stretch justify-between gap-6">
                {{-- Left grey panel --}}
                <div class="flex-1 bg-gray-300 px-6 py-5">
                    <div class="text-lg font-semibold mb-2">
                        {{ $poule->poule_name }}
                    </div>

                    <div class="leading-7">
                        <div class="flex gap-3">
                            <span class="font-medium min-w-[110px]">Weight class</span>
                            <span>{{ $poule->weight_class }}</span>
                        </div>

                        <div class="flex gap-3">
                            <span class="font-medium min-w-[110px]">Age class</span>
                            <span>{{ $poule->age }}</span>
                        </div>

                        {{-- Optional extras --}}
                        {{-- <div class="flex gap-3"><span class="font-medium min-w-[110px]">Location</span><span>{{ $poule->location }}</span></div> --}}
                        {{-- <div class="flex gap-3"><span class="font-medium min-w-[110px]">Size</span><span>{{ $poule->poule_size }}</span></div> --}}
                    </div>
                </div>

                {{-- Right buttons --}}
                <div class="w-40 flex flex-col justify-between">
                    <a
                        href="{{ route('poules.show', $poule->poule_id) }}"

                        class="block w-full text-center bg-gray-300 border border-gray-400 py-3"
                    >
                        Open poule
                    </a>

                    <form
                        action="{{ route('poule.destroy', $poule->poule_id) }}"
                        method="POST"
                        onsubmit="return confirm('Remove this poule?');"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="w-full bg-red-600 text-black py-3"
                        >
                            Remove poule
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

            </div>
        </div>
    </div>
</x-layouts.app>