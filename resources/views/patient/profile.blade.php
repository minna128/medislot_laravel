<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Profile</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <p class="text-gray-700"><strong>Name:</strong> {{ auth()->user()->name }}</p>
                <p class="text-gray-700 mt-2"><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p class="text-gray-700 mt-2"><strong>Role:</strong> {{ ucfirst(auth()->user()->role) }}</p>
                <div class="mt-4">
                    <a href="/user/profile" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>