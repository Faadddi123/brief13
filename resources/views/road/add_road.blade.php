
<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-md shadow-md">
        <h1 class="text-2xl font-bold mb-4">Make a road</h1>

        <form action="{{ route('road.store') }}" method="POST" id="citySelectionForm" class="space-y-4">
            @csrf <!-- Include CSRF token -->
            <div>
                <label for="depart_city" class="block">Start City:</label>
                <!-- Select element for start city -->
                <select id="depart_city" name="depart_city" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="arriv_city" class="block">Arrival City:</label>
                <!-- Select element for arrival city -->
                <select id="arriv_city" name="arriv_city" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->city }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Submit</button>
        </form>
    </div>

</x-app-layout>