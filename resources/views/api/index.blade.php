<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#0d9488;">
            API Explorer — Axios Demo
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Token Section --}}
            <div class="rounded-2xl p-6 mb-6" style="background:#0f172a; border:1px solid #1e293b;">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-bold text-white">🔑 Sanctum API Token</h3>
                        <p class="text-sm mt-1" style="color:#94a3b8;">Token is fetched dynamically and injected into Axios headers — never hardcoded.</p>
                    </div>
                    <button onclick="generateToken()" class="px-4 py-2 rounded-lg font-semibold text-sm text-white transition" style="background:#0d9488;">
                        Generate Token
                    </button>
                </div>
                <div class="rounded-lg p-3 font-mono text-xs break-all" style="background:#1e293b; color:#2dd4bf; min-height:40px;" id="tokenDisplay">
                    No token yet — click Generate Token
                </div>
            </div>

            {{-- Axios Code Example --}}
            <div class="rounded-2xl p-6 mb-6" style="background:#0f172a; border:1px solid #1e293b;">
                <h3 class="text-lg font-bold text-white mb-3">📋 How Axios Fetches Token Dynamically</h3>
                <pre class="rounded-lg p-4 text-xs overflow-x-auto" style="background:#1e293b; color:#e2e8f0; line-height:1.7;"><span style="color:#94a3b8;">// ✅ CORRECT — Token fetched dynamically from meta tag</span>
<span style="color:#2dd4bf;">const</span> token = document.querySelector(<span style="color:#fbbf24;">'meta[name="api-token"]'</span>).getAttribute(<span style="color:#fbbf24;">'content'</span>);

<span style="color:#2dd4bf;">const</span> api = axios.create({
    baseURL: <span style="color:#fbbf24;">'{{ config('app.url') }}/api'</span>,
    headers: {
        <span style="color:#fbbf24;">'Authorization'</span>: <span style="color:#fbbf24;">`Bearer ${token}`</span>,   <span style="color:#94a3b8;">// ← Dynamic!</span>
        <span style="color:#fbbf24;">'Content-Type'</span>: <span style="color:#fbbf24;">'application/json'</span>,
        <span style="color:#fbbf24;">'Accept'</span>: <span style="color:#fbbf24;">'application/json'</span>,
    }
});

<span style="color:#94a3b8;">// ❌ WRONG — Never hardcode token like this:</span>
<span style="color:#94a3b8;">// headers: { 'Authorization': 'Bearer 1|abc123xyz...' }</span>

<span style="color:#94a3b8;">// CORS: When client (domain A) calls API (domain B), browser blocks it</span>
<span style="color:#94a3b8;">// Laravel handles CORS via config/cors.php allowing specific origins</span></pre>
            </div>

            {{-- API Tester --}}
            <div class="rounded-2xl p-6 mb-6" style="background:#0f172a; border:1px solid #1e293b;">
                <h3 class="text-lg font-bold text-white mb-4">🧪 Live API Tester</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                    <button onclick="callApi('GET', '/api/user')" class="api-btn px-4 py-3 rounded-lg text-sm font-semibold text-white" style="background:#1e40af;">
                        GET /api/user
                    </button>
                    <button onclick="callApi('GET', '/api/appointments')" class="api-btn px-4 py-3 rounded-lg text-sm font-semibold text-white" style="background:#065f46;">
                        GET /api/appointments
                    </button>
                    <button onclick="callApi('GET', '/api/doctors')" class="api-btn px-4 py-3 rounded-lg text-sm font-semibold text-white" style="background:#7c2d12;">
                        GET /api/doctors
                    </button>
                </div>

                {{-- Request Headers Display --}}
                <div class="mb-3">
                    <p class="text-xs font-semibold mb-2" style="color:#94a3b8;">REQUEST HEADERS SENT:</p>
                    <pre class="rounded-lg p-3 text-xs" style="background:#1e293b; color:#a78bfa; min-height:60px;" id="headersDisplay">Click a button to see headers...</pre>
                </div>

                {{-- Response Display --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-xs font-semibold" style="color:#94a3b8;">RESPONSE:</p>
                        <span id="statusBadge" class="text-xs px-2 py-1 rounded font-mono" style="background:#1e293b; color:#94a3b8;">—</span>
                    </div>
                    <pre class="rounded-lg p-3 text-xs overflow-auto" style="background:#1e293b; color:#34d399; min-height:120px; max-height:300px;" id="responseDisplay">Response will appear here...</pre>
                </div>
            </div>

            {{-- CORS Explanation --}}
            <div class="rounded-2xl p-6" style="background:#0f172a; border:1px solid #1e293b;">
                <h3 class="text-lg font-bold text-white mb-3">🌐 CORS Explained</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="rounded-lg p-4" style="background:#1e293b;">
                        <p class="text-sm font-semibold mb-2" style="color:#f87171;">Without CORS</p>
                        <p class="text-xs" style="color:#94a3b8;">frontend.com → api.medislot.com<br>❌ Browser BLOCKS the request<br>Different origins = CORS error</p>
                    </div>
                    <div class="rounded-lg p-4" style="background:#1e293b;">
                        <p class="text-sm font-semibold mb-2" style="color:#34d399;">With CORS Configured</p>
                        <p class="text-xs" style="color:#94a3b8;">config/cors.php allows origins<br>✅ Browser ALLOWS the request<br>Server sends Access-Control headers</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Hidden meta tag with token --}}
    <meta name="api-token" id="apiTokenMeta" content="{{ $plainToken }}">

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let currentToken = null;

        function generateToken() {
        const token = document.getElementById('apiTokenMeta').getAttribute('content');
        if (token) {
            document.getElementById('tokenDisplay').textContent = token;
        } else {
            // Redirect to create token
            window.open('/user/api-tokens', '_blank');
            document.getElementById('tokenDisplay').textContent = 'Please create a token at Profile → API Tokens, then come back and refresh.';
        }
    }

            async function callApi(method, endpoint) {
                // Dynamically fetch token from meta tag — NEVER hardcoded
                const token = document.getElementById('apiTokenMeta').getAttribute('content');

                if (!token) {
                    document.getElementById('responseDisplay').textContent = '⚠️ No token found. Click "Generate Token" first!';
                    return;
                }

                const headers = {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                };

                // Show headers being sent
                document.getElementById('headersDisplay').textContent = JSON.stringify(headers, null, 2).replace(token, token.substring(0, 20) + '...[truncated]');

                try {
                    const response = await axios({
                        method,
                        url: '{{ url('') }}' + endpoint,
                        headers
                    });

                document.getElementById('statusBadge').textContent = '✅ ' + response.status + ' OK';
                document.getElementById('statusBadge').style.color = '#34d399';
                document.getElementById('responseDisplay').textContent = JSON.stringify(response.data, null, 2);
            } catch (error) {
                // Axios catch method — handles errors gracefully
                const status = error.response ? error.response.status : 'Network Error';
                const message = error.response ? JSON.stringify(error.response.data, null, 2) : error.message;

                document.getElementById('statusBadge').textContent = '❌ ' + status;
                document.getElementById('statusBadge').style.color = '#f87171';
                document.getElementById('responseDisplay').textContent = message;
                document.getElementById('responseDisplay').style.color = '#f87171';
            }
        }
    </script>
    @endpush
</x-app-layout>
