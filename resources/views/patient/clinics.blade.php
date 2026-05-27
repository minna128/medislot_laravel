<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">Our Clinics</h2>
    </x-slot>

    <div style="max-width:1200px; margin:0 auto; padding:32px 2rem;">

        @if($clinics->isEmpty())
            <div style="text-align:center; padding:48px; color:#6b7280;">
                <i class="fa-solid fa-hospital" style="font-size:40px; color:#ccfbf1; margin-bottom:16px; display:block;"></i>
                No clinics available yet.
            </div>
        @else
            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:24px;">
                @foreach($clinics as $clinic)
                <div style="background:white; border-radius:16px; overflow:hidden; border:1px solid #ccfbf1; box-shadow:0 4px 16px rgba(13,148,136,0.08);">
                    <div style="background:linear-gradient(135deg,#0f172a,#0d9488); padding:24px; text-align:center;">
                        <div style="width:60px; height:60px; background:rgba(255,255,255,0.15); border-radius:16px; display:flex; align-items:center; justify-content:center; margin:0 auto 12px;">
                            <i class="fa-solid fa-hospital" style="color:white; font-size:28px;"></i>
                        </div>
                        <h3 style="font-size:18px; font-weight:700; color:white; margin-bottom:4px;">{{ $clinic->name }}</h3>
                        <p style="color:#2dd4bf; font-size:13px;">{{ $clinic->doctors->count() }} Doctor(s) Available</p>
                    </div>

                    <div style="padding:20px;">
                        <div style="display:flex; flex-direction:column; gap:8px; margin-bottom:16px;">
                            <div style="display:flex; align-items:center; gap:10px; font-size:13px; color:#6b7280;">
                                <i class="fa-solid fa-location-dot" style="color:#0d9488; width:16px;"></i>
                                {{ $clinic->location }}
                            </div>
                            @if($clinic->phone)
                            <div style="display:flex; align-items:center; gap:10px; font-size:13px; color:#6b7280;">
                                <i class="fa-solid fa-phone" style="color:#0d9488; width:16px;"></i>
                                {{ $clinic->phone }}
                            </div>
                            @endif
                            @if($clinic->hours)
                            <div style="display:flex; align-items:center; gap:10px; font-size:13px; color:#6b7280;">
                                <i class="fa-regular fa-clock" style="color:#0d9488; width:16px;"></i>
                                {{ $clinic->hours }}
                            </div>
                            @endif
                            @if($clinic->description)
                            <p style="font-size:13px; color:#6b7280; line-height:1.6; margin-top:4px;">{{ $clinic->description }}</p>
                            @endif
                        </div>

                        @if($clinic->doctors->count() > 0)
                        <div style="margin-bottom:16px;">
                            <div style="font-size:11px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">Doctors</div>
                            <div style="display:flex; flex-wrap:wrap; gap:6px;">
                                @foreach($clinic->doctors as $doctor)
                                <span style="background:#f0fdfa; color:#0d9488; border:1px solid #ccfbf1; padding:3px 10px; border-radius:50px; font-size:12px; font-weight:500;">
                                    Dr. {{ $doctor->user->name }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <a href="{{ route('patient.book') }}"
                           style="display:block; text-align:center; padding:10px; background:linear-gradient(135deg,#1e3a8a,#0d9488); color:white; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none;">
                            Book Appointment
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
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