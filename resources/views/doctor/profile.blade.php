<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">My Profile</h2>
    </x-slot>

    <div style="max-width:800px; margin:0 auto; padding:32px 2rem;">

        @if(session('success'))
            <div style="background:#dcfce7; color:#16a34a; padding:12px 20px; border-radius:10px; margin-bottom:20px; font-size:14px; font-weight:600;">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div style="background:white; border-radius:14px; overflow:hidden; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08);">
            {{-- Profile Header --}}
            <div style="background:linear-gradient(135deg,#0f172a,#0d9488); padding:32px; display:flex; align-items:center; gap:20px;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ffffff&color=0d9488&size=80&rounded=true&bold=true"
                     style="width:80px; height:80px; border-radius:50%; border:3px solid rgba(255,255,255,0.3);">
                <div>
                    <h2 style="font-size:22px; font-weight:800; color:white; margin-bottom:4px;">Dr. {{ auth()->user()->name }}</h2>
                    <p style="color:#2dd4bf; font-size:14px;">{{ $doctor->specialization ?? 'General Practitioner' }}</p>
                    <p style="color:rgba(255,255,255,0.6); font-size:13px; margin-top:4px;">{{ auth()->user()->email }}</p>
                </div>
            </div>

            {{-- Form --}}
            <div style="padding:28px;">
                <h3 style="font-size:16px; font-weight:700; color:#0f172a; margin-bottom:20px;">Update Profile</h3>

                <form method="POST" action="{{ route('doctor.profile.update') }}">
                    @csrf

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Specialization</label>
                            <input type="text" name="specialization"
                                   value="{{ $doctor->specialization ?? '' }}"
                                   style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Qualifications</label>
                            <input type="text" name="qualifications"
                                   value="{{ $doctor->qualifications ?? '' }}"
                                   style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit;">
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Phone</label>
                            <input type="text" name="phone"
                                   value="{{ $doctor->phone ?? '' }}"
                                   style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Clinic Location</label>
                            <input type="text" name="clinic_location"
                                   value="{{ $doctor->clinic_location ?? '' }}"
                                   style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit;">
                        </div>
                    </div>

                    <div style="margin-bottom:24px;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Availability</label>
                        <input type="text" name="availability"
                               value="{{ $doctor->availability ?? '' }}"
                               placeholder="e.g. Mon-Fri 9am-5pm"
                               style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit;">
                        <p style="font-size:11px; color:#94a3b8; margin-top:6px;">Format: Mon-Fri 9am-5pm (used to filter booking time slots)</p>
                    </div>

                    <button type="submit"
                            style="background:linear-gradient(135deg,#1e3a8a,#0d9488); color:white; border:none; padding:12px 32px; border-radius:10px; font-size:15px; font-weight:700; cursor:pointer;">
                        Save Profile
                    </button>
                </form>
            </div>
        </div>
    </div>

    <footer style="background:#0f172a; padding:24px 2rem; margin-top:48px;">
        <div style="max-width:1200px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
            <div style="display:flex; align-items:center; gap:8px;">
                <span style="font-size:18px; color:#2dd4bf;">✚</span>
                <span style="font-size:16px; font-weight:700; color:white;">Medi<span style="color:#2dd4bf;">Slot</span></span>
            </div>
            <p style="color:#475569; font-size:13px;">© {{ date('Y') }} MediSlot. All rights reserved.</p>
            <p style="color:#475569; font-size:13px;">Doctor Portal</p>
        </div>
    </footer>

</x-app-layout>