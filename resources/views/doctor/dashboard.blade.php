<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Doctor Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-700">
                    Welcome, Dr. {{ auth()->user()->name }}!
                </h3>
                <p class="text-gray-500 mt-1">Manage your appointments below.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <a href="{{ route('doctor.appointments') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-6 text-center shadow">
                    <div class="text-3xl mb-2">📋</div>
                    <div class="font-semibold">My Appointments</div>
                </a>
                <a href="{{ route('doctor.profile') }}"
                   class="bg-green-500 hover:bg-green-600 text-white rounded-lg p-6 text-center shadow">
                    <div class="text-3xl mb-2">👤</div>
                    <div class="font-semibold">My Profile</div>
                </a>
            </div>

            {{-- Recent Appointments --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-700 mb-4">Recent Appointments</h3>
                @if($appointments->isEmpty())
                    <p class="text-gray-500">No appointments yet.</p>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2 px-4">Patient</th>
                                <th class="py-2 px-4">Date</th>
                                <th class="py-2 px-4">Time</th>
                                <th class="py-2 px-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appt)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $appt->patient->user->name }}</td>
                                <td class="py-2 px-4">{{ $appt->appointment_date }}</td>
                                <td class="py-2 px-4">{{ $appt->appointment_time }}</td>
                                <td class="py-2 px-4">
                                    <span class="px-2 py-1 rounded text-sm
                                        {{ $appt->status === 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $appt->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $appt->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                        {{ ucfirst($appt->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>