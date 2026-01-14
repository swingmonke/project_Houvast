<x-layouts.app :title="__('Contestants_list')">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group flex items-center w-full justify-between">
                    <!-- Links -->
                    <div class="flex items-center gap-5">
                        <input
                            type="text"
                            class="form-control border-2 rounded-md border-black h-12"
                            name="query"
                            placeholder="Search contestants"
                            style="width: 300px;" />

                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('storage/images/scanner.png') }}"
                                alt="scanner icon"
                                style="width:65px;height:48px;" />
                        </a>
                    </div>

                    <!-- Rechts -->
                    <a href="{{ route('dashboard') }}" class="text-black text-sm bg-red-500">
                        Create poules
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div>
        @foreach ($contestants as $contestant)
            <div class="p-4 m-2 border rounded-md border-gray-300">
                <h3 class="text-lg font-semibold">{{ $contestant->name }}</h3>
                <p class="text-gray-600">Age: {{ $contestant->age }}</p>
                <p class="text-gray-600">Club: {{ $contestant->club }}</p>
            </div>
        @endforeach
    </div>
</x-layouts.app>