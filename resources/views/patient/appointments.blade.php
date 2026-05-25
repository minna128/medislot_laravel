<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Appointments</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if($appointments->isEmpty())
                    <p class="text-gray-500">You have no appointments yet.</p>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2 px-4">Doctor</th>
                                <th class="py-2 px-4">Date</th>
                                <th class="py-2 px-4">Time</th>
                                <th class="py-2 px-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appt)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $appt->doctor->user->name }}</td>
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