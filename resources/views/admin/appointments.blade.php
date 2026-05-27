<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">
            Manage Appointments
        </h2>
    </x-slot>

    <div style="background:#f0fdfa; min-height:100vh; padding:32px 2rem;">

        <div style="
            max-width:1200px;
            margin:0 auto;
            background:white;
            border-radius:18px;
            border:1px solid #99f6e4;
            padding:28px;
            box-shadow:0 4px 14px rgba(0,0,0,0.04);
        ">

            @if(session('success'))
                <div style="
                    background:#dcfce7;
                    color:#15803d;
                    padding:12px 18px;
                    border-radius:10px;
                    margin-bottom:20px;
                    font-weight:600;
                ">
                    {{ session('success') }}
                </div>
            @endif

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:24px;
            ">

                <h3 style="
                    font-size:24px;
                    font-weight:700;
                    color:#0f172a;
                ">
                    All Appointments
                </h3>

                <div style="
                    background:#ccfbf1;
                    color:#0f766e;
                    padding:8px 14px;
                    border-radius:999px;
                    font-size:13px;
                    font-weight:600;
                ">
                    {{ $appointments->count() }} Records
                </div>

            </div>

            @if($appointments->isEmpty())

                <div style="
                    text-align:center;
                    padding:40px;
                    color:#94a3b8;
                ">
                    No appointments found.
                </div>

            @else

            <div style="overflow-x:auto;">

                <table style="
                    width:100%;
                    border-collapse:collapse;
                ">

                    <thead>

                        <tr style="
                            border-bottom:1px solid #ccfbf1;
                            color:#64748b;
                            font-size:13px;
                            text-transform:uppercase;
                            letter-spacing:0.5px;
                        ">
                            <th style="padding:14px; text-align:left;">Patient</th>
                            <th style="padding:14px; text-align:left;">Doctor</th>
                            <th style="padding:14px; text-align:left;">Date</th>
                            <th style="padding:14px; text-align:left;">Time</th>
                            <th style="padding:14px; text-align:left;">Status</th>
                            <th style="padding:14px; text-align:left;">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($appointments as $appt)

                        <tr style="
                            border-bottom:1px solid #ecfeff;
                        ">

                            <td style="
                                padding:18px 14px;
                                font-weight:600;
                                color:#0f172a;
                            ">
                                {{ $appt->patient->user->name }}
                            </td>

                            <td style="
                                padding:18px 14px;
                                color:#334155;
                            ">
                                Dr. {{ $appt->doctor->user->name }}
                            </td>

                            <td style="
                                padding:18px 14px;
                                color:#334155;
                            ">
                                {{ $appt->appointment_date }}
                            </td>

                            <td style="
                                padding:18px 14px;
                                color:#334155;
                            ">
                                {{ $appt->appointment_time }}
                            </td>

                            <td style="padding:18px 14px;">

                                @if($appt->status === 'confirmed')

                                    <span style="
                                        background:#dcfce7;
                                        color:#16a34a;
                                        padding:6px 14px;
                                        border-radius:999px;
                                        font-size:12px;
                                        font-weight:700;
                                    ">
                                        Confirmed
                                    </span>

                                @elseif($appt->status === 'pending')

                                    <span style="
                                        background:#fef9c3;
                                        color:#ca8a04;
                                        padding:6px 14px;
                                        border-radius:999px;
                                        font-size:12px;
                                        font-weight:700;
                                    ">
                                        Pending
                                    </span>

                                @else

                                    <span style="
                                        background:#fee2e2;
                                        color:#dc2626;
                                        padding:6px 14px;
                                        border-radius:999px;
                                        font-size:12px;
                                        font-weight:700;
                                    ">
                                        Cancelled
                                    </span>

                                @endif

                            </td>

                            <td style="padding:18px 14px;">

                                <div style="
                                        display:flex;
                                        gap:8px;
                                        align-items:center;
                                        flex-wrap:nowrap;
                                    ">

                                    @if($appt->status === 'pending')

                                        <form method="POST"
                                              action="{{ route('admin.confirm', $appt->id) }}">

                                            @csrf

                                            <button style="
                                                background:#dcfce7;
                                                color:#15803d;
                                                border:none;
                                                padding:8px 14px;
                                                border-radius:8px;
                                                font-size:12px;
                                                font-weight:600;
                                                cursor:pointer;
                                                transition:all 0.2s;
                                            ">
                                                Confirm
                                            </button>
                                        </form>

                                        <form method="POST"
                                              action="{{ route('admin.cancel', $appt->id) }}">

                                            @csrf

                                            <button style="
                                                background:#fef3c7;
                                                color:#b45309;
                                                border:none;
                                                padding:8px 14px;
                                                border-radius:8px;
                                                font-size:12px;
                                                font-weight:600;
                                                cursor:pointer;
                                                transition:all 0.2s;
                                            ">
                                                Cancel
                                            </button>
                                        </form>

                                    @endif

                                    <a href="{{ route('admin.reassign.form', $appt->id) }}"
                                       style="
                                            background:#ccfbf1;
                                            color:#0f766e;
                                            padding:8px 14px;
                                            border-radius:8px;
                                            font-size:12px;
                                            font-weight:600;
                                            text-decoration:none;
                                            transition:all 0.2s;
                                       ">
                                        Reassign
                                    </a>

                                    <form method="POST"
                                          action="{{ route('admin.appointment.delete', $appt->id) }}"
                                          onsubmit="return confirm('Delete this appointment?')">

                                        @csrf
                                        @method('DELETE')

                                        <button style="
                                            background:#fef2f2;
                                            color:#b91c1c;
                                            border:none;
                                            padding:8px 14px;
                                            border-radius:8px;
                                            font-size:12px;
                                            font-weight:600;
                                            cursor:pointer;
                                            transition:all 0.2s;
                                        ">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            @endif

        </div>

    </div>
</x-app-layout>