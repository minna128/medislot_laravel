<div>
    <div style="margin-bottom:16px;">
        <input wire:model.live="search" 
            type="text" 
            placeholder="🔍 Search doctors by name or specialization..."
            style="width:100%; padding:10px 16px; border-radius:10px; border:1px solid #ccfbf1; font-size:14px; outline:none; color:#0f172a;">
    </div>

    <div wire:loading style="color:#0d9488; font-size:13px; margin-bottom:8px;">
        ⟳ Searching...
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:12px;">
        @forelse($doctors as $doctor)
        <div style="background:#f0fdfa; border-radius:12px; padding:16px; border:1px solid #ccfbf1;">
            <div style="width:40px; height:40px; background:#0d9488; border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:10px;">
                <span style="color:white; font-weight:700; font-size:16px;">{{ strtoupper(substr($doctor->user->name, 0, 1)) }}</span>
            </div>
            <p style="font-size:14px; font-weight:700; color:#0f172a;">Dr. {{ $doctor->user->name }}</p>
            <p style="font-size:12px; color:#0d9488; margin-top:2px;">{{ $doctor->specialization ?? 'General' }}</p>
            <p style="font-size:12px; color:#6b7280; margin-top:4px;">{{ $doctor->availability ?? 'Available' }}</p>
        </div>
        @empty
        <p style="color:#6b7280; font-size:14px; grid-column:1/-1;">No doctors found for "{{ $search }}"</p>
        @endforelse
    </div>
</div>