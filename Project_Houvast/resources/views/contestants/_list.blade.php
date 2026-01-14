@if($contestants->isEmpty())
    <div class="p-4 m-2 text-gray-500">No contestants found.</div>
@else
    @foreach ($contestants as $contestant)
        <div class="p-4 m-2 border rounded-md border-gray-300 hover:bg-gray-50">
            <div class="flex items-center gap-4">
                <a href="{{ route('Contestants_show', $contestant->contestant_id) }}" class="flex-1 min-w-0">
                    <h3 class="text-lg font-semibold truncate">{{ $contestant->name }}</h3>
                </a>

                <div class="flex items-center gap-3 whitespace-nowrap">
                    <span class="text-sm font-medium {{ $contestant->is_weighed ? 'text-green-600' : 'text-red-600' }}">
                        {{ $contestant->is_weighed ? 'Weighed' : 'Not Weighed' }}
                    </span>

                    <form method="POST" action="{{ route('Contestants_toggle_present', $contestant->contestant_id) }}" class="toggle-present-form">
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="text-sm font-medium px-2 py-1 rounded-full transition focus:outline-none {{ $contestant->is_present ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                            {{ $contestant->is_present ? 'Present' : 'Not Present' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif