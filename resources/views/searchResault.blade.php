<div class="flex flex-wrap justify-center pt-6" id="place_result">
    @foreach ($events as $item)
        <div class="max-w-sm rounded-lg overflow-hidden shadow-lg bg-slate-800 m-5">
            <a class="hover:bg-amber-100" href="{{ route('dashboard.events.show', $item->id) }}">
                <img class="w-full" src="{{ asset($item->image) }}" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2 text-white">{{ $item->title }}</div>
                    <p class="text-white text-base">
                        {{ $item->description }}
                    </p>
                </div>

                <div class="px-6 pt-4 pb-2 flex justify-between">
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#
                        {{ $item->category->name }}</span>
                    <div>
                        <button class="text-white bg-yellow-600 p-2 rounded-lg ">See Event</button>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
