<x-layouts.app>
    <div class="bg-white text-black p-8">

    @php
        $size = (int)($poule->poule_size ?? 5);
        $size = max(3, min(6, $size));

        $matchOrders = [
            3 => [[1,2],[2,3],[1,3]],
            4 => [[1,2],[3,4],[1,3],[2,4],[1,4],[2,3]],
            5 => [[1,2],[3,4],[1,5],[2,3],[4,5],[1,3],[2,4],[3,5],[1,4],[2,5]],
            6 => [[1,2],[3,5],[2,4],[1,6],[4,5],[2,3],[4,6],[2,5],[3,4],[1,5],[3,6],[1,4],[5,6],[1,3],[2,6]],
        ];

        if (!isset($matchOrders[$size])) {
            $pairs = [];
            for ($i=1; $i<=$size; $i++) {
                for ($j=$i+1; $j<=$size; $j++) $pairs[] = [$i,$j];
            }
            $matchOrders[$size] = $pairs;
        }

        $matches = $matchOrders[$size];
    @endphp

    <div class="bg-white p-8">
        {{-- Header (unchanged) --}}
        <div class="flex items-start justify-between">
            <div class="space-y-5 font-serif">
                <div class="text-xl font-semibold">
                    Tijd: {{ now()->format('H:i') }} uur
                </div>

                <div class="text-xl font-semibold">
                    Poule: {{ $poule->poule_id ?? $poule->id }}
                </div>

                <div class="text-xl font-semibold">
                    Wedstrijd tijd: {{ $poule->match_time ?? 2 }} minuten
                    <span class="ml-10">(pakking)</span>
                </div>
            </div>

            <div class="flex flex-col items-center font-serif">
                <img src="{{ asset('storage/images/logo1.jpg') }}"
                     class="mt-1 h-28 w-24 object-contain">
                <div class="mt-1 text-xs font-semibold text-center">
                    De Hechte Band<br>Mierlo
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="mt-10 overflow-x-auto">
            <table class="w-full border border-gray-600 font-serif text-sm">
                <thead>
                    <tr>
                        <th class="border border-gray-600 px-3 py-2 text-left font-medium">Naam</th>

                        @foreach($matches as [$a,$b])
                            <th class="border border-gray-600 px-2 py-2 text-center font-medium">
                                {{ $a }}-{{ $b }}
                            </th>
                        @endforeach

                        <th class="border border-gray-600 px-2 py-2">Gewonnen<br>Wedstrijden</th>
                        <th class="border border-gray-600 px-2 py-2">Aantal<br>Punten</th>
                        <th class="border border-gray-600 px-2 py-2">Behaalde<br>Plaats</th>
                    </tr>
                </thead>

<tbody>
    @for($r = 1; $r <= $size; $r++)
        <tr class="h-24">
            {{-- Naam column (row number visible) --}}
            <td class="border border-gray-600 px-3 py-2 align-middle">
                <div class="flex gap-2">
                    <span class="w-6 text-right font-medium">{{ $r }}.</span>
                    <span class="text-black">
                        {{-- name comes later --}}
                    </span>
                </div>
            </td>

            {{-- Match columns --}}
            @foreach($matches as [$a,$b])
                @php
                    // WHITE = match row
                    // GREY  = non-match row
                    $isMatch = ($r === $a || $r === $b);
                @endphp

                <td class="border border-gray-600 p-0 text-center align-middle">
                    <div class="{{ $isMatch ? 'bg-white' : 'bg-gray-300' }} h-24 w-full flex items-center justify-center">
                        {{-- intentionally empty: scores go here later --}}
                    </div>
                </td>
            @endforeach

            {{-- Result columns (empty but visible) --}}
            <td class="border border-gray-600">&nbsp;</td>
            <td class="border border-gray-600">&nbsp;</td>
            <td class="border border-gray-600">&nbsp;</td>
        </tr>
    @endfor
</tbody>

            </table>
        </div>

        {{-- Print --}}
        <div class="mt-14">
            <button onclick="window.print()"
                    class="bg-green-700 px-10 py-5 text-sm font-medium text-black">
                Print poule
            </button>
        </div>
    </div>

    <style>
        @media print {
            nav, aside, .sidebar, .flux-sidebar { display: none !important; }
            body { background: #fff !important; }
        }
    </style>
</x-layouts.app>
