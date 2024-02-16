<x-app-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Fill Taxi Information</h2>
        <form action="{{ route('taxi.store') }}" method="POST">
            @csrf

            <!-- Matricule -->
            <div class="mb-4">
                <label for="matricule" class="block text-gray-700 font-bold mb-2">Matricule</label>
                <input type="text" id="matricule" name="matricule" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <!-- Capacity -->
            <div class="mb-4">
                <label for="capacity" class="block text-gray-700 font-bold mb-2">Capacity</label>
                <input type="number" id="capacity" name="capacity" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <!-- type -->
            <div class="mb-4">
                <label for="type" class="block text-gray-700 font-bold mb-2">type</label>
                <input type="text" id="type" name="type" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <!-- Price Per Kilometer -->
            <div class="mb-4">
                <label for="PPK" class="block text-gray-700 font-bold mb-2">Price Per Kilometer</label>
                <input type="number" id="PPK" name="PPK" step="0.01" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Submit</button>
            </div>
        </form>
    </div>

</x-app-layout>