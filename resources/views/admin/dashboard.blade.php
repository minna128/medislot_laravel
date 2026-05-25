<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-blue-500 text-black rounded-lg p-6 text-center shadow">
                    <div class="text-4xl font-bold">{{ $totalDoctors }}</div>
                    <div class="mt-1">Doctors</div>
                </div>
                <div class="bg-green-500 text-black rounded-lg p-6 text-center shadow">
                    <div class="text-4xl font-bold">{{ $totalPatients }}</div>
                    <div class="mt-1">Patients</div>
                </div>
                <div class="bg-purple-500 text-black rounded-lg p-6 text-center shadow">
                    <div class="text-4xl font-bold">{{ $totalAppointments }}</div>
                    <div class="mt-1">Appointments</div>
                </div>
                <div class="bg-yellow-500 text-black rounded-lg p-6 text-center shadow">
                    <div class="text-4xl font-bold">{{ $pendingCount }}</div>
                    <div class="mt-1">Pending</div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('admin.doctors') }}"
                   class="bg-white hover:bg-gray-50 rounded-lg p-6 text-center shadow border">
                    <div class="text-3xl mb-2">👨‍⚕️</div>
                    <div class="font-semibold text-gray-700">Manage Doctors</div>
                </a>
                <a href="{{ route('admin.patients') }}"
                   class="bg-white hover:bg-gray-50 rounded-lg p-6 text-center shadow border">
                    <div class="text-3xl mb-2">🧑‍🤝‍🧑</div>
                    <div class="font-semibold text-gray-700">Manage Patients</div>
                </a>
                <a href="{{ route('admin.appointments') }}"
                   class="bg-white hover:bg-gray-50 rounded-lg p-6 text-center shadow border">
                    <div class="text-3xl mb-2">📅</div>
                    <div class="font-semibold text-gray-700">Manage Appointments</div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>