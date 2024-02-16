
<x-app-layout>
    <div class=" mx-auto mt-10 bg-white p-6 rounded-md shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($trajet_info as $trajet)
            <!-- Taxi Ride 1 -->
            <div class="max-w-sm bg-yellow-300 border border-yellow-400 rounded-lg shadow-lg">
                <a href="#">
                    <img class="rounded-t-lg" src="/path/to/taxi1/image.jpg" alt="Taxi Image" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Taxi Ride: From {{ $trajet->city_start }} to {{ $trajet->city_arrive }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Price: {{ $trajet->PPK  * $trajet->distance}} DH</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Start City: {{ $trajet->city_start }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Arrive City: {{ $trajet->city_arrive }}</p>
                    
                    
                    @role('passenger')
                        

                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <p class="ms-2 text-sm font-bold text-gray-900 dark:text-white">4.95</p>
                            <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                        </div>

                    @endrole
                    <a href="{{ route('Reserve', ['id' => $trajet->id]) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Reserve Now
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>

                </div>
            </div>
        @endforeach
            
            
        </div>
    </div>
</x-app-layout>