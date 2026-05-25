<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Doctors</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                @if($doctors->isEmpty())
                    <p class="text-gray-500">No doctors registered yet.</p>
                @else
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2 px-4">Name</th>
                                <th class="py-2 px-4">Specialization</th>
                                <th class="py-2 px-4">Phone</th>
                                <th class="py-2 px-4">Availability</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctors as $doctor)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $doctor->user->name }}</td>
                                <td class="py-2 px-4">{{ $doctor->specialization ?? '-' }}</td>
                                <td class="py-2 px-4">{{ $doctor->phone ?? '-' }}</td>
                                <td class="py-2 px-4">{{ $doctor->availability ?? '-' }}</td>
                                <td class="py-2 px-4">
                                    <form method="POST" action="{{ route('admin.doctor.delete', $doctor->id) }}"
                                          onsubmit="return confirm('Delete this doctor?')">
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