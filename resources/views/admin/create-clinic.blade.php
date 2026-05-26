<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">Add New Clinic</h2>
    </x-slot>

    <div style="max-width:800px; margin:0 auto; padding:32px 2rem;">
        <div style="background:white; border-radius:14px; overflow:hidden; border:1px solid #ccfbf1; box-shadow:0 2px 8px rgba(13,148,136,0.08);">
            <div style="background:linear-gradient(135deg,#0f172a,#0d9488); padding:24px 28px; display:flex; align-items:center; gap:16px;">
                <div style="width:48px; height:48px; background:rgba(255,255,255,0.1); border-radius:12px; display:flex; align-items:center; justify-content:center;">
                    <i class="fa-solid fa-hospital" style="color:white; font-size:22px;"></i>
                </div>
                <div>
                    <h2 style="font-size:20px; font-weight:800; color:white;">Add New Clinic</h2>
                    <p style="color:#2dd4bf; font-size:13px;">Create a new clinic and assign doctors</p>
                </div>
            </div>

            <div style="padding:28px;">
                <form method="POST" action="{{ route('admin.clinic.store') }}">
                    @csrf

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Clinic Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit;">
                            @error('name') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                   style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit;">
                            @error('location') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit;">
                        </div>
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Opening Hours</label>
                            <input type="text" name="hours" value="{{ old('hours') }}"
                                   placeholder="e.g. Mon-Fri 8am-6pm"
                                   style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit;">
                        </div>
                    </div>

                    <div style="margin-bottom:16px;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Description</label>
                        <textarea name="description" rows="3"
                                  style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit; resize:none;">{{ old('description') }}</textarea>
                    </div>

                    <div style="margin-bottom:24px;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Assign Doctors</label>
                        <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:8px;">
                            @foreach($doctors as $doctor)
                            <label style="display:flex; align-items:center; gap:10px; padding:10px 14px; background:#f8fafc; border:1.5px solid #e5e7eb; border-radius:8px; cursor:pointer;">
                                <input type="checkbox" name="doctors[]" value="{{ $doctor->id }}"
                                       style="width:16px; height:16px; accent-color:#0d9488;">
                                <div>
                                    <div style="font-size:14px; font-weight:600; color:#0f172a;">Dr. {{ $doctor->user->name }}</div>
                                    <div style="font-size:12px; color:#0d9488;">{{ $doctor->specialization ?? 'General' }}</div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div style="display:flex; gap:12px;">
                        <button type="submit"
                                style="background:linear-gradient(135deg,#1e3a8a,#0d9488); color:white; border:none; padding:12px 32px; border-radius:10px; font-size:15px; font-weight:700; cursor:pointer;">
                            Create Clinic
                        </button>
                        <a href="{{ route('admin.clinics') }}"
                           style="background:#f0fdfa; color:#0f172a; border:1px solid #ccfbf1; padding:12px 24px; border-radius:10px; font-size:15px; font-weight:600; text-decoration:none; display:inline-block;">
                            Cancel
                        </a>
                    </div>
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
            <p style="color:#475569; font-size:13px;">Admin Portal</p>
        </div>
    </footer>
</x-app-layout>