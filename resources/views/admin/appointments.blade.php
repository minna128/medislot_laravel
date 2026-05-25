<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Appointments</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                @if($appointments->isEmpty())
                    <p class="text-gray-500">No appointments yet.</p>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2 px-4">Patient</th>
                                <th class="py-2 px-4">Doctor</th>
                                <th class="py-2 px-4">Date</th>
                                <th class="py-2 px-4">Time</th>
                                <th class="py-2 px-4">Status</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appt)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $appt->patient->user->name }}</td>
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
                                <td class="py-2 px-4 space-x-1">
                                    @if($appt->status === 'pending')
                                        <form method="POST" action="{{ route('admin.confirm', $appt->id) }}" class="inline">
                                            @csrf
                                            <button class="bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600">
                                                Confirm
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.cancel', $appt->id) }}" class="inline">
                                            @csrf
                                            <button class="bg-yellow-500 text-white px-2 py-1 rounded text-xs hover:bg-yellow-600">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.appointment.delete', $appt->id) }}"
                                          class="inline" onsubmit="return confirm('Delete this appointment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
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