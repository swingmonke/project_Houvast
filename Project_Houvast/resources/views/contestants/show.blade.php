<x-layouts.app :title="__('Contestant')">
    <div class="container mx-auto p-4 relative">
        <a href="{{ route('Contestants_list') }}" class="text-sm text-blue-600 underline mb-4 inline-block">&larr; Back to list</a>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        @if(session('weight_warning'))
            <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded">
                <p>{{ session('weight_warning') }}</p>
                <form method="POST" action="{{ route('Contestants_update', $contestant->contestant_id) }}" id="confirm-weight-form" class="mt-3">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="weight" value="{{ old('weight') }}" />
                    <input type="hidden" name="confirm_weight" value="1" />
                    <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">Confirm and Save</button>
                </form>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-1 space-y-4">
                <div class="p-4 border rounded-md">
                    <h1 class="text-2xl font-bold">{{ $contestant->first_name }}</h1>
                    <div class="text-lg text-gray-700">{{ trim(($contestant->infix ?? '') . ' ' . ($contestant->last_name ?? '')) }}</div>
                </div>

                <div class="mt-4 p-4 border rounded-md">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Date of birth</p>
                            <p class="font-medium">{{ optional($contestant->date_of_birth)->format('Y-m-d') ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Age</p>
                            <p class="font-medium">{{ $contestant->age ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-4 border rounded-md">
                    <p class="text-sm text-gray-500">Club</p>
                    <p class="font-medium">{{ $contestant->club ?? '-' }}</p>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-4 border rounded-md">
                        <p class="text-sm text-gray-500">Given weight</p>
                        <p class="font-medium">{{ $contestant->registered_weight ?? $contestant->weight ?? '-' }}</p>
                    </div>

                    <div class="p-4 border rounded-md">
                        <form method="POST" action="{{ route('Contestants_update', $contestant->contestant_id) }}" id="weigh-form" class="flex items-center gap-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="text-sm text-gray-500 block">Weighed weight</label>
                                <input type="number" step="0.01" name="weight" value="{{ old('weight', $contestant->weight) }}" class="form-control border-2 rounded-md h-10 w-40" />
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-4">
                    <form method="POST" action="{{ route('Contestants_destroy', $contestant->contestant_id) }}" id="delete-form" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>

            <div class="w-48 flex-shrink-0">
                <div class="w-48 h-48 bg-white border rounded-md overflow-hidden shadow-sm flex items-center justify-center">
                    @if ($contestant->profile_picture)
                        <img src="{{ asset('storage/' . $contestant->profile_picture) }}" alt="Profile picture" class="w-full h-full object-cover" />
                    @else
                        <svg class="w-20 h-20 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM4 20a8 8 0 0116 0" />
                        </svg>
                    @endif
                </div>
            </div>

            <!-- Action buttons fixed to bottom of the viewport — delete uses a confirmation dialog (minimal JS) -->

            <!-- Delete: confirmation then submit hidden delete form -->
            <button id="delete-button" type="button" aria-label="Delete contestant" class="fixed bottom-4 left-4 lg:left-72 z-50 px-4 py-2 bg-red-600 text-white rounded-md shadow transition transform hover:bg-red-700 hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-red-300">Delete</button>

            <!-- Save: submits the weigh form -->
            <button form="weigh-form" type="submit" aria-label="Save contestant" class="fixed bottom-4 right-4 lg:right-72 z-50 px-4 py-2 bg-blue-600 text-white rounded-md shadow transition transform hover:bg-blue-700 hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-300">Save</button>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const deleteBtn = document.getElementById('delete-button');
                    const deleteForm = document.getElementById('delete-form');

                    deleteBtn.addEventListener('click', function () {
                        if (!confirm('Weet je zeker dat je deze deelnemer wilt verwijderen?')) return;
                        if (deleteForm) deleteForm.submit();
                    });
                });
            </script>
        </div>
    </div>
</x-layouts.app>