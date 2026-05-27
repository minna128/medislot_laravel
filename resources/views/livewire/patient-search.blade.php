<div>
    <div style="margin-bottom:16px;">
        <input wire:model.live="search"
            type="text"
            placeholder="🔍 Search patients by name or email..."
            style="width:100%; padding:10px 16px; border-radius:10px; border:1px solid #ccfbf1; font-size:14px; outline:none; color:#0f172a;">
    </div>

    <div wire:loading style="color:#0d9488; font-size:13px; margin-bottom:8px;">
        ⟳ Searching...
    </div>

    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="border-bottom:2px solid #f0fdfa;">
                <th style="text-align:left; padding:10px; font-size:12px; color:#6b7280; text-transform:uppercase;">Name</th>
                <th style="text-align:left; padding:10px; font-size:12px; color:#6b7280; text-transform:uppercase;">Email</th>
                <th style="text-align:left; padding:10px; font-size:12px; color:#6b7280; text-transform:uppercase;">Phone</th>
                <th style="text-align:left; padding:10px; font-size:12px; color:#6b7280; text-transform:uppercase;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
            <tr style="border-bottom:1px solid #f0fdfa;">
                <td style="padding:10px; font-size:14px; font-weight:600; color:#0f172a;">{{ $patient->user->name }}</td>
                <td style="padding:10px; font-size:14px; color:#6b7280;">{{ $patient->user->email }}</td>
                <td style="padding:10px; font-size:14px; color:#6b7280;">{{ $patient->phone ?? 'N/A' }}</td>
                <td style="padding:10px;">
                    <span style="padding:3px 10px; border-radius:20px; font-size:12px; font-weight:600;
                        background:{{ ($patient->status ?? 'active') === 'active' ? '#dcfce7' : '#fee2e2' }};
                        color:{{ ($patient->status ?? 'active') === 'active' ? '#16a34a' : '#dc2626' }};">
                        {{ ucfirst($patient->status ?? 'active') }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="padding:20px; text-align:center; color:#6b7280;">No patients found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>