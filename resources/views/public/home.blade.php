<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Strong Base Academy — Home Tuition Academy</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,900&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root{
    --ink:#0B2B26; --ink-2:#123C34; --paper:#F7F5F0; --paper-2:#FFFFFF;
    --gold:#E3A857; --gold-deep:#C4883A; --line:#E1DDD1; --muted:#5B6B65;
}
*{box-sizing:border-box; margin:0; padding:0;}
html{scroll-behavior:smooth;}
body{ font-family:'Inter',sans-serif; color:var(--ink); background:var(--paper); overflow-x:hidden; }
h1,h2,h3,.display{ font-family:'Fraunces',serif; }
.mono{ font-family:'IBM Plex Mono',monospace; letter-spacing:.04em; }
a{ color:inherit; }
.container{ max-width:1180px; margin:0 auto; padding:0 24px; }

/* ---------- Reveal Animation ---------- */
.reveal{ opacity:0; transform:translateY(28px); transition:opacity .7s ease, transform .7s ease; }
.reveal.in{ opacity:1; transform:translateY(0); }
.reveal-stagger > * { opacity:0; transform:translateY(24px); transition:opacity .6s ease, transform .6s ease; }
.reveal-stagger.in > *{ opacity:1; transform:translateY(0); }
.reveal-stagger.in > *:nth-child(1){ transition-delay:.05s; }
.reveal-stagger.in > *:nth-child(2){ transition-delay:.15s; }
.reveal-stagger.in > *:nth-child(3){ transition-delay:.25s; }
.reveal-stagger.in > *:nth-child(4){ transition-delay:.35s; }

