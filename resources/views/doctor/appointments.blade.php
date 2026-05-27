<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">My Appointments</h2>
    </x-slot>

    <div style="max-width:1200px; margin:0 auto; padding:32px 2rem;">

        @if(session('success'))
            <div style="background:#dcfce7; color:#16a34a; padding:12px 20px; border-radius:10px; margin-bottom:20px; font-size:14px; font-weight:600;">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div style="background:white; border-radius:14px; padding:28px; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
                <h3 style="font-size:18px; font-weight:700; color:#0f172a;">Patient Appointments</h3>
                <span style="background:#f0fdfa; color:#0d9488; padding:6px 14px; border-radius:50px; font-size:13px; font-weight:600; border:1px solid #ccfbf1;">
                    {{ $appointments->count() }} Total
                </span>
            </div>

            @if($appointments->isEmpty())
                <div style="text-align:center; padding:48px; color:#6b7280;">
                    <i class="fa-regular fa-calendar-xmark" style="font-size:40px; color:#ccfbf1; margin-bottom:16px; display:block;"></i>
                    No appointments yet.
                </div>
            @else
                <table style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr style="border-bottom:2px solid #f0fdfa;">
                            <th style="text-align:left; padding:12px 16px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:1px;">Patient</th>
                            <th style="text-align:left; padding:12px 16px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:1px;">Date</th>
                            <th style="text-align:left; padding:12px 16px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:1px;">Time</th>
                            <th style="text-align:left; padding:12px 16px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:1px;">Notes</th>
                            <th style="text-align:left; padding:12px 16px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:1px;">Status</th>
                            <th style="text-align:left; padding:12px 16px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:1px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appt)
                        <tr style="border-bottom:1px solid #f0fdfa;">
                            <td style="padding:14px 16px;">
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($appt->patient->user->name) }}&background=1e3a8a&color=fff&size=36&rounded=true"
                                         style="width:36px; height:36px; border-radius:50%;">
                                    <span style="font-size:14px; font-weight:600; color:#0f172a;">{{ $appt->patient->user->name }}</span>
                                </div>
                            </td>
                            <td style="padding:14px 16px; font-size:14px; color:#6b7280;">{{ $appt->appointment_date }}</td>
                            <td style="padding:14px 16px; font-size:14px; color:#6b7280;">{{ $appt->appointment_time }}</td>
                            <td style="padding:14px 16px; font-size:14px; color:#6b7280;">{{ $appt->notes ?? '-' }}</td>
                            <td style="padding:14px 16px;">
                                <span style="padding:4px 12px; border-radius:50px; font-size:12px; font-weight:600;
                                    {{ $appt->status === 'confirmed' ? 'background:#dcfce7; color:#16a34a;' : '' }}
                                    {{ $appt->status === 'pending' ? 'background:#fef9c3; color:#d97706;' : '' }}
                                    {{ $appt->status === 'cancelled' ? 'background:#fee2e2; color:#dc2626;' : '' }}">
                                    {{ ucfirst($appt->status) }}
                                </span>
                            </td>
                            <td style="padding:14px 16px;">
                                @if($appt->status === 'pending')
                                    <div style="display:flex; gap:8px;">
                                        <form method="POST" action="{{ route('doctor.confirm', $appt->id) }}" style="display:inline;">
                                            @csrf
                                            <button style="background:#dcfce7; color:#16a34a; border:none; padding:6px 14px; border-radius:6px; font-size:12px; font-weight:600; cursor:pointer;">
                                                <i class="fa-solid fa-check" style="margin-right:4px;"></i>Confirm
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('doctor.cancel', $appt->id) }}" style="display:inline;">
                                            @csrf
                                            <button style="background:#fee2e2; color:#dc2626; border:none; padding:6px 14px; border-radius:6px; font-size:12px; font-weight:600; cursor:pointer;">
                                                <i class="fa-solid fa-xmark" style="margin-right:4px;"></i>Cancel
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span style="color:#d1d5db; font-size:13px;">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <footer style="background:#0f172a; padding:24px 2rem; margin-top:48px;">
        <div style="max-width:1200px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
            <div style="display:flex; align-items:center; gap:8px;">
                <svg width="28" height="28" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="44" height="44" rx="10" fill="#0d9488"/><path d="M22 34s-14-9-14-18a8 8 0 0 1 14-5.3A8 8 0 0 1 36 16c0 9-14 18-14 18z" fill="white"/><polyline points="8,22 14,22 17,16 20,28 23,20 26,24 30,24 36,24" stroke="#0f172a" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span style="font-size:16px; font-weight:700; color:white;">Medi<span style="color:#2dd4bf;">Slot</span></span>
            </div>
            <p style="color:#475569; font-size:13px;">© {{ date('Y') }} MediSlot. All rights reserved.</p>
            <p style="color:#475569; font-size:13px;">Doctor Portal</p>
        </div>
    </footer>

</x-app-layout>