<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Our Doctors</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($doctors as $doctor)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-lg text-gray-800">{{ $doctor->user->name }}</h3>
                    <p class="text-blue-600 text-sm mt-1">{{ $doctor->specialization ?? 'General' }}</p>
                    <p class="text-gray-500 text-sm mt-2">{{ $doctor->clinic_location ?? 'N/A' }}</p>
                    <p class="text-gray-500 text-sm">📞 {{ $doctor->phone ?? 'N/A' }}</p>
                    <a href="{{ route('patient.book') }}"
                       class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
                        Book Appointment
                    </a>
                </div>
                @empty
                    <p class="text-gray-500">No doctors available.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>