<x-guest-layout>

    <div style="
        min-height:100vh;
        display:flex;
        align-items:center;
        justify-content:center;
        background:linear-gradient(135deg,#0f172a 0%,#0d9488 100%);
        padding:24px;
    ">

        <div style="
            width:100%;
            max-width:420px;
            background:white;
            border-radius:24px;
            padding:40px;
            box-shadow:0 20px 40px rgba(0,0,0,0.15);
        ">

            {{-- Logo --}}
            <div style="
                display:flex;
                flex-direction:column;
                align-items:center;
                margin-bottom:32px;
            ">

                <div style="
                    width:72px;
                    height:72px;
                    border-radius:20px;
                    background:linear-gradient(135deg,#14b8a6,#0d9488);
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    margin-bottom:16px;
                    box-shadow:0 10px 20px rgba(13,148,136,0.25);
                ">

                    <svg width="38" height="38" viewBox="0 0 44 44"
                         fill="none"
                         xmlns="http://www.w3.org/2000/svg">

                        <rect width="44"
                              height="44"
                              rx="10"
                              fill="#14b8a6"/>

                        <path d="M22 34s-14-9-14-18a8 8 0 0 1 14-5.3A8 8 0 0 1 36 16c0 9-14 18-14 18z"
                              fill="white"/>

                        <polyline points="8,22 14,22 17,16 20,28 23,20 26,24 30,24 36,24"
                                  stroke="#0f172a"
                                  stroke-width="2"
                                  fill="none"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"/>
                    </svg>

                </div>

                <h1 style="
                    font-size:30px;
                    font-weight:800;
                    color:#0f172a;
                    margin-bottom:6px;
                ">
                    Medi<span style="color:#0d9488;">Slot</span>
                </h1>

                <p style="
                    color:#64748b;
                    font-size:14px;
                    text-align:center;
                    line-height:1.6;
                ">
                    Secure account verification required.
                    Please enter your authentication code.
                </p>

            </div>

            {{-- Validation Errors --}}
            <x-validation-errors style="margin-bottom:16px;" />

            <form method="POST" action="{{ route('two-factor.login') }}">

                @csrf

                <div>

    {{-- Authentication Code --}}
    <div id="auth-code-section">

        <label style="
            display:block;
            font-size:13px;
            font-weight:700;
            color:#334155;
            margin-bottom:8px;
        ">
            Authentication Code
        </label>

        <input id="code"
               type="text"
               name="code"
               autocomplete="one-time-code"
               autofocus
               style="
                    width:100%;
                    padding:14px 16px;
                    border:1.5px solid #cbd5e1;
                    border-radius:12px;
                    font-size:15px;
                    outline:none;
                    margin-bottom:22px;
               ">

    </div>

    {{-- Recovery Code --}}
    <div id="recovery-code-section" style="display:none;">

        <label style="
            display:block;
            font-size:13px;
            font-weight:700;
            color:#334155;
            margin-bottom:8px;
        ">
            Recovery Code
        </label>

        <input id="recovery_code"
               type="text"
               name="recovery_code"
               autocomplete="one-time-code"
               style="
                    width:100%;
                    padding:14px 16px;
                    border:1.5px solid #cbd5e1;
                    border-radius:12px;
                    font-size:15px;
                    outline:none;
                    margin-bottom:22px;
               ">

    </div>

    {{-- Buttons --}}
    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:16px;
    ">

        <button type="button"
                id="toggleRecovery"
                onclick="toggleRecoveryCode()"
                style="
                    background:none;
                    border:none;
                    color:#0d9488;
                    font-size:14px;
                    font-weight:600;
                    cursor:pointer;
                ">

            Use recovery code

        </button>

        <button type="submit"
                style="
                    background:linear-gradient(135deg,#0f172a,#0d9488);
                    color:white;
                    border:none;
                    padding:12px 24px;
                    border-radius:12px;
                    font-size:14px;
                    font-weight:700;
                    cursor:pointer;
                    transition:all 0.2s;
                ">

            Verify & Login

        </button>

    </div>

</div>

<script>
function toggleRecoveryCode() {

    const authSection =
        document.getElementById('auth-code-section');

    const recoverySection =
        document.getElementById('recovery-code-section');

    const toggleBtn =
        document.getElementById('toggleRecovery');

    if (recoverySection.style.display === 'none') {

        recoverySection.style.display = 'block';
        authSection.style.display = 'none';

        toggleBtn.innerText =
            'Use authentication code';

    } else {

        recoverySection.style.display = 'none';
        authSection.style.display = 'block';

        toggleBtn.innerText =
            'Use recovery code';
    }
}
</script>

            </form>

        </div>

    </div>

</x-guest-layout>