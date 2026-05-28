<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/logo.svg">
    <link rel="shortcut icon" href="/logo.svg">
    <title>MediSlot — Online Doctor Appointment System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #f0fdfa; }
        .btn-main { background: #1e3a8a; color: white; }
        .btn-main:hover { background: #1e40af; }
        .btn-teal { background: #0d9488; color: white; }
        .btn-teal:hover { background: #0f766e; }
        .card-hover { transition: transform 0.2s, box-shadow 0.2s; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,0.12); }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav style="position:absolute; top:0; left:0; right:0; z-index:50; padding:0 2rem;">
    <div style="max-width:1200px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; height:72px;">
        <div style="display:flex; align-items:center; gap:10px;">
            <svg width="32" height="32" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="44" height="44" rx="10" fill="#0d9488"/><path d="M22 34s-14-9-14-18a8 8 0 0 1 14-5.3A8 8 0 0 1 36 16c0 9-14 18-14 18z" fill="white"/><polyline points="8,22 14,22 17,16 20,28 23,20 26,24 30,24 36,24" stroke="#0f172a" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span style="font-size:20px; font-weight:700; color:white;">Medi<span style="color:#2dd4bf;">Slot</span></span>
        </div>
        <div style="display:flex; align-items:center; gap:2.5rem;">
            <a href="#" style="color:rgba(255,255,255,0.85); text-decoration:none; font-size:14px; font-weight:500;">Home</a>
            <a href="#services" style="color:rgba(255,255,255,0.85); text-decoration:none; font-size:14px; font-weight:500;">Treatments</a>
            <a href="#doctors" style="color:rgba(255,255,255,0.85); text-decoration:none; font-size:14px; font-weight:500;">Team</a>
            <a href="#how" style="color:rgba(255,255,255,0.85); text-decoration:none; font-size:14px; font-weight:500;">Pages</a>
            <a href="#" style="color:rgba(255,255,255,0.85); text-decoration:none; font-size:14px; font-weight:500;">Contact</a>
        </div>
        <div style="display:flex; gap:12px; align-items:center;">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-main" style="padding:10px 22px; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none; display:inline-block;">Dashboard</a>
            @else
                <a href="{{ route('login') }}" style="color:rgba(255,255,255,0.85); text-decoration:none; font-size:14px; font-weight:500;">Log In</a>
                <a href="{{ route('register') }}" class="btn-main" style="padding:10px 22px; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none; display:inline-block;">Book Now</a>
            @endauth
        </div>
    </div>
</nav>

{{-- Hero --}}
<section style="position:relative; min-height:100vh; display:flex; align-items:center;">
    <div style="position:absolute; inset:0; z-index:0;">
        <img src="https://images.unsplash.com/photo-1504439468489-c8920d796a29?w=1800&q=90"
             alt="Medical"
             style="width:100%; height:100%; object-fit:cover; object-position:center;">
        <div style="position:absolute; inset:0; background:linear-gradient(to right, rgba(5,10,30,0.93) 40%, rgba(5,10,30,0.65) 100%);"></div>
    </div>

    <div style="position:relative; z-index:10; max-width:1200px; margin:0 auto; padding:120px 2rem 80px; width:100%;">
        <div style="max-width:580px;">
            <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(45,212,191,0.15); border:1px solid rgba(45,212,191,0.3); padding:8px 18px; border-radius:50px; margin-bottom:28px;">
                <span style="width:7px; height:7px; border-radius:50%; background:#2dd4bf; display:inline-block;"></span>
                <span style="color:#99f6e4; font-size:13px; font-weight:500;">Trusted by 1,000+ Patients</span>
            </div>
            <h1 style="font-size:56px; font-weight:800; color:white; line-height:1.1; margin-bottom:24px;">
                Better Doctors.<br>
                <span style="color:#1d4ed8;">Better Care.</span>
            </h1>
            <p style="color:rgba(255,255,255,0.7); font-size:17px; line-height:1.8; margin-bottom:36px; max-width:460px;">
                Changing the way you receive healthcare. Book appointments with certified specialists online — fast, easy, and secure.
            </p>
            <div style="display:flex; gap:14px; margin-bottom:48px;">
                <a href="{{ route('register') }}" class="btn-main"
                   style="padding:14px 32px; border-radius:10px; font-size:15px; font-weight:700; text-decoration:none; display:inline-block;">
                    Discover More
                </a>
                <a href="{{ route('login') }}"
                   style="padding:14px 32px; border-radius:10px; font-size:15px; font-weight:600; text-decoration:none; display:inline-block; border:2px solid rgba(255,255,255,0.3); color:white;">
                    Log In
                </a>
            </div>

            <div style="display:flex; gap:24px;">
                @foreach([
                    ['icon'=>'fa-user-doctor','title'=>'Qualified Team','desc'=>'Board certified specialists'],
                    ['icon'=>'fa-star','title'=>'Quality Service','desc'=>'Rated 4.9 by patients'],
                    ['icon'=>'fa-hospital','title'=>'Modern Clinic','desc'=>'Advanced facilities'],
                ] as $f)
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; background:rgba(45,212,191,0.15); border:1px solid rgba(45,212,191,0.3); border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <i class="fa-solid {{ $f['icon'] }}" style="color:#2dd4bf; font-size:18px;"></i>
                    </div>
                    <div>
                        <div style="color:white; font-size:13px; font-weight:600;">{{ $f['title'] }}</div>
                        <div style="color:rgba(255,255,255,0.5); font-size:12px;">{{ $f['desc'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Floating Appointment Form --}}
<div style="max-width:1100px; margin:-36px auto 0; padding:0 2rem; position:relative; z-index:20;">
    <div style="background:white; border-radius:16px; padding:28px 32px; box-shadow:0 20px 60px rgba(0,0,0,0.15); border-top:3px solid #0d9488;">
        <p style="font-size:13px; font-weight:600; color:#0d9488; text-transform:uppercase; letter-spacing:2px; margin-bottom:16px;">Quick Appointment</p>
        <div style="display:grid; grid-template-columns:1fr 1fr 1fr 1fr auto; gap:16px; align-items:flex-end;">
            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Your Name</label>
                <input type="text" placeholder="Full name"
                       style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#111827; outline:none; font-family:Inter,sans-serif;">
            </div>
            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Phone Number</label>
                <input type="tel" placeholder="+1 (555) 000-0000"
                       style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#111827; outline:none; font-family:Inter,sans-serif;">
            </div>
            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Department</label>
                <select style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#111827; outline:none; font-family:Inter,sans-serif; background:white;">
                    <option>Select Department</option>
                    <option>Cardiology</option>
                    <option>Neurology</option>
                    <option>General Practice</option>
                    <option>Orthopedics</option>
                    <option>Dentistry</option>
                </select>
            </div>
            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:8px;">Preferred Date</label>
                <input type="date"
                       style="width:100%; padding:11px 14px; border:1.5px solid #e5e7eb; border-radius:8px; font-size:14px; color:#111827; outline:none; font-family:Inter,sans-serif;">
            </div>
            <div>
                <a href="{{ route('register') }}" class="btn-teal"
                   style="display:block; padding:12px 24px; border-radius:8px; font-size:14px; font-weight:700; text-decoration:none; text-align:center; white-space:nowrap;">
                    Book Now
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Stats Bar --}}
<section style="background:white; padding:48px 2rem; border-bottom:1px solid #ccfbf1;">
    <div style="max-width:1200px; margin:0 auto; display:grid; grid-template-columns:repeat(4,1fr); gap:32px; text-align:center;">
        @foreach([
            ['num'=>'50+','label'=>'Expert Doctors'],
            ['num'=>'1K+','label'=>'Happy Patients'],
            ['num'=>'15+','label'=>'Departments'],
            ['num'=>'98%','label'=>'Satisfaction Rate'],
        ] as $stat)
        <div>
            <div style="font-size:36px; font-weight:800; color:#0d9488;">{{ $stat['num'] }}</div>
            <div style="font-size:14px; color:#6b7280; margin-top:4px;">{{ $stat['label'] }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- Services --}}
<section id="services" style="padding:80px 2rem; background:#f8fafc;">
    <div style="max-width:1200px; margin:0 auto;">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:64px; align-items:center; margin-bottom:60px;">
            <div>
                <p style="color:#0d9488; font-size:13px; font-weight:600; text-transform:uppercase; letter-spacing:2px; margin-bottom:12px;">Our Departments</p>
                <h2 style="font-size:36px; font-weight:800; color:#0f172a; line-height:1.2; margin-bottom:16px;">Changing the way you receive healthcare.</h2>
                <p style="color:#64748b; line-height:1.8;">We offer a full range of specialized medical services to ensure you get the best care possible from our certified team of professionals.</p>
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                @foreach([
                    ['img'=>'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=300&q=80','title'=>'Cardiology'],
                    ['img'=>'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?w=300&q=80','title'=>'Neurology'],
                    ['img'=>'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=300&q=80','title'=>'General Care'],
                    ['img'=>'https://images.unsplash.com/photo-1582560475093-ba66accbc424?w=300&q=80','title'=>'Orthopedics'],
                ] as $dept)
                <div class="card-hover" style="border-radius:12px; overflow:hidden; position:relative; height:130px;">
                    <img src="{{ $dept['img'] }}" alt="{{ $dept['title'] }}" style="width:100%; height:100%; object-fit:cover;">
                    <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(10,20,60,0.75), transparent);"></div>
                    <div style="position:absolute; bottom:12px; left:14px; color:white; font-size:13px; font-weight:600;">{{ $dept['title'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:24px;">
            @foreach([
                ['icon'=>'fa-heart-pulse','title'=>'Cardiology','desc'=>'Expert heart care from certified cardiologists.'],
                ['icon'=>'fa-brain','title'=>'Neurology','desc'=>'Advanced neurological diagnosis and treatment.'],
                ['icon'=>'fa-bone','title'=>'Orthopedics','desc'=>'Bone, joint, and muscle care and rehabilitation.'],
                ['icon'=>'fa-eye','title'=>'Ophthalmology','desc'=>'Complete eye care from checkups to surgery.'],
                ['icon'=>'fa-tooth','title'=>'Dentistry','desc'=>'Full dental care and cosmetic treatments.'],
                ['icon'=>'fa-stethoscope','title'=>'General Practice','desc'=>'Primary healthcare for all ages.'],
            ] as $s)
            <div class="card-hover" style="background:white; border-radius:14px; padding:24px; border:1px solid #ccfbf1; display:flex; align-items:flex-start; gap:16px;">
                <div style="width:48px; height:48px; background:#f0fdfa; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="fa-solid {{ $s['icon'] }}" style="color:#0d9488; font-size:20px;"></i>
                </div>
                <div>
                    <h3 style="font-size:16px; font-weight:700; color:#0f172a; margin-bottom:6px;">{{ $s['title'] }}</h3>
                    <p style="color:#64748b; font-size:13px; line-height:1.6;">{{ $s['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Doctors --}}
<section id="doctors" style="padding:80px 2rem; background:white;">
    <div style="max-width:1200px; margin:0 auto;">
        <div style="text-align:center; margin-bottom:48px;">
            <p style="color:#0d9488; font-size:13px; font-weight:600; text-transform:uppercase; letter-spacing:2px; margin-bottom:8px;">Our Team</p>
            <h2 style="font-size:34px; font-weight:800; color:#0f172a;">Meet Our Doctors</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:24px;">
            @foreach([
                ['name'=>'Dr. Sarah Lee','spec'=>'Cardiologist','img'=>'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&q=80'],
                ['name'=>'Dr. James Wong','spec'=>'General Practitioner','img'=>'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&q=80'],
                ['name'=>'Dr. Emily Chen','spec'=>'Neurologist','img'=>'https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&q=80'],
            ] as $d)
            <div class="card-hover" style="background:white; border-radius:16px; overflow:hidden; border:1px solid #ccfbf1; box-shadow:0 4px 16px rgba(13,148,136,0.1);">
                <img src="{{ $d['img'] }}" alt="{{ $d['name'] }}" style="width:100%; height:260px; object-fit:cover; object-position:top;">
                <div style="padding:20px;">
                    <h3 style="font-size:17px; font-weight:700; color:#0f172a; margin-bottom:4px;">{{ $d['name'] }}</h3>
                    <p style="color:#0d9488; font-size:13px; font-weight:500; margin-bottom:16px;">{{ $d['spec'] }}</p>
                    <a href="{{ route('register') }}" class="btn-main" style="display:block; text-align:center; padding:10px; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none;">
                        Book Appointment
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- How It Works --}}
<section id="how" style="padding:80px 2rem; background:#f0fdfa;">
    <div style="max-width:900px; margin:0 auto; text-align:center;">
        <p style="color:#0d9488; font-size:13px; font-weight:600; text-transform:uppercase; letter-spacing:2px; margin-bottom:8px;">Simple Process</p>
        <h2 style="font-size:34px; font-weight:800; color:#0f172a; margin-bottom:48px;">How It Works</h2>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:32px;">
            @foreach([
                ['num'=>'01','icon'=>'fa-user-plus','title'=>'Register','desc'=>'Create your free account.'],
                ['num'=>'02','icon'=>'fa-magnifying-glass','title'=>'Find Doctor','desc'=>'Browse specialists.'],
                ['num'=>'03','icon'=>'fa-calendar-check','title'=>'Book Slot','desc'=>'Pick date and time.'],
                ['num'=>'04','icon'=>'fa-circle-check','title'=>'Confirmed','desc'=>'Visit your doctor.'],
            ] as $step)
            <div>
                <div style="width:64px; height:64px; border-radius:16px; background:linear-gradient(135deg,#1e3a8a,#0d9488); display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                    <i class="fa-solid {{ $step['icon'] }}" style="color:white; font-size:24px;"></i>
                </div>
                <div style="font-size:12px; font-weight:700; color:#0d9488; margin-bottom:6px;">STEP {{ $step['num'] }}</div>
                <h3 style="font-size:16px; font-weight:700; color:#0f172a; margin-bottom:8px;">{{ $step['title'] }}</h3>
                <p style="color:#64748b; font-size:13px; line-height:1.6;">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section style="position:relative; padding:80px 2rem; text-align:center; overflow:hidden;">
    <div style="position:absolute; inset:0; z-index:0;">
        <img src="https://images.unsplash.com/photo-1538108149393-fbbd81895907?w=1800&q=90"
             alt="Hospital"
             style="width:100%; height:100%; object-fit:cover;">
        <div style="position:absolute; inset:0; background:rgba(10,20,60,0.88);"></div>
    </div>
    <div style="position:relative; z-index:10; max-width:600px; margin:0 auto;">
        <h2 style="font-size:36px; font-weight:800; color:white; margin-bottom:16px;">Ready to Book Your Appointment?</h2>
        <p style="color:rgba(255,255,255,0.75); margin-bottom:32px; line-height:1.7;">Join thousands of patients who trust MediSlot for their healthcare needs.</p>
        <a href="{{ route('register') }}"
           style="display:inline-block; padding:16px 40px; background:#0d9488; color:white; border-radius:12px; font-size:16px; font-weight:700; text-decoration:none; box-shadow:0 10px 30px rgba(13,148,136,0.4);">
            Get Started Free →
        </a>
    </div>
</section>

{{-- Footer --}}
<footer style="background:#0f172a; padding:40px 2rem;">
    <div style="max-width:1200px; margin:0 auto; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
        <div style="display:flex; align-items:center; gap:8px;">
            <svg width="32" height="32" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="44" height="44" rx="10" fill="#0d9488"/><path d="M22 34s-14-9-14-18a8 8 0 0 1 14-5.3A8 8 0 0 1 36 16c0 9-14 18-14 18z" fill="white"/><polyline points="8,22 14,22 17,16 20,28 23,20 26,24 30,24 36,24" stroke="#0f172a" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span style="font-size:18px; font-weight:700; color:white;">Medi<span style="color:#2dd4bf;">Slot</span></span>
        </div>
        <p style="color:#475569; font-size:13px;">© {{ date('Y') }} MediSlot. All rights reserved.</p>
        <div style="display:flex; gap:24px;">
            <a href="#" style="color:#475569; font-size:13px; text-decoration:none;">Privacy Policy</a>
            <a href="#" style="color:#475569; font-size:13px; text-decoration:none;">Terms of Service</a>
            <a href="#" style="color:#475569; font-size:13px; text-decoration:none;">Contact</a>
        </div>
    </div>
</footer>

</body>
</html>