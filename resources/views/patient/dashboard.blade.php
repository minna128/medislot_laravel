<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Patient Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome Card --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-700">
                    Welcome, {{ auth()->user()->name }}!
                </h3>
                <p class="text-gray-500 mt-1">Manage your appointments and health records here.</p>
            </div>

            {{-- Quick Links --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('patient.book') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-6 text-center shadow">
                    <div class="text-3xl mb-2">📅</div>
                    <div class="font-semibold">Book Appointment</div>
                </a>

                <a href="{{ route('patient.appointments') }}"
                   class="bg-green-500 hover:bg-green-600 text-white rounded-lg p-6 text-center shadow">
                    <div class="text-3xl mb-2">📋</div>
                    <div class="font-semibold">My Appointments</div>
                </a>

                <a href="{{ route('patient.doctors') }}"
                   class="bg-purple-500 hover:bg-purple-600 text-white rounded-lg p-6 text-center shadow">
                    <div class="text-3xl mb-2">👨‍⚕️</div>
                    <div class="font-semibold">View Doctors</div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>