<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Doctor Profile</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('doctor.profile.update') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Specialization</label>
                        <input type="text" name="specialization"
                               value="{{ $doctor->specialization ?? '' }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Qualifications</label>
                        <input type="text" name="qualifications"
                               value="{{ $doctor->qualifications ?? '' }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Clinic Location</label>
                        <input type="text" name="clinic_location"
                               value="{{ $doctor->clinic_location ?? '' }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Phone</label>
                        <input type="text" name="phone"
                               value="{{ $doctor->phone ?? '' }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Availability</label>
                        <input type="text" name="availability"
                               placeholder="e.g. Mon-Fri 9am-5pm"
                               value="{{ $doctor->availability ?? '' }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <button type="submit"
                            class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                        Save Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>