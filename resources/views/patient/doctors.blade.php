<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">Our Doctors</h2>
    </x-slot>

    <div style="max-width:1200px; margin:0 auto; padding:32px 2rem; flex:1;">

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:24px;">
            @forelse($doctors as $doctor)
            <div style="background:white; border-radius:16px; overflow:hidden; border:1px solid #ccfbf1; box-shadow:0 4px 16px rgba(13,148,136,0.08);">
                {{-- Doctor Avatar --}}
                <div style="background:linear-gradient(135deg,#0f172a,#0d9488); padding:28px; text-align:center;">
                    <img src="{{ asset('images/doctors/' . strtolower(explode(' ', $doctor->user->name)[0]) . '.jpg') }}"
                         style="width:80px; height:80px; border-radius:50%; border:3px solid rgba(255,255,255,0.3);">
                    <h3 style="font-size:18px; font-weight:700; color:white; margin-top:12px;">Dr. {{ $doctor->user->name }}</h3>
                    <p style="color:#2dd4bf; font-size:13px; font-weight:500; margin-top:4px;">{{ $doctor->specialization ?? 'General Practitioner' }}</p>
                </div>

                {{-- Doctor Info --}}
                <div style="padding:20px;">
                    <div style="display:flex; flex-direction:column; gap:10px; margin-bottom:16px;">
                        <div style="display:flex; align-items:center; gap:10px; font-size:13px; color:#6b7280;">
                            <i class="fa-solid fa-location-dot" style="color:#0d9488; width:16px;"></i>
                            {{ $doctor->clinic_location ?? 'MediSlot Clinic' }}
                        </div>
                        <div style="display:flex; align-items:center; gap:10px; font-size:13px; color:#6b7280;">
                            <i class="fa-solid fa-phone" style="color:#0d9488; width:16px;"></i>
                            {{ $doctor->phone ?? 'N/A' }}
                        </div>
                        <div style="display:flex; align-items:center; gap:10px; font-size:13px; color:#6b7280;">
                            <i class="fa-regular fa-clock" style="color:#0d9488; width:16px;"></i>
                            {{ $doctor->availability ?? 'Mon-Fri 9am-5pm' }}
                        </div>
                        @if($doctor->qualifications)
                        <div style="display:flex; align-items:center; gap:10px; font-size:13px; color:#6b7280;">
                            <i class="fa-solid fa-graduation-cap" style="color:#0d9488; width:16px;"></i>
                            {{ $doctor->qualifications }}
                        </div>
                        @endif
                    </div>
                    <a href="{{ route('patient.book') }}"
                       style="display:block; text-align:center; padding:10px; background:linear-gradient(135deg,#1e3a8a,#0d9488); color:white; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none;">
                        Book Appointment
                    </a>
                </div>
            </div>
            @empty
                <div style="grid-column:span 3; text-align:center; padding:48px; color:#6b7280;">
                    <i class="fa-solid fa-user-doctor" style="font-size:40px; color:#ccfbf1; margin-bottom:16px; display:block;"></i>
                    No doctors available.
                </div>
            @endforelse
        </div>
    </div>

    <footer style="background:#0f172a; padding:24px 2rem; margin-top:48px;">
        <div style="max-width:1200px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
            <div style="display:flex; align-items:center; gap:8px;">
                <svg width="28" height="28" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="44" height="44" rx="10" fill="#0d9488"/><path d="M22 34s-14-9-14-18a8 8 0 0 1 14-5.3A8 8 0 0 1 36 16c0 9-14 18-14 18z" fill="white"/><polyline points="8,22 14,22 17,16 20,28 23,20 26,24 30,24 36,24" stroke="#0f172a" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span style="font-size:16px; font-weight:700; color:white;">Medi<span style="color:#2dd4bf;">Slot</span></span>
            </div>
            <p style="color:#475569; font-size:13px;">© {{ date('Y') }} MediSlot. All rights reserved.</p>
            <p style="color:#475569; font-size:13px;">Patient Portal</p>
        </div>
    </footer>

</x-app-layout>