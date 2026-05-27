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
                    Reset Your<br>Password
                </h2>
                <p style="font-size:14px; color:rgba(255,255,255,0.6); line-height:1.8; margin-bottom:36px;">
                    Don't worry — it happens to everyone. Enter your email and we'll send you a reset link right away.
                </p>
                <div style="display:flex; flex-direction:column; gap:12px;">
                    @foreach([
                        ['icon'=>'fa-envelope', 'text'=>'Check your email inbox'],
                        ['icon'=>'fa-link', 'text'=>'Click the reset link'],
                        ['icon'=>'fa-lock', 'text'=>'Set a new password'],
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
                <div style="width:60px; height:60px; background:#f0fdfa; border:2px solid #ccfbf1; border-radius:14px; display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                    <i class="fa-solid fa-lock" style="color:#0d9488; font-size:24px;"></i>
                </div>
                <h2 style="font-size:26px; font-weight:800; color:#0f172a; margin-bottom:6px;">Forgot Password?</h2>
                <p style="font-size:14px; color:#6b7280; margin-bottom:32px; line-height:1.6;">
                    Enter your email address and we'll send you a link to reset your password.
                </p>

                @if (session('status'))
                    <div style="background:#dcfce7; color:#16a34a; padding:12px 16px; border-radius:8px; margin-bottom:20px; font-size:14px; display:flex; align-items:center; gap:8px;">
                        <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div style="margin-bottom:24px;">
                        <label style="display:block; font-size:11px; font-weight:700; color:#374151; letter-spacing:0.5px; text-transform:uppercase; margin-bottom:6px;">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#0f172a; outline:none; font-family:inherit; box-sizing:border-box;">
                        @error('email') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit"
                            style="width:100%; padding:12px; background:linear-gradient(135deg,#1e3a8a,#0d9488); color:white; border:none; border-radius:10px; font-size:15px; font-weight:700; cursor:pointer;">
                        Send Reset Link →
                    </button>

                    <p style="text-align:center; margin-top:20px; font-size:13px; color:#6b7280;">
                        Remember your password?
                        <a href="{{ route('login') }}" style="color:#0d9488; font-weight:600; text-decoration:none;">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>