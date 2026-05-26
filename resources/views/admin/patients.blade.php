<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Patients</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.patient.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Add Patient
                    </a>
                </div>

                @if($patients->isEmpty())
                    <p class="text-gray-500">No patients registered yet.</p>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2 px-4">Name</th>
                                <th class="py-2 px-4">Email</th>
                                <th class="py-2 px-4">Phone</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $patient->user->name }}</td>
                                <td class="py-2 px-4">{{ $patient->user->email }}</td>
                                <td class="py-2 px-4">{{ $patient->phone ?? '-' }}</td>
                                <td class="py-2 px-4">
                                    <form method="POST" action="{{ route('admin.patient.delete', $patient->id) }}"
                                          onsubmit="return confirm('Delete this patient?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
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