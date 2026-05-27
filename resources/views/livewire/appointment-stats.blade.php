<div>
    <div style="display:flex; gap:10px; margin-bottom:16px; flex-wrap:wrap;">
        <button wire:click="setFilter('all')" 
            style="padding:6px 16px; border-radius:20px; font-size:13px; font-weight:600; cursor:pointer; border:none;
            background:{{ $filter === 'all' ? '#0d9488' : '#f0fdfa' }}; color:{{ $filter === 'all' ? 'white' : '#0d9488' }};">
            All ({{ $total }})
        </button>
        <button wire:click="setFilter('pending')"
            style="padding:6px 16px; border-radius:20px; font-size:13px; font-weight:600; cursor:pointer; border:none;
            background:{{ $filter === 'pending' ? '#d97706' : '#fefce8' }}; color:{{ $filter === 'pending' ? 'white' : '#d97706' }};">
            Pending ({{ $pending }})
        </button>
        <button wire:click="setFilter('confirmed')"
            style="padding:6px 16px; border-radius:20px; font-size:13px; font-weight:600; cursor:pointer; border:none;
            background:{{ $filter === 'confirmed' ? '#16a34a' : '#dcfce7' }}; color:{{ $filter === 'confirmed' ? 'white' : '#16a34a' }};">
            Confirmed ({{ $confirmed }})
        </button>
        <button wire:click="setFilter('cancelled')"
            style="padding:6px 16px; border-radius:20px; font-size:13px; font-weight:600; cursor:pointer; border:none;
            background:{{ $filter === 'cancelled' ? '#dc2626' : '#fee2e2' }}; color:{{ $filter === 'cancelled' ? 'white' : '#dc2626' }};">
            Cancelled ({{ $cancelled }})
        </button>
    </div>

    <div wire:loading style="color:#0d9488; font-size:13px; margin-bottom:8px;">
        ⟳ Updating...
    </div>

    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="border-bottom:2px solid #f0fdfa;">
                <th style="text-align:left; padding:10px; font-size:12px; color:#6b7280; text-transform:uppercase;">Patient</th>
                <th style="text-align:left; padding:10px; font-size:12px; color:#6b7280; text-transform:uppercase;">Doctor</th>
                <th style="text-align:left; padding:10px; font-size:12px; color:#6b7280; text-transform:uppercase;">Date</th>
                <th style="text-align:left; padding:10px; font-size:12px; color:#6b7280; text-transform:uppercase;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appt)
            <tr style="border-bottom:1px solid #f0fdfa;">
                <td style="padding:10px; font-size:14px;">{{ $appt->patient->user->name ?? 'N/A' }}</td>
                <td style="padding:10px; font-size:14px; color:#6b7280;">Dr. {{ $appt->doctor->user->name ?? 'N/A' }}</td>
                <td style="padding:10px; font-size:14px; color:#6b7280;">{{ $appt->appointment_date }}</td>
                <td style="padding:10px;">
                    <span style="padding:3px 10px; border-radius:20px; font-size:12px; font-weight:600;
                        background:{{ $appt->status === 'confirmed' ? '#dcfce7' : ($appt->status === 'pending' ? '#fef9c3' : '#fee2e2') }};
                        color:{{ $appt->status === 'confirmed' ? '#16a34a' : ($appt->status === 'pending' ? '#d97706' : '#dc2626') }};">
                        {{ ucfirst($appt->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="padding:20px; text-align:center; color:#6b7280;">No appointments found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>