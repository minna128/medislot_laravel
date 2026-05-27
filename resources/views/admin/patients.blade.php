<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:white;">
            Manage Patients
        </h2>
    </x-slot>

    <div style="max-width:1200px; margin:0 auto; padding:32px 2rem;">

        @if(session('success'))
            <div style="
                background:#dcfce7;
                color:#16a34a;
                padding:12px 20px;
                border-radius:10px;
                margin-bottom:20px;
                font-size:14px;
                font-weight:600;
            ">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div style="
            background:white;
            border-radius:14px;
            padding:28px;
            border:1px solid #ccfbf1;
            box-shadow:0 2px 8px rgba(13,148,136,0.08);
        ">

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:24px;
            ">

                <h3 style="
                    font-size:18px;
                    font-weight:700;
                    color:#0f172a;
                ">
                    All Patients
                </h3>

                <a href="{{ route('admin.patient.create') }}"
                   style="
                        display:inline-flex;
                        align-items:center;
                        gap:8px;
                        background:#0d9488;
                        color:white;
                        padding:10px 18px;
                        border-radius:10px;
                        font-size:14px;
                        font-weight:600;
                        text-decoration:none;
                        transition:all 0.2s;
                        box-shadow:0 2px 8px rgba(13,148,136,0.15);
                   ">

                    <i class="fa-solid fa-plus"></i>
                    Add Patient

                </a>

            </div>

            @if($patients->isEmpty())

                <div style="
                    text-align:center;
                    padding:48px;
                    color:#6b7280;
                ">

                    <i class="fa-solid fa-users"
                       style="
                            font-size:40px;
                            color:#ccfbf1;
                            margin-bottom:16px;
                            display:block;
                       ">
                    </i>

                    No patients registered yet.

                </div>

            @else

                <table style="
                    width:100%;
                    border-collapse:collapse;
                ">

                    <thead>

                        <tr style="
                            border-bottom:2px solid #f0fdfa;
                        ">

                            <th style="
                                text-align:left;
                                padding:12px 16px;
                                font-size:12px;
                                font-weight:700;
                                color:#6b7280;
                                text-transform:uppercase;
                                letter-spacing:1px;
                            ">
                                Patient
                            </th>

                            <th style="
                                text-align:left;
                                padding:12px 16px;
                                font-size:12px;
                                font-weight:700;
                                color:#6b7280;
                                text-transform:uppercase;
                                letter-spacing:1px;
                            ">
                                Email
                            </th>

                            <th style="
                                text-align:left;
                                padding:12px 16px;
                                font-size:12px;
                                font-weight:700;
                                color:#6b7280;
                                text-transform:uppercase;
                                letter-spacing:1px;
                            ">
                                Phone
                            </th>

                            <th style="
                                text-align:left;
                                padding:12px 16px;
                                font-size:12px;
                                font-weight:700;
                                color:#6b7280;
                                text-transform:uppercase;
                                letter-spacing:1px;
                            ">
                                Status
                            </th>

                            <th style="
                                text-align:left;
                                padding:12px 16px;
                                font-size:12px;
                                font-weight:700;
                                color:#6b7280;
                                text-transform:uppercase;
                                letter-spacing:1px;
                            ">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($patients as $patient)

                        <tr style="
                            border-bottom:1px solid #f0fdfa;
                        ">

                            <td style="padding:14px 16px;">

                                <div style="
                                    display:flex;
                                    align-items:center;
                                    gap:10px;
                                ">

                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($patient->user->name) }}&background=1e3a8a&color=fff&size=36&rounded=true"
                                         style="
                                            width:36px;
                                            height:36px;
                                            border-radius:50%;
                                         ">

                                    <span style="
                                        font-size:14px;
                                        font-weight:600;
                                        color:#0f172a;
                                    ">
                                        {{ $patient->user->name }}
                                    </span>

                                </div>

                            </td>

                            <td style="
                                padding:14px 16px;
                                font-size:14px;
                                color:#6b7280;
                            ">
                                {{ $patient->user->email }}
                            </td>

                            <td style="
                                padding:14px 16px;
                                font-size:14px;
                                color:#6b7280;
                            ">
                                {{ $patient->phone ?? 'N/A' }}
                            </td>

                            <td style="padding:14px 16px;">

                                <span style="
                                    padding:4px 12px;
                                    border-radius:50px;
                                    font-size:12px;
                                    font-weight:600;
                                    {{ ($patient->status ?? 'active') === 'active'
                                        ? 'background:#dcfce7; color:#16a34a;'
                                        : 'background:#fee2e2; color:#dc2626;' }}
                                ">

                                    {{ ucfirst($patient->status ?? 'active') }}

                                </span>

                            </td>

                            <td style="padding:14px 16px;">

                                <div style="
                                    display:flex;
                                    gap:8px;
                                    align-items:center;
                                ">

                                    <form method="POST"
                                          action="{{ route('admin.patient.toggle', $patient->id) }}"
                                          style="display:inline;">

                                        @csrf

                                        <button style="
                                            background:{{ ($patient->status ?? 'active') === 'active'
                                                ? '#fef3c7'
                                                : '#dcfce7' }};

                                            color:{{ ($patient->status ?? 'active') === 'active'
                                                ? '#b45309'
                                                : '#15803d' }};

                                            border:none;
                                            padding:8px 14px;
                                            border-radius:10px;
                                            font-size:12px;
                                            font-weight:700;
                                            cursor:pointer;
                                            transition:all 0.2s;
                                            box-shadow:0 2px 6px rgba(0,0,0,0.04);
                                        ">

                                            <i class="fa-solid {{ ($patient->status ?? 'active') === 'active'
                                                ? 'fa-pause'
                                                : 'fa-play' }}"
                                               style="margin-right:4px;">
                                            </i>

                                            {{ ($patient->status ?? 'active') === 'active'
                                                ? 'Deactivate'
                                                : 'Activate' }}

                                        </button>

                                    </form>

                                    <form method="POST"
                                          action="{{ route('admin.patient.delete', $patient->id) }}"
                                          style="display:inline;"
                                          onsubmit="return confirm('Delete this patient?')">

                                        @csrf
                                        @method('DELETE')

                                        <button style="
                                            background:#fef2f2;
                                            color:#b91c1c;
                                            border:none;
                                            padding:8px 14px;
                                            border-radius:10px;
                                            font-size:12px;
                                            font-weight:700;
                                            cursor:pointer;
                                            transition:all 0.2s;
                                            box-shadow:0 2px 6px rgba(0,0,0,0.04);
                                        ">

                                            <i class="fa-solid fa-trash"
                                               style="margin-right:4px;">
                                            </i>

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            @endif

        </div>

    </div>

    <footer style="
        background:#0f172a;
        padding:24px 2rem;
        margin-top:48px;
    ">

        <div style="
            max-width:1200px;
            margin:0 auto;
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:12px;
        ">

            <div style="
                display:flex;
                align-items:center;
                gap:8px;
            ">

                <svg width="28"
                     height="28"
                     viewBox="0 0 44 44"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">

                    <rect width="44"
                          height="44"
                          rx="10"
                          fill="#0d9488"/>

                    <path d="M22 34s-14-9-14-18a8 8 0 0 1 14-5.3A8 8 0 0 1 36 16c0 9-14 18-14 18z"
                          fill="white"/>

                    <polyline points="8,22 14,22 17,16 20,28 23,20 26,24 30,24 36,24"
                              stroke="#0f172a"
                              stroke-width="2"
                              fill="none"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                </svg>

                <span style="
                    font-size:16px;
                    font-weight:700;
                    color:white;
                ">
                    Medi<span style="color:#2dd4bf;">Slot</span>
                </span>

            </div>

            <p style="
                color:#475569;
                font-size:13px;
            ">
                © {{ date('Y') }} MediSlot. All rights reserved.
            </p>

            <p style="
                color:#475569;
                font-size:13px;
            ">
                Admin Portal
            </p>

        </div>

    </footer>

</x-app-layout>