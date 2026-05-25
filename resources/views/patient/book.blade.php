<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Book Appointment</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('patient.book.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Select Doctor</label>
                        <select name="doctor_id" class="w-full border rounded px-3 py-2">
                            <option value="">-- Choose Doctor --</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">
                                    {{ $doctor->user->name }} — {{ $doctor->specialization ?? 'General' }}
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="appointment_date" min="{{ now()->toDateString() }}"
                               class="w-full border rounded px-3 py-2">
                        @error('appointment_date') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Time</label>
                        <input type="time" name="appointment_time" class="w-full border rounded px-3 py-2">
                        @error('appointment_time') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Notes (optional)</label>
                        <textarea name="notes" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    <button type="submit"
                            class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                        Book Appointment
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>