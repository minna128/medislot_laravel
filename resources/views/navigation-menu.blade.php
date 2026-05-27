<nav x-data="{ open: false }" style="background:#0f172a; border-bottom:1px solid rgba(255,255,255,0.08);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                    <a href="{{ url('/') }}" style="display:flex; align-items:center; gap:8px; text-decoration:none;flex-shrink:0;">
                        <svg width="32" height="32" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="44" height="44" rx="10" fill="#0d9488"/>
                            <path d="M22 34s-14-9-14-18a8 8 0 0 1 14-5.3A8 8 0 0 1 36 16c0 9-14 18-14 18z" fill="white"/>
                            <polyline points="8,22 14,22 17,16 20,28 23,20 26,24 30,24 36,24" stroke="#0f172a" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span style="font-size:18px; font-weight:700; color:white;">Medi<span style="color:#2dd4bf;">Slot</span></span>
                    </a>
                

                <div class="hidden sm:flex items-center space-x-8"
                    style="margin-left:48px;">
                    @if(auth()->user()->role === 'patient')
                        @php
                            $patientLinks = [
                                ['route' => 'patient.dashboard', 'label' => 'Dashboard'],
                                ['route' => 'patient.book', 'label' => 'Book Appointment'],
                                ['route' => 'patient.appointments', 'label' => 'My Appointments'],
                                ['route' => 'patient.doctors', 'label' => 'Doctors'],
                                ['route' => 'patient.clinics', 'label' => 'Clinics'],
                            ];
                        @endphp
                        @foreach($patientLinks as $link)
                            <a href="{{ route($link['route']) }}"
                               style="display:inline-flex; align-items:center; padding:0 4px; height:100%; text-decoration:none; font-size:14px; font-weight:500;
                                      border-bottom: 2px solid {{ request()->routeIs($link['route']) ? '#2dd4bf' : 'transparent' }};
                                      color: {{ request()->routeIs($link['route']) ? '#2dd4bf' : 'rgba(255,255,255,0.75)' }};">
                                {{ $link['label'] }}
                            </a>
                        @endforeach

                    @elseif(auth()->user()->role === 'doctor')
                        @php
                            $doctorLinks = [
                                ['route' => 'doctor.dashboard', 'label' => 'Dashboard'],
                                ['route' => 'doctor.appointments', 'label' => 'My Appointments'],
                                ['route' => 'doctor.profile', 'label' => 'My Profile'],
                            ];
                        @endphp
                        @foreach($doctorLinks as $link)
                            <a href="{{ route($link['route']) }}"
                               style="display:inline-flex; align-items:center; padding:0 4px; height:100%; text-decoration:none; font-size:14px; font-weight:500;
                                      border-bottom: 2px solid {{ request()->routeIs($link['route']) ? '#2dd4bf' : 'transparent' }};
                                      color: {{ request()->routeIs($link['route']) ? '#2dd4bf' : 'rgba(255,255,255,0.75)' }};">
                                {{ $link['label'] }}
                            </a>
                        @endforeach

                    @elseif(auth()->user()->role === 'admin')
                        @php
                            $adminLinks = [
                                ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
                                ['route' => 'admin.doctors', 'label' => 'Doctors'],
                                ['route' => 'admin.patients', 'label' => 'Patients'],
                                ['route' => 'admin.appointments', 'label' => 'Appointments'],
                                ['route' => 'admin.clinics', 'label' => 'Clinics'],
                            ];
                        @endphp
                        @foreach($adminLinks as $link)
                            <a href="{{ route($link['route']) }}"
                               style="display:inline-flex; align-items:center; padding:0 4px; height:100%; text-decoration:none; font-size:14px; font-weight:500;
                                      border-bottom: 2px solid {{ request()->routeIs($link['route']) ? '#2dd4bf' : 'transparent' }};
                                      color: {{ request()->routeIs($link['route']) ? '#2dd4bf' : 'rgba(255,255,255,0.75)' }};">
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex items-center">
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                        style="display:inline-flex; align-items:center; padding:8px 12px; border:1px solid rgba(255,255,255,0.15); border-radius:8px; font-size:14px; font-weight:500; color:white; background:rgba(255,255,255,0.08); cursor:pointer; gap:8px;">
                                    {{ Auth::user()->name }}
                                    <svg style="width:16px; height:16px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>
                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">{{ __('Manage Account') }}</div>
                            <x-dropdown-link href="{{ route('profile.show') }}">{{ __('Profile') }}</x-dropdown-link>
                            <div class="border-t border-gray-200"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        style="display:inline-flex; align-items:center; justify-content:center; padding:8px; border-radius:6px; color:rgba(255,255,255,0.7); background:transparent; border:none; cursor:pointer;">
                    <svg style="width:24px; height:24px;" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden"
         style="border-top:1px solid rgba(255,255,255,0.08);">
        <div class="pt-2 pb-3 space-y-1">
            @if(auth()->user()->role === 'patient')
                @foreach([
                    ['route' => 'patient.dashboard', 'label' => 'Dashboard'],
                    ['route' => 'patient.book', 'label' => 'Book Appointment'],
                    ['route' => 'patient.appointments', 'label' => 'My Appointments'],
                    ['route' => 'patient.doctors', 'label' => 'Doctors'],
                    ['route' => 'patient.clinics', 'label' => 'Clinics'],
                ] as $link)
                    <a href="{{ route($link['route']) }}"
                       style="display:block; padding:8px 16px; font-size:14px; font-weight:500; text-decoration:none;
                              color: {{ request()->routeIs($link['route']) ? '#2dd4bf' : 'rgba(255,255,255,0.8)' }};">
                        {{ $link['label'] }}
                    </a>
                @endforeach

            @elseif(auth()->user()->role === 'doctor')
                @foreach([
                    ['route' => 'doctor.dashboard', 'label' => 'Dashboard'],
                    ['route' => 'doctor.appointments', 'label' => 'My Appointments'],
                    ['route' => 'doctor.profile', 'label' => 'My Profile'],
                ] as $link)
                    <a href="{{ route($link['route']) }}"
                       style="display:block; padding:8px 16px; font-size:14px; font-weight:500; text-decoration:none;
                              color: {{ request()->routeIs($link['route']) ? '#2dd4bf' : 'rgba(255,255,255,0.8)' }};">
                        {{ $link['label'] }}
                    </a>
                @endforeach

            @elseif(auth()->user()->role === 'admin')
                @foreach([
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
                    ['route' => 'admin.doctors', 'label' => 'Doctors'],
                    ['route' => 'admin.patients', 'label' => 'Patients'],
                    ['route' => 'admin.appointments', 'label' => 'Appointments'],
                    ['route' => 'admin.clinics', 'label' => 'Clinics'],
                ] as $link)
                    <a href="{{ route($link['route']) }}"
                       style="display:block; padding:8px 16px; font-size:14px; font-weight:500; text-decoration:none;
                              color: {{ request()->routeIs($link['route']) ? '#2dd4bf' : 'rgba(255,255,255,0.8)' }};">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            @endif
        </div>

        <div style="padding:16px; border-top:1px solid rgba(255,255,255,0.08);">
            <div style="color:white; font-size:14px; font-weight:600; margin-bottom:4px;">{{ Auth::user()->name }}</div>
            <div style="color:rgba(255,255,255,0.5); font-size:13px; margin-bottom:12px;">{{ Auth::user()->email }}</div>
            <a href="{{ route('profile.show') }}" style="display:block; padding:8px 0; font-size:14px; color:rgba(255,255,255,0.7); text-decoration:none;">Profile</a>
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                   style="display:block; padding:8px 0; font-size:14px; color:#f87171; text-decoration:none;">
                    Log Out
                </a>
            </form>
        </div>
    </div>
</nav>