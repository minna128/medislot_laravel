<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">Patient Dashboard</h2>
    </x-slot>

    {{-- Hero Banner --}}
    <div style="background:linear-gradient(135deg,#0f172a 0%,#0d9488 100%); padding:32px 2rem;">
        <div style="max-width:1200px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
            <div>
                <p style="color:#2dd4bf; font-size:13px; font-weight:600; text-transform:uppercase; letter-spacing:2px; margin-bottom:6px;">Welcome Back</p>
                <h1 style="font-size:28px; font-weight:800; color:white; margin-bottom:4px;">{{ auth()->user()->name }}</h1>
                <p style="color:rgba(255,255,255,0.7); font-size:14px;">{{ now()->format('l, F j, Y') }}</p>
            </div>
            <div style="display:flex; gap:12px;">
                <a href="{{ route('patient.book') }}"
                   style="display:inline-flex; align-items:center; gap:8px; background:white; color:#0d9488; padding:10px 20px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                    <i class="fa-regular fa-calendar-plus"></i> Book Appointment
                </a>
            </div>
        </div>
    </div>

    <div style="max-width:1200px; margin:0 auto; padding:32px 2rem;">

        {{-- Stats Row --}}
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:28px;">
            @php
                $patient = auth()->user()->patient;
                $total = $patient ? \App\Models\Appointment::where('patient_id',$patient->id)->count() : 0;
                $pending = $patient ? \App\Models\Appointment::where('patient_id',$patient->id)->where('status','pending')->count() : 0;
                $confirmed = $patient ? \App\Models\Appointment::where('patient_id',$patient->id)->where('status','confirmed')->count() : 0;
            @endphp
            <div style="background:white; border-radius:14px; padding:24px; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08); display:flex; align-items:center; gap:16px;">
                <div style="width:52px; height:52px; background:#f0fdfa; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="fa-regular fa-calendar-days" style="color:#0d9488; font-size:22px;"></i>
                </div>
                <div>
                    <div style="font-size:28px; font-weight:800; color:#0f172a;">{{ $total }}</div>
                    <div style="font-size:13px; color:#6b7280;">Total Appointments</div>
                </div>
            </div>
            <div style="background:white; border-radius:14px; padding:24px; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08); display:flex; align-items:center; gap:16px;">
                <div style="width:52px; height:52px; background:#fefce8; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="fa-regular fa-clock" style="color:#d97706; font-size:22px;"></i>
                </div>
                <div>
                    <div style="font-size:28px; font-weight:800; color:#0f172a;">{{ $pending }}</div>
                    <div style="font-size:13px; color:#6b7280;">Pending</div>
                </div>
            </div>
            <div style="background:white; border-radius:14px; padding:24px; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08); display:flex; align-items:center; gap:16px;">
                <div style="width:52px; height:52px; background:#f0fdf4; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="fa-regular fa-circle-check" style="color:#16a34a; font-size:22px;"></i>
                </div>
                <div>
                    <div style="font-size:28px; font-weight:800; color:#0f172a;">{{ $confirmed }}</div>
                    <div style="font-size:13px; color:#6b7280;">Confirmed</div>
                </div>
            </div>
        </div>

        {{-- Quick Links + Recent Appointments --}}
        <div style="display:grid; grid-template-columns:1fr 2fr; gap:24px;">

            {{-- Quick Links --}}
            <div style="display:flex; flex-direction:column; gap:16px;">
                <div style="background:white; border-radius:14px; padding:20px; border:1px solid #ccfbf1;">
                    <h3 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom:16px;">Quick Actions</h3>
                    <div style="display:flex; flex-direction:column; gap:10px;">
                        <a href="{{ route('patient.book') }}"
                           style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:linear-gradient(135deg,#1e3a8a,#0d9488); border-radius:10px; text-decoration:none;">
                            <i class="fa-regular fa-calendar-plus" style="color:white; font-size:16px;"></i>
                            <span style="color:white; font-size:14px; font-weight:600;">Book Appointment</span>
                        </a>
                        <a href="{{ route('patient.appointments') }}"
                           style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:#f0fdfa; border:1px solid #ccfbf1; border-radius:10px; text-decoration:none;">
                            <i class="fa-regular fa-calendar-check" style="color:#0d9488; font-size:16px;"></i>
                            <span style="color:#0f172a; font-size:14px; font-weight:600;">My Appointments</span>
                        </a>
                        <a href="{{ route('patient.doctors') }}"
                           style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:#f0fdfa; border:1px solid #ccfbf1; border-radius:10px; text-decoration:none;">
                            <i class="fa-solid fa-user-doctor" style="color:#0d9488; font-size:16px;"></i>
                            <span style="color:#0f172a; font-size:14px; font-weight:600;">View Doctors</span>
                        </a>
                        <a href="/user/profile"
                           style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:#f0fdfa; border:1px solid #ccfbf1; border-radius:10px; text-decoration:none;">
                            <i class="fa-solid fa-gear" style="color:#0d9488; font-size:16px;"></i>
                            <span style="color:#0f172a; font-size:14px; font-weight:600;">Account Settings</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Recent Appointments --}}
            <div style="background:white; border-radius:14px; padding:24px; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08);">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                    <h3 style="font-size:15px; font-weight:700; color:#0f172a;">Recent Appointments</h3>
                    <a href="{{ route('patient.appointments') }}" style="font-size:13px; color:#0d9488; font-weight:600; text-decoration:none;">View All →</a>
                </div>

                @php
                    $recentAppointments = $patient
                        ? \App\Models\Appointment::with('doctor.user')->where('patient_id',$patient->id)->latest()->take(5)->get()
                        : collect();
                @endphp

                @if($recentAppointments->isEmpty())
                    <div style="text-align:center; padding:32px; color:#6b7280;">
                        <i class="fa-regular fa-calendar-xmark" style="font-size:32px; color:#ccfbf1; margin-bottom:12px; display:block;"></i>
                        No appointments yet. <a href="{{ route('patient.book') }}" style="color:#0d9488; font-weight:600;">Book one now →</a>
                    </div>
                @else
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:2px solid #f0fdfa;">
                                <th style="text-align:left; padding:10px 12px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:1px;">Doctor</th>
                                <th style="text-align:left; padding:10px 12px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:1px;">Date</th>
                                <th style="text-align:left; padding:10px 12px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:1px;">Time</th>
                                <th style="text-align:left; padding:10px 12px; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:1px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentAppointments as $appt)
                            <tr style="border-bottom:1px solid #f0fdfa;">
                                <td style="padding:12px; font-size:14px; color:#0f172a; font-weight:500;">Dr. {{ $appt->doctor->user->name }}</td>
                                <td style="padding:12px; font-size:14px; color:#6b7280;">{{ $appt->appointment_date }}</td>
                                <td style="padding:12px; font-size:14px; color:#6b7280;">{{ $appt->appointment_time }}</td>
                                <td style="padding:12px;">
                                    <span style="padding:4px 12px; border-radius:50px; font-size:12px; font-weight:600;
                                        {{ $appt->status === 'confirmed' ? 'background:#dcfce7; color:#16a34a;' : '' }}
                                        {{ $appt->status === 'pending' ? 'background:#fef9c3; color:#d97706;' : '' }}
                                        {{ $appt->status === 'cancelled' ? 'background:#fee2e2; color:#dc2626;' : '' }}">
                                        {{ ucfirst($appt->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer style="background:#0f172a; padding:24px 2rem; margin-top:48px;">
        <div style="max-width:1200px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
            <div style="display:flex; align-items:center; gap:8px;">
                <span style="font-size:18px; color:#2dd4bf;">✚</span>
                <span style="font-size:16px; font-weight:700; color:white;">Medi<span style="color:#2dd4bf;">Slot</span></span>
            </div>
            <p style="color:#475569; font-size:13px;">© {{ date('Y') }} MediSlot. All rights reserved.</p>
            <p style="color:#475569; font-size:13px;">Patient Portal</p>
        </div>
    </footer>

</x-app-layout>