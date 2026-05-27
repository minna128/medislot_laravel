<div style="display:inline-flex; align-items:center; gap:8px;">
    <span style="padding:3px 10px; border-radius:20px; font-size:12px; font-weight:600;
        background:{{ $status === 'confirmed' ? '#dcfce7' : ($status === 'pending' ? '#fef9c3' : '#fee2e2') }};
        color:{{ $status === 'confirmed' ? '#16a34a' : ($status === 'pending' ? '#d97706' : '#dc2626') }};">
        {{ ucfirst($status) }}
    </span>

    @if($status === 'pending')
    <button wire:click="updateStatus('confirmed')"
        style="padding:3px 10px; border-radius:20px; font-size:12px; font-weight:600; cursor:pointer; border:none; background:#dcfce7; color:#16a34a;">
        ✓ Confirm
    </button>
    <button wire:click="updateStatus('cancelled')"
        style="padding:3px 10px; border-radius:20px; font-size:12px; font-weight:600; cursor:pointer; border:none; background:#fee2e2; color:#dc2626;">
        ✗ Cancel
    </button>
    @endif

    @if($message)
    <span style="font-size:12px; color:#0d9488;">{{ $message }}</span>
    @endif

    <div wire:loading style="font-size:12px; color:#0d9488;">Updating...</div>
</div>