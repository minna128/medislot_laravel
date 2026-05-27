<x-guest-layout>
    <div style="min-height:100vh; display:grid; grid-template-columns:2fr 3fr;">

        {{-- Left Panel --}}
        <div style="background:#0f172a; padding:48px; display:flex; flex-direction:column; justify-content:center; position:relative; overflow:hidden;">
            <div style="position:absolute; top:-80px; right:-80px; width:300px; height:300px; border-radius:50%; background:rgba(13,148,136,0.12);"></div>
            <div style="position:absolute; bottom:-60px; left:-60px; width:200px; height:200px; border-radius:50%; background:rgba(30,58,138,0.15);"></div>

            <div style="position:relative; z-index:1;">
                <div style="font-size:24px; font-weight:800; color:white; margin-bottom:32px;">
                    <svg width="36" height="36" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="44" height="44" rx="10" fill="#0d9488"/><path d="M22 34s-14-9-14-18a8 8 0 0 1 14-5.3A8 8 0 0 1 36 16c0 9-14 18-14 18z" fill="white"/><polyline points="8,22 14,22 17,16 20,28 23,20 26,24 30,24 36,24" stroke="#0f172a" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg> <span style="font-size:24px; font-weight:800; color:white;">Medi<span style="color:#2dd4bf;">Slot</span></span>
                </div>
                <h2 style="font-size:32px; font-weight:800; color:white; line-height:1.2; margin-bottom:12px;">
                    Your Health,<br>Our Priority
                </h2>
                <p style="font-size:14px; color:rgba(255,255,255,0.6); line-height:1.8; margin-bottom:36px;">
                    Book appointments with certified doctors online. Fast, secure, and hassle-free.
                </p>
                <div style="display:flex; flex-direction:column; gap:12px;">
                    @foreach([
                        ['icon'=>'fa-stethoscope', 'text'=>'Certified specialist doctors'],
                        ['icon'=>'fa-calendar-check', 'text'=>'Instant online booking'],
                        ['icon'=>'fa-shield-halved', 'text'=>'Secure and private'],
                    ] as $f)
                    <div style="display:flex; align-items:center; gap:12px; padding:12px 16px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.08); border-radius:10px;">
                        <div style="width:34px; height:34px; background:rgba(13,148,136,0.2); border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="fa-solid {{ $f['icon'] }}" style="color:#2dd4bf; font-size:15px;"></i>
                        </div>
                        <span style="font-size:13px; color:rgba(255,255,255,0.8); font-weight:500;">{{ $f['text'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right Panel --}}
        <div style="background:white; padding:48px; display:flex; flex-direction:column; justify-content:center; align-items:center;">
            <div style="width:100%; max-width:400px;">
                <h2 style="font-size:26px; font-weight:800; color:#0f172a; margin-bottom:6px;">Welcome back</h2>
                <p style="font-size:14px; color:#6b7280; margin-bottom:32px;">Sign in to your MediSlot account</p>

                @if (session('status'))
                    <div style="background:#dcfce7; color:#16a34a; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:14px;">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div style="margin-bottom:16px;">
                        <label style="display:block; font-size:11px; font-weight:700; color:#374151; letter-spacing:0.5px; text-transform:uppercase; margin-bottom:6px;">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit; box-sizing:border-box;">
                        @error('email') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom:16px;">
                        <label style="display:block; font-size:11px; font-weight:700; color:#374151; letter-spacing:0.5px; text-transform:uppercase; margin-bottom:6px;">Password</label>
                        <input type="password" name="password" required
                               style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit; box-sizing:border-box;">
                        @error('password') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
                        <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                            <input type="checkbox" name="remember" style="width:15px; height:15px; accent-color:#0d9488;">
                            <span style="font-size:13px; color:#6b7280;">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size:13px; color:#0d9488; font-weight:600; text-decoration:none;">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                            style="width:100%; padding:12px; background:linear-gradient(135deg,#1e3a8a,#0d9488); color:white; border:none; border-radius:10px; font-size:15px; font-weight:700; cursor:pointer;">
                        Sign In →
                    </button>

                    @if (Route::has('register'))
                        <p style="text-align:center; margin-top:20px; font-size:13px; color:#6b7280;">
                            Don't have an account?
                            <a href="{{ route('register') }}" style="color:#0d9488; font-weight:600; text-decoration:none;">Create one free</a>
                        </p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>