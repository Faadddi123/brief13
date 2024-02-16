<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-md shadow-md">
        @if ($taxi->isEmpty())

            <h2 class="text-2xl font-semibold mb-6">No taxi information provided</h2>
            <!-- Button to Redirect -->
            <div class="flex justify-center">
                <a href="{{ route('taxi.create') }}" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 focus:outline-none focus:bg-gray-500">Fill Taxi Information</a>
            </div>
                
            
        @elseif ($trajet_info->isEmpty())
            <h2 class="text-2xl font-semibold mb-6">Schedule Your Trip</h2>
                
            <form method = "POST" action ="{{ route('trajets.store') }}" >
                @csrf
                <div class="mb-4">
                    <label for="road" class="block text-gray-700 font-bold mb-2">Destination</label>
                    <select id="road" name="road" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach ($roads as $road)
                        <option value="{{ $road->id }}">{{ $road->city_start }} to {{ $road->city_arrive }} with a price of {{$taxi[0]->PPK *  $road->distance  }} DH </option>
                    @endforeach
                            
                    </select>
                </div>

                <p class="text-sm text-gray-500 mb-4">If you didn't find the road you want, <a href="{{ route('road.create') }}" class="text-indigo-600 hover:underline">click here</a> to add it.</p>
                <!-- Departure Time -->
                <div class="mb-4">
                    <label for="departure_time" class="block text-gray-700 font-bold mb-2">Departure Time</label>
                    <input type="time" id="departure_time" name="departure_time" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Arrival Time -->
                <div class="mb-4">
                    <label for="arrival_time" class="block text-gray-700 font-bold mb-2">Arrival Time</label>
                    <input type="time" id="arrival_time" name="arrival_time" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Submit</button>
                </div>
            </form> 
        @else
            <h2 class="text-2xl font-semibold mb-6">Your Trip Information</h2>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Destination</label>
                <p>{{ $trajet_info[0]->city_start }} to {{ $trajet_info[0]->city_arrive }} with a price of {{ $trajet_info[0]->PPK * $trajet_info[0]->distance }} DH</p>
            </div>

            <!-- Departure Time -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Departure Time</label>
                <p>{{ $trajet_info[0]->heurs_depart }}</p>
            </div>

            <!-- Arrival Time -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Arrival Time</label>
                <p>{{ $trajet_info[0]->heurs_arrive }}</p>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Price</label>
                <p>{{ $trajet_info[0]->PPK * $trajet_info[0]->distance }} DH</p>
            </div>

            <!-- Rating -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Rating</label>
                <p>{{ $trajet_info[0]->ratting }}</p>
            </div>

            <!-- Driver's Name -->
            {{-- <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Driver's Name</label>
                <p>{{ $taxi->driver->name }}</p>
            </div> --}}

            
        @endif
        
    </div>
    

</x-app-layout>