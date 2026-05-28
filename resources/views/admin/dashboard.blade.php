<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">Admin Dashboard</h2>
    </x-slot>

    {{-- Hero Banner --}}
    <div style="background:linear-gradient(135deg,#0f172a 0%,#0d9488 100%); padding:32px 2rem;">
        <div style="max-width:1200px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
            <div>
                <p style="color:#2dd4bf; font-size:13px; font-weight:600; text-transform:uppercase; letter-spacing:2px; margin-bottom:6px;">Admin Panel</p>
                <h1 style="font-size:28px; font-weight:800; color:white; margin-bottom:4px;">Welcome, {{ auth()->user()->name }}</h1>
                <p style="color:rgba(255,255,255,0.7); font-size:14px;">{{ now()->format('l, F j, Y') }}</p>
            </div>
            <div style="display:flex; gap:12px;">
                <a href="{{ route('admin.appointments') }}"
                   style="display:inline-flex; align-items:center; gap:8px; background:white; color:#0d9488; padding:10px 20px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none;">
                    <i class="fa-regular fa-calendar-check"></i> View Appointments
                </a>
            </div>
        </div>
    </div>

    <div style="max-width:1200px; margin:0 auto; padding:32px 2rem;">

        {{-- Stats Row --}}
        <div class="stats-grid" style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom:28px;">
            <div style="background:white; border-radius:14px; padding:24px; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08); display:flex; align-items:center; gap:16px;">
                <div style="width:52px; height:52px; background:#f0fdfa; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="fa-solid fa-user-doctor" style="color:#0d9488; font-size:22px;"></i>
                </div>
                <div>
                    <div style="font-size:28px; font-weight:800; color:#0f172a;">{{ $totalDoctors }}</div>
                    <div style="font-size:13px; color:#6b7280;">Doctors</div>
                </div>
            </div>
            <div style="background:white; border-radius:14px; padding:24px; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08); display:flex; align-items:center; gap:16px;">
                <div style="width:52px; height:52px; background:#eff6ff; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="fa-solid fa-users" style="color:#1e3a8a; font-size:22px;"></i>
                </div>
                <div>
                    <div style="font-size:28px; font-weight:800; color:#0f172a;">{{ $totalPatients }}</div>
                    <div style="font-size:13px; color:#6b7280;">Patients</div>
                </div>
            </div>
            <div style="background:white; border-radius:14px; padding:24px; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08); display:flex; align-items:center; gap:16px;">
                <div style="width:52px; height:52px; background:#f0fdfa; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="fa-regular fa-calendar-days" style="color:#0d9488; font-size:22px;"></i>
                </div>
                <div>
                    <div style="font-size:28px; font-weight:800; color:#0f172a;">{{ $totalAppointments }}</div>
                    <div style="font-size:13px; color:#6b7280;">Appointments</div>
                </div>
            </div>
            <div style="background:white; border-radius:14px; padding:24px; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08); display:flex; align-items:center; gap:16px;">
                <div style="width:52px; height:52px; background:#fefce8; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="fa-regular fa-clock" style="color:#d97706; font-size:22px;"></i>
                </div>
                <div>
                    <div style="font-size:28px; font-weight:800; color:#0f172a;">{{ $pendingCount }}</div>
                    <div style="font-size:13px; color:#6b7280;">Pending</div>
                </div>
            </div>
        </div>

        {{-- Livewire Real Time Clock --}}
        <div style="margin-bottom:28px;">
            @livewire('real-time-clock')
        </div>

        {{-- Quick Actions + Charts + Live Filter --}}
        <div class="dashboard-grid" style="display:grid; grid-template-columns:1fr 2fr; gap:24px;">

            {{-- Left: Quick Actions --}}
            <div style="background:white; border-radius:14px; padding:20px; border:1px solid #ccfbf1;">
                <h3 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom:16px;">Quick Actions</h3>
                <div style="display:flex; flex-direction:column; gap:10px;">
                    <a href="{{ route('admin.doctors') }}" style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:linear-gradient(135deg,#1e3a8a,#0d9488); border-radius:10px; text-decoration:none;">
                        <i class="fa-solid fa-user-doctor" style="color:white; font-size:16px;"></i>
                        <span style="color:white; font-size:14px; font-weight:600;">Manage Doctors</span>
                    </a>
                    <a href="{{ route('admin.patients') }}" style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:#f0fdfa; border:1px solid #ccfbf1; border-radius:10px; text-decoration:none;">
                        <i class="fa-solid fa-users" style="color:#0d9488; font-size:16px;"></i>
                        <span style="color:#0f172a; font-size:14px; font-weight:600;">Manage Patients</span>
                    </a>
                    <a href="{{ route('admin.appointments') }}" style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:#f0fdfa; border:1px solid #ccfbf1; border-radius:10px; text-decoration:none;">
                        <i class="fa-solid fa-calendar-check" style="color:#0d9488; font-size:16px;"></i>
                        <span style="color:#0f172a; font-size:14px; font-weight:600;">Manage Appointments</span>
                    </a>
                    <a href="{{ route('admin.doctor.create') }}" style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:#f0fdfa; border:1px solid #ccfbf1; border-radius:10px; text-decoration:none;">
                        <i class="fa-solid fa-user-plus" style="color:#0d9488; font-size:16px;"></i>
                        <span style="color:#0f172a; font-size:14px; font-weight:600;">Add New Doctor</span>
                    </a>
                    <a href="{{ route('admin.patient.create') }}" style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:#f0fdfa; border:1px solid #ccfbf1; border-radius:10px; text-decoration:none;">
                        <i class="fa-solid fa-user-plus" style="color:#0d9488; font-size:16px;"></i>
                        <span style="color:#0f172a; font-size:14px; font-weight:600;">Add New Patient</span>
                    </a>
                    <a href="{{ route('admin.clinics') }}" style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:#f0fdfa; border:1px solid #ccfbf1; border-radius:10px; text-decoration:none;">
                        <i class="fa-solid fa-hospital" style="color:#0d9488; font-size:16px;"></i>
                        <span style="color:#0f172a; font-size:14px; font-weight:600;">Manage Clinics</span>
                    </a>
                    <a href="{{ route('admin.api.explorer') }}" style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:#f0fdfa; border:1px solid #ccfbf1; border-radius:10px; text-decoration:none;">
                        <i class="fa-solid fa-code" style="color:#0d9488; font-size:16px;"></i>
                        <span style="color:#0f172a; font-size:14px; font-weight:600;">API Explorer</span>
                    </a>
                </div>
            </div>

            {{-- Right: Charts + Live Filter --}}
            <div style="display:flex; flex-direction:column; gap:20px;">

                {{-- Charts --}}
                <div class="charts-grid" style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px;">
                    <div wire:ignore style="background:white; border-radius:14px; padding:20px; border:1px solid #ccfbf1;">
                        <h3 style="font-size:13px; font-weight:700; color:#0f172a; margin-bottom:12px;">📈 This Week</h3>
                        <canvas id="lineChart" style="max-height:180px;"></canvas>
                    </div>
                    <div wire:ignore style="background:white; border-radius:14px; padding:20px; border:1px solid #ccfbf1;">
                        <h3 style="font-size:13px; font-weight:700; color:#0f172a; margin-bottom:12px;">📊 By Status</h3>
                        <canvas id="barChart" style="max-height:180px;"></canvas>
                    </div>
                    <div wire:ignore style="background:white; border-radius:14px; padding:20px; border:1px solid #ccfbf1;">
                        <h3 style="font-size:13px; font-weight:700; color:#0f172a; margin-bottom:12px;">🍩 By Role</h3>
                        <canvas id="doughnutChart" style="max-height:180px;"></canvas>
                    </div>
                </div>

                {{-- Live Appointment Filter --}}
                <div style="background:white; border-radius:14px; padding:24px; border:1px solid #ccfbf1;">
                    <h3 style="font-size:15px; font-weight:700; color:#0f172a; margin-bottom:16px;">📋 Live Appointment Filter</h3>
                    @livewire('appointment-stats')
                </div>

            </div>

        </div>
    </div>

    {{-- Footer --}}
    <footer style="background:#0f172a; padding:24px 2rem; margin-top:48px;">
        <div style="max-width:1200px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
            <div style="display:flex; align-items:center; gap:8px;">
                <svg width="28" height="28" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="44" height="44" rx="10" fill="#0d9488"/><path d="M22 34s-14-9-14-18a8 8 0 0 1 14-5.3A8 8 0 0 1 36 16c0 9-14 18-14 18z" fill="white"/><polyline points="8,22 14,22 17,16 20,28 23,20 26,24 30,24 36,24" stroke="#0f172a" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span style="font-size:16px; font-weight:700; color:white;">Medi<span style="color:#2dd4bf;">Slot</span></span>
            </div>
            <p style="color:#475569; font-size:13px;">© {{ date('Y') }} MediSlot. All rights reserved.</p>
            <p style="color:#475569; font-size:13px;">Admin Portal</p>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($weekLabels) !!},
            datasets: [{
                label: 'Appointments',
                data: {!! json_encode($weekData) !!},
                borderColor: '#0d9488',
                backgroundColor: 'rgba(13,148,136,0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#0d9488',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { labels: { color: '#6b7280' } } },
            scales: {
                x: { ticks: { color: '#6b7280' }, grid: { color: '#f0fdfa' } },
                y: { ticks: { color: '#6b7280' }, grid: { color: '#f0fdfa' }, beginAtZero: true }
            }
        }
    });

    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Pending', 'Confirmed', 'Cancelled'],
            datasets: [{
                label: 'Appointments',
                data: {!! json_encode([$pendingCount, $confirmedCount, $cancelledCount]) !!},
                backgroundColor: ['#fbbf24', '#10b981', '#ef4444'],
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: '#6b7280' }, grid: { color: '#f0fdfa' } },
                y: { ticks: { color: '#6b7280' }, grid: { color: '#f0fdfa' }, beginAtZero: true }
            }
        }
    });

    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Patients', 'Doctors', 'Admins'],
            datasets: [{
                data: {!! json_encode([$totalPatients, $totalDoctors, 1]) !!},
                backgroundColor: ['#0d9488', '#1e40af', '#a855f7'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { labels: { color: '#6b7280' } } }
        }
    });
</script>

<style>
@media (max-width: 768px) {
    .dashboard-grid { grid-template-columns: 1fr !important; }
    .charts-grid { grid-template-columns: 1fr !important; }
    .stats-grid { grid-template-columns: repeat(2,1fr) !important; }
}
</style>

</x-app-layout>