/* ---------- Header ---------- */
header.site-header{
    position:fixed; top:0; left:0; width:100%; z-index:100;
    padding:20px 0; transition:all .35s ease;
}
header.site-header.scrolled{
    background:rgba(247,245,240,0.85); backdrop-filter:blur(12px);
    box-shadow:0 1px 0 var(--line); padding:14px 0;
}
.nav-wrap{ display:flex; align-items:center; justify-content:space-between; }
.logo{ font-family:'Fraunces',serif; font-weight:700; font-size:1.3rem; color:var(--ink); text-decoration:none; }
.logo em{ font-style:normal; color:var(--gold-deep); }
.nav-links{ display:flex; align-items:center; gap:32px; list-style:none; }
.nav-links a{ text-decoration:none; color:var(--ink); font-weight:500; font-size:.92rem; position:relative; }
.nav-links a:not(.btn-pill)::after{ content:''; position:absolute; left:0; bottom:-4px; width:0; height:2px; background:var(--gold); transition:width .3s ease; }
.nav-links a:not(.btn-pill):hover::after{ width:100%; }
.btn-pill{ background:var(--ink); color:#fff!important; padding:10px 22px; border-radius:30px; font-weight:600; font-size:.85rem; transition:transform .25s ease, background .25s ease; display:inline-block; }
.btn-pill:hover{ background:var(--gold-deep); transform:translateY(-2px); }
.hamburger{ display:none; flex-direction:column; gap:5px; cursor:pointer; background:none; border:none; }
.hamburger span{ width:24px; height:2px; background:var(--ink); display:block; }

/* ---------- Hero ---------- */
.hero{ position:relative; padding:180px 0 100px; overflow:hidden; }
.hero::before{
    content:''; position:absolute; top:-200px; right:-200px; width:600px; height:600px;
    background:radial-gradient(circle, rgba(227,168,87,.25), transparent 70%); border-radius:50%;
    animation:float 8s ease-in-out infinite;
}
@keyframes float{ 0%,100%{ transform:translateY(0);} 50%{ transform:translateY(30px);} }
.hero-grid{ display:grid; grid-template-columns:1.1fr .9fr; gap:60px; align-items:center; position:relative; z-index:2; }
.eyebrow{ display:inline-flex; align-items:center; gap:8px; font-family:'IBM Plex Mono',monospace; font-size:.78rem; letter-spacing:.1em; text-transform:uppercase; color:var(--gold-deep); background:rgba(227,168,87,.12); padding:6px 14px; border-radius:20px; margin-bottom:24px; }
.eyebrow .dot{ width:6px; height:6px; border-radius:50%; background:var(--gold-deep); animation:pulse 1.6s infinite; }
@keyframes pulse{ 0%,100%{opacity:1;} 50%{opacity:.3;} }
.hero h1{ font-size:3.6rem; font-weight:700; line-height:1.1; letter-spacing:-.01em; }
.hero h1 .accent{ color:var(--gold-deep); font-style:italic; font-weight:600; }
.hero p.lead{ font-size:1.15rem; color:var(--muted); margin-top:22px; max-width:480px; line-height:1.7; }
.hero-ctas{ display:flex; gap:16px; margin-top:36px; flex-wrap:wrap; }
.btn-primary{ background:var(--ink); color:#fff; padding:15px 30px; border-radius:8px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:10px; transition:all .3s ease; box-shadow:0 8px 24px rgba(11,43,38,.18); }
.btn-primary:hover{ background:var(--gold-deep); transform:translateY(-3px); box-shadow:0 12px 28px rgba(196,136,58,.3); }
.btn-secondary{ border:1.5px solid var(--ink); color:var(--ink); padding:15px 30px; border-radius:8px; font-weight:600; text-decoration:none; transition:all .3s ease; }
.btn-secondary:hover{ background:var(--ink); color:#fff; }

.hero-card{ background:var(--paper-2); border-radius:20px; padding:34px; box-shadow:0 20px 60px rgba(11,43,38,.12); position:relative; }
.hero-card h4{ font-size:.85rem; text-transform:uppercase; letter-spacing:.08em; color:var(--gold-deep); font-family:'IBM Plex Mono',monospace; margin-bottom:20px; }
.check-item{ display:flex; align-items:flex-start; gap:12px; margin-bottom:16px; font-size:.95rem; }
.check-item:last-child{ margin-bottom:0; }
.check-item i{ color:var(--gold-deep); margin-top:3px; }

/* ---------- Stats ---------- */
.stats-strip{ border-top:1px solid var(--line); border-bottom:1px solid var(--line); padding:44px 0; margin-top:20px; }
.stats-grid{ display:grid; grid-template-columns:repeat(3,1fr); text-align:center; }
.stat-num{ font-family:'IBM Plex Mono',monospace; font-size:2.4rem; font-weight:600; color:var(--ink); }
.stat-label{ color:var(--muted); font-size:.82rem; text-transform:uppercase; letter-spacing:.08em; margin-top:6px; }

/* ---------- Section heading ---------- */
.section{ padding:110px 0; }
.section-head{ text-align:center; max-width:600px; margin:0 auto 60px; }
.section-head .eyebrow{ margin-bottom:16px; }
.section-head h2{ font-size:2.3rem; font-weight:700; }

/* ---------- Level Path (signature element) ---------- */
.level-path{ display:flex; align-items:stretch; gap:0; position:relative; margin-top:20px; }
.level-path::before{ content:''; position:absolute; top:34px; left:5%; right:5%; height:2px; background:var(--line); }
.level-path .level-line-fill{ position:absolute; top:34px; left:5%; height:2px; background:var(--gold); width:0; transition:width 1.4s ease; }
.level-path.in .level-line-fill{ width:90%; }
.level-step{ flex:1; text-align:center; position:relative; padding:0 12px; }
.level-num{ width:68px; height:68px; border-radius:50%; background:var(--paper-2); border:2px solid var(--line); display:flex; align-items:center; justify-content:center; margin:0 auto 20px; font-family:'IBM Plex Mono',monospace; font-weight:600; color:var(--ink); position:relative; z-index:2; transition:all .3s ease; }
.level-step:hover .level-num{ border-color:var(--gold); background:var(--gold); color:#fff; transform:scale(1.08); }
.level-step h4{ font-size:1.05rem; margin-bottom:10px; }
.level-step ul{ list-style:none; font-size:.85rem; color:var(--muted); line-height:1.9; }

/* ---------- Feature / Course cards ---------- */
.card-grid{ display:grid; grid-template-columns:repeat(auto-fit,minmax(230px,1fr)); gap:24px; }
.subject-card{ background:var(--paper-2); border:1px solid var(--line); border-radius:14px; padding:26px; transition:all .35s ease; position:relative; overflow:hidden; }
.subject-card::before{ content:''; position:absolute; top:0; left:0; width:4px; height:100%; background:var(--gold); transform:scaleY(0); transform-origin:bottom; transition:transform .35s ease; }
.subject-card:hover{ transform:translateY(-6px); box-shadow:0 16px 36px rgba(11,43,38,.1); }
.subject-card:hover::before{ transform:scaleY(1); }
.subject-card i{ font-size:1.4rem; color:var(--gold-deep); margin-bottom:14px; display:block; }
.subject-card h4{ font-size:1rem; margin-bottom:4px; }
.subject-card span{ color:var(--muted); font-size:.82rem; }

/* ---------- Tutors ---------- */
.tutor-card{ background:var(--paper-2); border-radius:16px; padding:30px; text-align:center; border:1px solid var(--line); transition:all .35s ease; }
.tutor-card:hover{ transform:translateY(-6px); box-shadow:0 16px 36px rgba(11,43,38,.1); }
.tutor-avatar{ width:64px; height:64px; border-radius:50%; background:linear-gradient(135deg,var(--ink),var(--ink-2)); color:#fff; display:flex; align-items:center; justify-content:center; font-family:'Fraunces',serif; font-weight:700; font-size:1.4rem; margin:0 auto 16px; }
.tutor-card h4{ font-size:1.05rem; margin-bottom:4px; }
.tutor-card .qual{ color:var(--muted); font-size:.82rem; margin-bottom:14px; }
.tutor-badge{ display:inline-block; font-size:.72rem; background:var(--paper); border:1px solid var(--line); padding:3px 12px; border-radius:20px; margin:2px 3px; color:var(--muted); }

/* ---------- Admission ---------- */
.admission{ background:var(--ink); color:#fff; border-radius:28px; padding:70px; position:relative; overflow:hidden; }
.admission::before{ content:''; position:absolute; bottom:-150px; left:-100px; width:400px; height:400px; background:radial-gradient(circle,rgba(227,168,87,.18),transparent 70%); border-radius:50%; }
.admission-grid{ display:grid; grid-template-columns:1fr 1fr; gap:60px; position:relative; z-index:2; align-items:center; }
.admission h2{ font-size:2.1rem; margin-bottom:16px; }
.admission p{ color:#c9d3cf; line-height:1.7; }
.field{ position:relative; margin-bottom:20px; }
.field input, .field textarea{
    width:100%; background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.15);
    border-radius:8px; padding:16px; color:#fff; font-family:'Inter',sans-serif; font-size:.9rem; transition:all .25s ease;
}
.field input::placeholder, .field textarea::placeholder{ color:#8fa39c; }
.field input:focus, .field textarea:focus{ outline:none; border-color:var(--gold); background:rgba(255,255,255,.1); }
.btn-submit{ width:100%; background:var(--gold); color:var(--ink); border:none; padding:16px; border-radius:8px; font-weight:700; font-size:.95rem; cursor:pointer; transition:all .3s ease; }
.btn-submit:hover{ background:#fff; transform:translateY(-2px); }
.success-box{ background:rgba(227,168,87,.15); border:1px solid var(--gold); color:#fce7c5; padding:14px 18px; border-radius:8px; margin-bottom:20px; font-size:.9rem; }

/* ---------- Footer ---------- */
footer.site-footer{ padding:40px 0; text-align:center; color:var(--muted); font-size:.85rem; border-top:1px solid var(--line); }

/* ---------- Responsive ---------- */
@media (max-width:900px){
    .nav-links{ position:fixed; top:0; right:-100%; width:70%; height:100vh; background:var(--paper-2); flex-direction:column; justify-content:center; gap:28px; transition:right .35s ease; box-shadow:-10px 0 30px rgba(0,0,0,.1); }
    .nav-links.open{ right:0; }
    .hamburger{ display:flex; }
    .hero-grid{ grid-template-columns:1fr; }
    .hero h1{ font-size:2.4rem; }
    .stats-grid{ grid-template-columns:1fr; gap:24px; }
    .level-path{ flex-direction:column; gap:24px; }
    .level-path::before, .level-path .level-line-fill{ display:none; }
    .admission{ padding:36px 20px; }
    .admission-grid{ grid-template-columns:1fr; gap:30px; }
    .section{ padding:70px 0; }
    .hero{ padding:140px 0 60px; }
}
</style>
</head>
<body>

<header class="site-header" id="siteHeader">
    <div class="container nav-wrap">
        <a href="#home" class="logo">Strong<em>Base</em></a>
        <nav class="nav-links" id="navLinks">
            <a href="#home">Home</a>
            <a href="#courses">Courses</a>
            <a href="#tutors">Tutors</a>
            <a href="{{ route('login') }}"><i class="fa-solid fa-user"></i></a>
            <a href="#admission" class="btn-pill">Book Demo</a>
        </nav>
        <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
    </div>
</header>

<!-- HERO -->
<section class="hero" id="home">
    <div class="container hero-grid">
        <div class="reveal in">
            <div class="eyebrow"><span class="dot"></span> Home Tuition Academy</div>
            <h1>Building a<br><span class="accent">strong base,</span><br>one subject at a time</h1>
            <p class="lead">From Primary through A-Levels — qualified tutors, small groups, and monthly progress tracking. Your child's education is our responsibility.</p>
            <div class="hero-ctas">
                <a href="#admission" class="btn-primary">Free Demo Class <i class="fa-solid fa-arrow-right"></i></a>
                <a href="#courses" class="btn-secondary">Explore Courses</a>
            </div>
        </div>
        <div class="reveal in" style="transition-delay:.15s;">
            <div class="hero-card">
                <h4>Kyun Strong Base?</h4>
                <div class="check-item"><i class="fa-solid fa-circle-check"></i> Subject-wise qualified tutors</div>
                <div class="check-item"><i class="fa-solid fa-circle-check"></i> Monthly progress reports</div>
                <div class="check-item"><i class="fa-solid fa-circle-check"></i> Attendance aur regular tests</div>
                <div class="check-item"><i class="fa-solid fa-circle-check"></i> Affordable, transparent fees</div>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="stats-strip">
    <div class="container stats-grid reveal">
        <div>
            <div class="stat-num" data-count="{{ $tutors->count() }}">0</div>
            <div class="stat-label">Tutors</div>
        </div>
        <div>
            <div class="stat-num" data-count="{{ $subjects->flatten()->count() }}">0</div>
            <div class="stat-label">Subjects</div>
        </div>
        <div>
            <div class="stat-num" data-count="{{ $subjects->keys()->count() }}">0</div>
            <div class="stat-label">Levels Covered</div>
        </div>
    </div>
</section>

<!-- LEVELS -->
<section class="section" id="courses">
    <div class="container">
        <div class="section-head reveal">
            <div class="eyebrow" style="margin-left:auto;margin-right:auto;"><span class="dot"></span> What We Teach</div>
            <h2>Courses by Level</h2>
        </div>
        <div class="level-path reveal">
            <div class="level-line-fill"></div>
            @forelse ($subjects as $level => $subjectsInLevel)
                <div class="level-step">
                    <div class="level-num">{{ $loop->iteration }}</div>
                    <h4>{{ $level }}</h4>
                    <ul>
                        @foreach ($subjectsInLevel as $subject)
                            <li>{{ $subject->name }}</li>
                        @endforeach
                    </ul>
                </div>
            @empty
                <p style="text-align:center; color:var(--muted);">Subjects jald hi add honge.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ALL SUBJECTS -->
<section class="section" style="background:var(--paper-2); padding-top:0;">
    <div class="container">
        <div class="section-head reveal">
            <div class="eyebrow" style="margin-left:auto;margin-right:auto;"><span class="dot"></span> Detail</div>
            <h2>All Subjects</h2>
        </div>
        <div class="card-grid reveal-stagger">
            @forelse ($subjects->flatten() as $subject)
                <div class="subject-card">
                    <i class="fa-solid fa-book-open"></i>
                    <h4>{{ $subject->name }}</h4>
                    <span>{{ $subject->level }}</span>
                </div>
            @empty
                <p style="color:var(--muted);">Subjects jald hi add honge.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- TUTORS -->
<section class="section" id="tutors">
    <div class="container">
        <div class="section-head reveal">
            <div class="eyebrow" style="margin-left:auto;margin-right:auto;"><span class="dot"></span> Our Team</div>
            <h2>Qualified Tutors</h2>
        </div>
        <div class="card-grid reveal-stagger">
            @forelse ($tutors as $tutor)
                <div class="tutor-card">
                    <div class="tutor-avatar">{{ strtoupper(substr($tutor->user->name,0,1)) }}</div>
                    <h4>{{ $tutor->user->name }}</h4>
                    <div class="qual">{{ $tutor->qualification ?? 'Subject Expert' }}</div>
                    <div>
                        @foreach ($tutor->subjects as $subject)
                            <span class="tutor-badge">{{ $subject->name }}</span>
                        @endforeach
                    </div>
                </div>
            @empty
                <p style="color:var(--muted);">Tutors jald hi add honge.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- ADMISSION -->
<section class="section" id="admission" style="padding-top:0;">
    <div class="container">
        <div class="admission reveal">
            <div class="admission-grid">
                <div>
                    <div class="eyebrow" style="background:rgba(227,168,87,.15);"><span class="dot"></span> Admission Inquiry</div>
                    <h2>Book a Free Demo Class</h2>
                    <p>Fill out the form and our team will get back to you within 24 hours.</p>
                </div>
                <div>
                    @if(session('success'))
                        <div class="success-box">{{ session('success') }}</div>
                    @endif
                    <form method="POST" action="{{ route('inquiry.store') }}">
                        @csrf
                        <div class="field"><input type="text" name="name" placeholder="Student's full name" value="{{ old('name') }}" required></div>
                        <div class="field"><input type="text" name="phone" placeholder="Phone number" value="{{ old('phone') }}" required></div>
                        <div class="field"><input type="text" name="class_level" placeholder="Class / Level (e.g. Class 9, FSc)" value="{{ old('class_level') }}" required></div>
                        <div class="field"><textarea name="message" rows="3" placeholder="Additional details (optional)">{{ old('message') }}</textarea></div>
                        <button type="submit" class="btn-submit">Send Inquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="site-footer">
    &copy; {{ date('Y') }} Strong Base Academy. All rights reserved.
</footer>

<script>
// Scroll reveal
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('in');
    });
}, { threshold: 0.15 });
document.querySelectorAll('.reveal, .reveal-stagger, .level-path').forEach(el => observer.observe(el));

// Header scroll state
window.addEventListener('scroll', () => {
    document.getElementById('siteHeader').classList.toggle('scrolled', window.scrollY > 40);
});

// Mobile menu
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('navLinks');
hamburger.addEventListener('click', () => navLinks.classList.toggle('open'));
navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => navLinks.classList.remove('open')));

// Animated counters
const counters = document.querySelectorAll('.stat-num');
const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const el = entry.target;
            const target = parseInt(el.dataset.count) || 0;
            let count = 0;
            const step = Math.max(1, Math.ceil(target / 40));
            const timer = setInterval(() => {
                count += step;
                if (count >= target) { count = target; clearInterval(timer); }
                el.textContent = count;
            }, 30);
            counterObserver.unobserve(el);
        }
    });
}, { threshold: 0.5 });
counters.forEach(c => counterObserver.observe(c));
</script>

</body>
</html>
