<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">
            Reassign Appointment
        </h2>
    </x-slot>

    <div style="
        background:#f0fdfa;
        min-height:100vh;
        padding:32px 2rem;
    ">

        <div style="
            max-width:700px;
            margin:0 auto;
            background:white;
            border-radius:18px;
            border:1px solid #99f6e4;
            padding:32px;
            box-shadow:0 4px 14px rgba(0,0,0,0.04);
        ">

            <div style="margin-bottom:28px;">

                <h2 style="
                    font-size:28px;
                    font-weight:800;
                    color:#0f172a;
                    margin-bottom:8px;
                ">
                    Reassign Appointment
                </h2>

                <p style="
                    color:#64748b;
                    font-size:14px;
                ">
                    Change the assigned doctor for this appointment.
                </p>

            </div>

            {{-- Current Appointment Info --}}
            <div style="
                background:#f8fafc;
                border:1px solid #e2e8f0;
                border-radius:14px;
                padding:18px;
                margin-bottom:24px;
            ">

                <div style="
                    display:grid;
                    grid-template-columns:1fr 1fr;
                    gap:16px;
                ">

                    <div>
                        <p style="
                            font-size:12px;
                            color:#64748b;
                            margin-bottom:4px;
                            font-weight:600;
                            text-transform:uppercase;
                        ">
                            Patient
                        </p>

                        <p style="
                            font-size:15px;
                            font-weight:700;
                            color:#0f172a;
                        ">
                            {{ $appointment->patient->user->name }}
                        </p>
                    </div>

                    <div>
                        <p style="
                            font-size:12px;
                            color:#64748b;
                            margin-bottom:4px;
                            font-weight:600;
                            text-transform:uppercase;
                        ">
                            Current Doctor
                        </p>

                        <p style="
                            font-size:15px;
                            font-weight:700;
                            color:#0f172a;
                        ">
                            Dr. {{ $appointment->doctor->user->name }}
                        </p>
                    </div>

                    <div>
                        <p style="
                            font-size:12px;
                            color:#64748b;
                            margin-bottom:4px;
                            font-weight:600;
                            text-transform:uppercase;
                        ">
                            Appointment Date
                        </p>

                        <p style="
                            font-size:15px;
                            font-weight:700;
                            color:#0f172a;
                        ">
                            {{ $appointment->appointment_date }}
                        </p>
                    </div>

                    <div>
                        <p style="
                            font-size:12px;
                            color:#64748b;
                            margin-bottom:4px;
                            font-weight:600;
                            text-transform:uppercase;
                        ">
                            Time
                        </p>

                        <p style="
                            font-size:15px;
                            font-weight:700;
                            color:#0f172a;
                        ">
                            {{ $appointment->appointment_time }}
                        </p>
                    </div>

                </div>

            </div>

            <form method="POST"
                  action="{{ route('admin.reassign', $appointment) }}">

                @csrf

                <div style="margin-bottom:24px;">

                    <label style="
                        display:block;
                        font-size:13px;
                        font-weight:700;
                        color:#334155;
                        margin-bottom:8px;
                    ">
                        Select New Doctor
                    </label>

                    <select name="doctor_id"
                            style="
                                width:100%;
                                padding:12px 14px;
                                border:1.5px solid #cbd5e1;
                                border-radius:10px;
                                font-size:14px;
                                outline:none;
                                font-family:inherit;
                            ">

                        @foreach($doctors as $doctor)

                            <option value="{{ $doctor->id }}"
                                {{ $doctor->id == $appointment->doctor_id ? 'selected' : '' }}>

                                Dr. {{ $doctor->user->name }}
                                —
                                {{ $doctor->specialization ?? 'General' }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div style="
                    display:flex;
                    gap:12px;
                    align-items:center;
                ">

                    <button type="submit"
                            style="
                                background:#0d9488;
                                color:white;
                                border:none;
                                padding:12px 20px;
                                border-radius:10px;
                                font-size:14px;
                                font-weight:700;
                                cursor:pointer;
                                transition:all 0.2s;
                            ">
                        Reassign Appointment
                    </button>

                    <a href="{{ route('admin.appointments') }}"
                       style="
                            color:#64748b;
                            text-decoration:none;
                            font-size:14px;
                            font-weight:600;
                       ">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>