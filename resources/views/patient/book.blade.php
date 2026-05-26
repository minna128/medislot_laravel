<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">Book an Appointment</h2>
    </x-slot>

    {{-- Hero Banner --}}
    <div style="background:linear-gradient(135deg,#0f172a 0%,#0d9488 100%); padding:32px 2rem;">
        <div style="max-width:1200px; margin:0 auto;">
            <h1 style="font-size:28px; font-weight:800; color:white; margin-bottom:6px;">Book an Appointment</h1>
            <p style="color:#2dd4bf; font-size:14px;">Choose your doctor and preferred time slot</p>
            <div style="display:flex; gap:24px; margin-top:12px;">
                <span style="color:rgba(255,255,255,0.7); font-size:13px;"><i class="fa-solid fa-location-dot" style="margin-right:6px;"></i>MediSlot Clinic</span>
                <span style="color:rgba(255,255,255,0.7); font-size:13px;"><i class="fa-solid fa-user-doctor" style="margin-right:6px;"></i>{{ $doctors->count() }} Doctors Available</span>
            </div>
        </div>
    </div>

    <div style="max-width:1200px; margin:0 auto; padding:32px 2rem;">

        @if(session('success'))
            <div style="background:#dcfce7; color:#16a34a; padding:12px 20px; border-radius:10px; margin-bottom:20px; font-size:14px; font-weight:600;">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background:#fee2e2; color:#dc2626; padding:12px 20px; border-radius:10px; margin-bottom:20px; font-size:14px; font-weight:600;">
                ✗ {{ $errors->first() }}
            </div>
        @endif

        <div style="display:grid; grid-template-columns:2fr 1fr; gap:24px;">

            {{-- Left: Doctor List --}}
            <div>
                <h3 style="font-size:16px; font-weight:700; color:#0f172a; margin-bottom:16px;">Select a Doctor</h3>
                <div style="display:flex; flex-direction:column; gap:12px;">
                    @foreach($doctors as $doctor)
                    <div class="doctor-card"
                         data-id="{{ $doctor->id }}"
                         data-name="{{ $doctor->user->name }}"
                         data-spec="{{ $doctor->specialization ?? 'General' }}"
                         style="background:white; border-radius:14px; padding:16px; display:flex; align-items:center; gap:16px; border:2px solid #ccfbf1; cursor:pointer; transition:all 0.2s;">

                        <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->user->name) }}&background=0d9488&color=fff&size=64&rounded=true"
                             style="width:64px; height:64px; border-radius:50%; flex-shrink:0;">

                        <div style="flex:1;">
                            <h4 style="font-size:16px; font-weight:700; color:#0f172a; margin-bottom:2px;">Dr. {{ $doctor->user->name }}</h4>
                            <p style="color:#0d9488; font-size:13px; font-weight:500; margin-bottom:4px;">{{ $doctor->specialization ?? 'General Practitioner' }}</p>
                            <p style="color:#6b7280; font-size:12px; margin-bottom:2px;"><i class="fa-solid fa-location-dot" style="margin-right:4px;"></i>{{ $doctor->clinic_location ?? 'MediSlot Clinic' }}</p>
                            <p style="color:#6b7280; font-size:12px;"><i class="fa-regular fa-clock" style="margin-right:4px;"></i>{{ $doctor->availability ?? 'Mon-Fri 9am-5pm' }}</p>
                        </div>

                        <div class="check-dot" style="width:24px; height:24px; border-radius:50%; border:2px solid #ccfbf1; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <div class="check-inner" style="width:12px; height:12px; border-radius:50%; background:#0d9488; display:none;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Booking Form --}}
            <div>
                <div style="background:white; border-radius:14px; padding:24px; border:1px solid #ccfbf1; position:sticky; top:24px;">
                    <h3 style="font-size:16px; font-weight:700; color:#0f172a; margin-bottom:20px;">Appointment Details</h3>

                    <form method="POST" action="{{ route('patient.book.store') }}">
                        @csrf
                        <input type="hidden" name="doctor_id" id="selected_doctor_id">

                        {{-- Selected Doctor --}}
                        <div id="selected-doctor-display" style="display:none; background:#f0fdfa; border:1px solid #ccfbf1; border-radius:10px; padding:12px; margin-bottom:16px;">
                            <p style="font-size:11px; color:#6b7280; font-weight:600; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">Selected Doctor</p>
                            <p id="selected-doctor-name" style="font-size:15px; font-weight:700; color:#0f172a;"></p>
                            <p id="selected-doctor-spec" style="font-size:13px; color:#0d9488;"></p>
                        </div>
                        <div id="no-doctor-msg" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:12px; margin-bottom:16px; font-size:13px; color:#94a3b8; text-align:center;">
                            ← Select a doctor first
                        </div>

                        @error('doctor_id')
                            <p style="color:#dc2626; font-size:12px; margin-bottom:12px;">{{ $message }}</p>
                        @enderror

                        <div style="margin-bottom:16px;">
                            <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Date</label>
                            <input type="date" name="appointment_date"
                                   min="{{ now()->toDateString() }}"
                                   value="{{ old('appointment_date') }}"
                                   style="width:100%; padding:10px 14px; border:1.5px solid #e2e8f0; border-radius:8px; font-size:14px; outline:none; font-family:inherit;">
                            @error('appointment_date')
                                <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div style="margin-bottom:16px;">
                            <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Time Slot</label>
                            <div id="time-slots" style="display:grid; grid-template-columns:repeat(3,1fr); gap:8px;">
                                @foreach(['09:00','09:30','10:00','10:30','11:00','11:30','14:00','14:30','15:00','15:30','16:00','16:30'] as $slot)
                                <button type="button"
                                        onclick="selectTime('{{ $slot }}')"
                                        class="time-slot-btn"
                                        data-time="{{ $slot }}"
                                        style="padding:8px; border-radius:8px; border:1.5px solid #e2e8f0; font-size:13px; background:white; cursor:pointer; transition:all 0.2s; font-family:inherit;">
                                    {{ $slot }}
                                </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="appointment_time" id="selected_time">
                            @error('appointment_time')
                                <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div style="margin-bottom:20px;">
                            <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Notes (optional)</label>
                            <textarea name="notes" rows="3"
                                      style="width:100%; padding:10px 14px; border:1.5px solid #e2e8f0; border-radius:8px; font-size:14px; outline:none; font-family:inherit; resize:none;"
                                      placeholder="Any symptoms or notes..."></textarea>
                        </div>

                        <button type="submit"
                                style="width:100%; padding:12px; background:linear-gradient(135deg,#1e3a8a,#0d9488); color:white; border:none; border-radius:10px; font-size:15px; font-weight:700; cursor:pointer; font-family:inherit;">
                            Confirm Booking
                        </button>
                    </form>
                </div>
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
            <p style="color:#475569; font-size:13px;">Patient Portal</p>
        </div>
    </footer>

    <script>
        const doctorAvailability = @json($doctorAvailability);

        function parseHour(str) {
            const match = str.match(/(\d+)(am|pm)/i);
            if (!match) return null;
            let h = parseInt(match[1]);
            if (match[2].toLowerCase() === 'pm' && h !== 12) h += 12;
            if (match[2].toLowerCase() === 'am' && h === 12) h = 0;
            return h;
        }

        function updateTimeSlots(doctorId) {
            const availability = doctorAvailability[doctorId] || '';
            const clean = availability.replace(/\s/g, '');
            const match = clean.match(/(\d+(?:am|pm))-(\d+(?:am|pm))/i);

            document.querySelectorAll('.time-slot-btn').forEach(btn => {
                btn.style.display = 'block';
                btn.disabled = false;
                btn.style.opacity = '1';
            });

            if (match) {
                const startH = parseHour(match[1]);
                const endH = parseHour(match[2]);
                document.querySelectorAll('.time-slot-btn').forEach(btn => {
                    const [h, m] = btn.dataset.time.split(':').map(Number);
                    const t = h + m / 60;
                    if (t < startH || t >= endH) {
                        btn.style.display = 'none';
                    }
                });
            }
        }

        document.querySelectorAll('.doctor-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.doctor-card').forEach(c => {
                    c.style.borderColor = '#ccfbf1';
                    c.querySelector('.check-inner').style.display = 'none';
                });

                card.style.borderColor = '#0d9488';
                card.querySelector('.check-inner').style.display = 'block';

                document.getElementById('selected_doctor_id').value = card.dataset.id;
                document.getElementById('selected-doctor-name').textContent = 'Dr. ' + card.dataset.name;
                document.getElementById('selected-doctor-spec').textContent = card.dataset.spec;
                document.getElementById('selected-doctor-display').style.display = 'block';
                document.getElementById('no-doctor-msg').style.display = 'none';

                document.querySelectorAll('.time-slot-btn').forEach(btn => {
                    btn.style.background = 'white';
                    btn.style.color = '#0f172a';
                    btn.style.borderColor = '#e2e8f0';
                });
                document.getElementById('selected_time').value = '';

                updateTimeSlots(card.dataset.id);
            });
        });

        function selectTime(time) {
            document.querySelectorAll('.time-slot-btn').forEach(btn => {
                btn.style.background = 'white';
                btn.style.color = '#0f172a';
                btn.style.borderColor = '#e2e8f0';
            });
            const btn = document.querySelector(`[data-time="${time}"]`);
            btn.style.background = '#0d9488';
            btn.style.color = 'white';
            btn.style.borderColor = '#0d9488';
            document.getElementById('selected_time').value = time;
        }
    </script>
</x-app-layout>