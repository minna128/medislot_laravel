<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">Manage Clinics</h2>
    </x-slot>

    <div style="max-width:1200px; margin:0 auto; padding:32px 2rem;">

        @if(session('success'))
            <div style="background:#dcfce7; color:#16a34a; padding:12px 20px; border-radius:10px; margin-bottom:20px; font-size:14px; font-weight:600;">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div style="background:white; border-radius:14px; padding:28px; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
                <h3 style="font-size:18px; font-weight:700; color:#0f172a;">All Clinics</h3>
                <a href="{{ route('admin.clinic.create') }}"
                   style="display:inline-flex; align-items:center; gap:8px; background:linear-gradient(135deg,#1e3a8a,#0d9488); color:white; padding:10px 20px; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none;">
                    <i class="fa-solid fa-plus"></i> Add Clinic
                </a>
            </div>

            @if($clinics->isEmpty())
                <div style="text-align:center; padding:48px; color:#6b7280;">
                    <i class="fa-solid fa-hospital" style="font-size:40px; color:#ccfbf1; margin-bottom:16px; display:block;"></i>
                    No clinics yet. Add your first clinic!
                </div>
            @else
                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px;">
                    @foreach($clinics as $clinic)
                    <div style="background:#f8fafc; border-radius:12px; padding:20px; border:1px solid #ccfbf1;">
                        <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
                            <div style="width:48px; height:48px; background:linear-gradient(135deg,#1e3a8a,#0d9488); border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                <i class="fa-solid fa-hospital" style="color:white; font-size:20px;"></i>
                            </div>
                            <div>
                                <div style="font-size:15px; font-weight:700; color:#0f172a;">{{ $clinic->name }}</div>
                                <div style="font-size:12px; color:#0d9488;">{{ $clinic->doctors->count() }} Doctor(s)</div>
                            </div>
                        </div>
                        <div style="display:flex; flex-direction:column; gap:6px; margin-bottom:16px;">
                            <div style="font-size:13px; color:#6b7280;">
                                <i class="fa-solid fa-location-dot" style="color:#0d9488; margin-right:6px;"></i>{{ $clinic->location }}
                            </div>
                            @if($clinic->phone)
                            <div style="font-size:13px; color:#6b7280;">
                                <i class="fa-solid fa-phone" style="color:#0d9488; margin-right:6px;"></i>{{ $clinic->phone }}
                            </div>
                            @endif
                            @if($clinic->hours)
                            <div style="font-size:13px; color:#6b7280;">
                                <i class="fa-regular fa-clock" style="color:#0d9488; margin-right:6px;"></i>{{ $clinic->hours }}
                            </div>
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

                        <div style="display:flex; gap:8px;">
                            <a href="{{ route('admin.clinic.edit', $clinic->id) }}"
                               style="flex:1; text-align:center; background:#eff6ff; color:#1e3a8a; border:none; padding:8px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; display:block;">
                                <i class="fa-solid fa-pen" style="margin-right:4px;"></i>Edit
                            </a>
                            <form method="POST" action="{{ route('admin.clinic.delete', $clinic->id) }}"
                                  onsubmit="return confirm('Delete this clinic?')" style="flex:1;">
                                @csrf
                                @method('DELETE')
                                <button style="width:100%; background:#fee2e2; color:#dc2626; border:none; padding:8px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer;">
                                    <i class="fa-solid fa-trash" style="margin-right:4px;"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <footer style="background:#0f172a; padding:24px 2rem; margin-top:48px;">
        <div style="max-width:1200px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
            <div style="display:flex; align-items:center; gap:8px;">
                <span style="font-size:18px; color:#2dd4bf;">✚</span>
                <span style="font-size:16px; font-weight:700; color:white;">Medi<span style="color:#2dd4bf;">Slot</span></span>
            </div>
            <p style="color:#475569; font-size:13px;">© {{ date('Y') }} MediSlot. All rights reserved.</p>
            <p style="color:#475569; font-size:13px;">Admin Portal</p>
        </div>
    </footer>
</x-app-layout>