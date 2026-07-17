<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Strong Base Academy — Premium Tutoring, Reimagined</title>
@include('partials.favicon')
<meta name="description" content="Strong Base Academy pairs students from Primary through A-Levels with expert tutors, real-time progress tracking, and a modern learning experience.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;800&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root{
    --bg:#06070C; --bg-2:#0B0E17; --panel:#0F1420; --panel-2:#131829;
    --border:rgba(255,255,255,.08); --border-soft:rgba(255,255,255,.05);
    --text:#EDEEF3; --muted:#8B92A8; --muted-2:#5C6480;
    --violet:#7C6CF6; --cyan:#4CC9F0; --amber:#F0B429; --pink:#F65C9C;
    --grad-1: linear-gradient(135deg,var(--violet),var(--cyan));
}
*{ box-sizing:border-box; margin:0; padding:0; }
html{ scroll-behavior:smooth; }
body{ font-family:'Inter',sans-serif; background:var(--bg); color:var(--text); overflow-x:hidden; }
h1,h2,h3,.display{ font-family:'Space Grotesk',sans-serif; }
.mono{ font-family:'IBM Plex Mono',monospace; letter-spacing:.04em; }
a{ color:inherit; }
.container{ max-width:1200px; margin:0 auto; padding:0 24px; }
::selection{ background:var(--violet); color:#fff; }

/* ---------- Scroll progress ---------- */
#scrollProgress{ position:fixed; top:0; left:0; height:3px; background:var(--grad-1); z-index:999; width:0%; transition:width .1s linear; }

/* ---------- Aurora background ---------- */
.aurora{ position:fixed; inset:0; z-index:0; overflow:hidden; pointer-events:none; }
.aurora .blob{ position:absolute; border-radius:50%; filter:blur(90px); opacity:.35; }
.blob-1{ width:520px; height:520px; background:var(--violet); top:-120px; left:-100px; animation:drift1 22s ease-in-out infinite; }
.blob-2{ width:480px; height:480px; background:var(--cyan); top:200px; right:-150px; animation:drift2 26s ease-in-out infinite; }
.blob-3{ width:420px; height:420px; background:var(--pink); bottom:-150px; left:30%; animation:drift3 20s ease-in-out infinite; }
@keyframes drift1{ 0%,100%{ transform:translate(0,0);} 50%{ transform:translate(80px,60px);} }
@keyframes drift2{ 0%,100%{ transform:translate(0,0);} 50%{ transform:translate(-60px,80px);} }
@keyframes drift3{ 0%,100%{ transform:translate(0,0);} 50%{ transform:translate(60px,-40px);} }
.noise{ position:fixed; inset:0; z-index:1; pointer-events:none; opacity:.025;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E"); }

/* ---------- Glass utility ---------- */
.glass{ background:rgba(255,255,255,.03); backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px); border:1px solid var(--border); border-radius:20px; }

/* ---------- Reveal ---------- */
.reveal{ opacity:0; transform:translateY(24px); transition:opacity .7s ease, transform .7s ease; }
.reveal.in{ opacity:1; transform:translateY(0); }
.reveal-stagger > *{ opacity:0; transform:translateY(20px); transition:opacity .55s ease, transform .55s ease; }
.reveal-stagger.in > *{ opacity:1; transform:translateY(0); }
.reveal-stagger.in > *:nth-child(1){ transition-delay:.04s; }
.reveal-stagger.in > *:nth-child(2){ transition-delay:.12s; }
.reveal-stagger.in > *:nth-child(3){ transition-delay:.2s; }
.reveal-stagger.in > *:nth-child(4){ transition-delay:.28s; }

/* ---------- Navbar ---------- */
header.nav{ position:fixed; top:0; left:0; width:100%; z-index:100; padding:18px 0; transition:all .3s ease; }
header.nav.scrolled{ padding:12px 0; background:rgba(6,7,12,.7); backdrop-filter:blur(16px); border-bottom:1px solid var(--border-soft); }
.nav-wrap{ display:flex; align-items:center; justify-content:space-between; }
.logo{ display:flex; align-items:center; gap:9px; font-family:'Space Grotesk',sans-serif; font-weight:700; font-size:1.15rem; text-decoration:none; }
.logo-mark{ width:30px; height:30px; border-radius:9px; box-shadow:0 0 24px rgba(124,108,246,.5); }
.nav-links{ display:flex; align-items:center; gap:30px; list-style:none; }
.nav-links a:not(.btn-pill){ text-decoration:none; color:var(--muted); font-size:.9rem; font-weight:500; transition:color .2s ease; }
.nav-links a:not(.btn-pill):hover{ color:var(--text); }
.btn-pill{ background:var(--grad-1); color:#06070C!important; padding:10px 20px; border-radius:30px; font-weight:600; font-size:.85rem; text-decoration:none; transition:transform .25s ease, box-shadow .25s ease; box-shadow:0 0 0 rgba(124,108,246,0); }
.btn-pill:hover{ transform:translateY(-2px); box-shadow:0 8px 24px rgba(124,108,246,.4); }
.hamburger{ display:none; flex-direction:column; gap:5px; background:none; border:none; cursor:pointer; }
.hamburger span{ width:22px; height:2px; background:var(--text); }

/* ---------- Hero ---------- */
.hero{ position:relative; z-index:2; padding:180px 0 100px; min-height:100vh; display:flex; align-items:center; }
.hero-inner{ text-align:center; max-width:820px; margin:0 auto; }
.badge-eyebrow{ display:inline-flex; align-items:center; gap:8px; font-family:'IBM Plex Mono',monospace; font-size:.75rem; letter-spacing:.08em; text-transform:uppercase; color:var(--cyan); padding:7px 16px; border-radius:20px; margin-bottom:28px; }
.badge-eyebrow .dot{ width:6px; height:6px; border-radius:50%; background:var(--cyan); box-shadow:0 0 8px var(--cyan); animation:pulse 1.6s infinite; }
@keyframes pulse{ 0%,100%{opacity:1;} 50%{opacity:.3;} }
.hero h1{ font-size:4rem; font-weight:700; line-height:1.08; letter-spacing:-.02em; }
.hero h1 .grad{ background:var(--grad-1); -webkit-background-clip:text; background-clip:text; -webkit-text-fill-color:transparent; }
.hero p.lead{ font-size:1.15rem; color:var(--muted); margin:26px auto 0; max-width:560px; line-height:1.7; }
.hero-ctas{ display:flex; gap:16px; justify-content:center; margin-top:40px; flex-wrap:wrap; }
.btn-primary-grad{ background:var(--grad-1); color:#06070C; padding:15px 30px; border-radius:12px; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:10px; transition:all .3s ease; }
.btn-primary-grad:hover{ transform:translateY(-3px); box-shadow:0 14px 34px rgba(124,108,246,.35); }
.btn-ghost{ border:1px solid var(--border); color:var(--text); padding:15px 30px; border-radius:12px; font-weight:600; text-decoration:none; transition:all .3s ease; }
.btn-ghost:hover{ background:rgba(255,255,255,.05); border-color:rgba(255,255,255,.2); }

/* Floating badges around hero */
.float-badge{ position:absolute; padding:12px 16px; display:flex; align-items:center; gap:10px; font-size:.82rem; animation:float 5s ease-in-out infinite; }
.float-badge i{ color:var(--cyan); }
.fb-1{ top:22%; left:6%; animation-delay:.2s; }
.fb-2{ top:30%; right:6%; animation-delay:1s; }
.fb-3{ bottom:14%; left:10%; animation-delay:1.8s; }
@keyframes float{ 0%,100%{ transform:translateY(0);} 50%{ transform:translateY(-14px);} }

/* Dashboard preview mock */
.dash-preview{ max-width:920px; margin:64px auto 0; padding:18px; position:relative; }
.dash-preview .dash-topbar{ display:flex; gap:6px; padding:0 8px 14px; }
.dash-preview .dash-dot{ width:10px; height:10px; border-radius:50%; }
.dash-body{ display:grid; grid-template-columns:180px 1fr; gap:16px; }
.dash-side{ background:rgba(255,255,255,.02); border-radius:12px; padding:14px; display:flex; flex-direction:column; gap:8px; }
.dash-side .bar{ height:9px; border-radius:5px; background:rgba(255,255,255,.06); }
.dash-side .bar.active{ background:var(--grad-1); opacity:.8; }
.dash-main{ display:grid; grid-template-columns:repeat(3,1fr); gap:12px; }
.dash-card{ background:rgba(255,255,255,.03); border:1px solid var(--border-soft); border-radius:12px; padding:16px; }
.dash-card .num{ font-family:'IBM Plex Mono',monospace; font-size:1.3rem; font-weight:600; }
.dash-card .lbl{ font-size:.72rem; color:var(--muted); margin-top:4px; }
.dash-chart{ grid-column:1/-1; height:90px; display:flex; align-items:flex-end; gap:6px; padding-top:10px; }
.dash-chart .bar-col{ flex:1; border-radius:4px 4px 0 0; background:var(--grad-1); opacity:.7; animation:growUp 1.2s ease forwards; transform-origin:bottom; transform:scaleY(0); }

@keyframes growUp{ to{ transform:scaleY(1); } }

/* ---------- Stats strip ---------- */
.stats-strip{ position:relative; z-index:2; padding:50px 0; }
.stats-grid{ display:grid; grid-template-columns:repeat(3,1fr); text-align:center; padding:36px 0; }
.stat-num{ font-family:'IBM Plex Mono',monospace; font-size:2.3rem; font-weight:600; background:var(--grad-1); -webkit-background-clip:text; background-clip:text; -webkit-text-fill-color:transparent; }
.stat-label{ color:var(--muted); font-size:.8rem; text-transform:uppercase; letter-spacing:.08em; margin-top:6px; }

/* ---------- Sections ---------- */
.section{ position:relative; z-index:2; padding:110px 0; }
.section-head{ text-align:center; max-width:640px; margin:0 auto 60px; }
.section-head h2{ font-size:2.4rem; font-weight:700; margin-top:16px; letter-spacing:-.01em; }
.section-head p{ color:var(--muted); margin-top:14px; font-size:1.02rem; }

/* Feature cards */
.feature-grid{ display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:20px; }
.feature-card{ padding:28px; transition:all .35s ease; }
.feature-card:hover{ transform:translateY(-6px); border-color:rgba(124,108,246,.4); box-shadow:0 20px 50px rgba(124,108,246,.12); }
.feature-icon{ width:46px; height:46px; border-radius:12px; background:var(--grad-1); display:flex; align-items:center; justify-content:center; margin-bottom:18px; font-size:1.1rem; }
.feature-card h4{ font-size:1.05rem; margin-bottom:8px; font-weight:600; }
.feature-card p{ color:var(--muted); font-size:.9rem; line-height:1.6; }

/* How it works */
.steps{ display:grid; grid-template-columns:repeat(3,1fr); gap:24px; position:relative; }
.step-card{ padding:30px; position:relative; }
.step-num{ font-family:'IBM Plex Mono',monospace; font-size:.78rem; color:var(--cyan); margin-bottom:16px; display:block; }
.step-card h4{ font-size:1.1rem; margin-bottom:10px; }
.step-card p{ color:var(--muted); font-size:.9rem; line-height:1.6; }

/* Level path / courses */
.level-tag{ display:inline-block; font-family:'IBM Plex Mono',monospace; font-size:.7rem; padding:4px 10px; border-radius:20px; background:rgba(124,108,246,.15); color:var(--violet); margin-bottom:14px; }
.subject-card{ padding:22px; transition:all .3s ease; }
.subject-card:hover{ transform:translateY(-4px); border-color:rgba(76,201,240,.35); }
.subject-card i{ color:var(--cyan); font-size:1.2rem; margin-bottom:12px; display:block; }
.subject-card h4{ font-size:.98rem; margin-bottom:2px; }
.subject-card span{ color:var(--muted); font-size:.78rem; }

/* Tutors */
.tutor-card{ padding:28px; text-align:center; transition:all .3s ease; }
.tutor-card:hover{ transform:translateY(-6px); border-color:rgba(240,180,41,.35); }
.tutor-avatar{ width:60px; height:60px; border-radius:50%; background:var(--grad-1); display:flex; align-items:center; justify-content:center; font-family:'Space Grotesk',sans-serif; font-weight:700; margin:0 auto 14px; }
.tutor-card h4{ font-size:1rem; margin-bottom:3px; }
.tutor-card .qual{ color:var(--muted); font-size:.8rem; margin-bottom:14px; }
.tutor-badge{ display:inline-block; font-size:.7rem; background:rgba(255,255,255,.05); padding:3px 10px; border-radius:20px; margin:2px 3px; color:var(--muted); border:1px solid var(--border-soft); }

/* Testimonials */
.testi-grid{ display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:20px; }
.testi-card{ padding:28px; }
.testi-stars{ color:var(--amber); font-size:.8rem; margin-bottom:14px; }
.testi-card p{ color:var(--text); font-size:.92rem; line-height:1.7; opacity:.85; }
.testi-who{ margin-top:18px; font-size:.82rem; color:var(--muted); }

/* FAQ */
.faq-item{ border-bottom:1px solid var(--border-soft); padding:22px 0; cursor:pointer; }
.faq-item:first-child{ border-top:1px solid var(--border-soft); }
.faq-q{ display:flex; justify-content:space-between; align-items:center; font-weight:600; font-size:1rem; }
.faq-q i{ transition:transform .3s ease; color:var(--muted); }
.faq-item.open .faq-q i{ transform:rotate(45deg); }
.faq-a{ max-height:0; overflow:hidden; transition:max-height .35s ease; }
.faq-item.open .faq-a{ max-height:200px; }
.faq-a p{ color:var(--muted); padding-top:14px; font-size:.9rem; line-height:1.7; }

/* Admission / CTA */
.admission-wrap{ padding:60px; position:relative; overflow:hidden; }
.admission-wrap::before{ content:''; position:absolute; top:-100px; right:-100px; width:340px; height:340px; background:var(--grad-1); filter:blur(100px); opacity:.25; border-radius:50%; }
.admission-grid{ display:grid; grid-template-columns:1fr 1fr; gap:60px; position:relative; z-index:2; align-items:center; }
.field{ margin-bottom:18px; }
.field input, .field textarea{
    width:100%; background:rgba(255,255,255,.04); border:1px solid var(--border);
    border-radius:10px; padding:15px; color:var(--text); font-family:'Inter',sans-serif; font-size:.9rem; transition:all .25s ease;
}
.field input::placeholder, .field textarea::placeholder{ color:var(--muted-2); }
.field input:focus, .field textarea:focus{ outline:none; border-color:var(--violet); background:rgba(124,108,246,.06); }
.btn-submit-grad{ width:100%; background:var(--grad-1); color:#06070C; border:none; padding:16px; border-radius:10px; font-weight:700; font-size:.95rem; cursor:pointer; transition:all .3s ease; }
.btn-submit-grad:hover{ transform:translateY(-2px); box-shadow:0 14px 30px rgba(124,108,246,.35); }
.success-box{ background:rgba(76,201,240,.1); border:1px solid rgba(76,201,240,.3); color:#9fe3f5; padding:14px 18px; border-radius:10px; margin-bottom:20px; font-size:.9rem; }

/* Footer */
footer.site-footer{ position:relative; z-index:2; padding:50px 0 30px; border-top:1px solid var(--border-soft); }
.footer-grid{ display:flex; justify-content:space-between; flex-wrap:wrap; gap:24px; align-items:center; }
.footer-links{ display:flex; gap:24px; list-style:none; flex-wrap:wrap; }
.footer-links a{ text-decoration:none; color:var(--muted); font-size:.85rem; }
.footer-bottom{ margin-top:30px; text-align:center; color:var(--muted-2); font-size:.8rem; }

/* Back to top */
#backToTop{ position:fixed; bottom:26px; right:26px; width:46px; height:46px; border-radius:50%; background:var(--grad-1); color:#06070C; border:none; display:flex; align-items:center; justify-content:center; cursor:pointer; opacity:0; pointer-events:none; transition:all .3s ease; z-index:90; }
#backToTop.show{ opacity:1; pointer-events:auto; }
#backToTop:hover{ transform:translateY(-3px); }

/* ---------- Responsive ---------- */
@media (max-width:900px){
    .nav-links{ position:fixed; top:0; right:-100%; width:75%; height:100vh; background:var(--bg-2); flex-direction:column; justify-content:center; gap:28px; transition:right .35s ease; border-left:1px solid var(--border); z-index:110; }
    .nav-links.open{ right:0; }
    .hamburger{ display:flex; z-index:120; }
    .hero h1{ font-size:2.6rem; }
    .dash-body{ grid-template-columns:1fr; }
    .dash-side{ flex-direction:row; flex-wrap:wrap; }
    .dash-main{ grid-template-columns:1fr 1fr; }
    .stats-grid{ grid-template-columns:1fr; gap:24px; }
    .steps{ grid-template-columns:1fr; }
    .admission-wrap{ padding:30px 20px; }
    .admission-grid{ grid-template-columns:1fr; gap:30px; }
    .section{ padding:70px 0; }
    .hero{ padding:140px 0 60px; }
    .float-badge{ display:none; }
}
</style>
</head>
<body>

<div id="scrollProgress"></div>
<div class="aurora"><div class="blob blob-1"></div><div class="blob blob-2"></div><div class="blob blob-3"></div></div>
<div class="noise"></div>

<header class="nav" id="siteHeader">
    <div class="container nav-wrap">
        <a href="#home" class="logo">
            <img src="{{ asset('favicon.svg') }}" alt="Strong Base Academy" class="logo-mark"> Strong Base Academy
        </a>
        <nav class="nav-links" id="navLinks">
            <a href="#features">Features</a>
            <a href="#courses">Courses</a>
            <a href="#tutors">Tutors</a>
            <a href="#faq">FAQ</a>
            <a href="{{ route('login') }}">Sign In</a>
            <a href="#admission" class="btn-pill">Book a Demo</a>
        </nav>
        <button class="hamburger" id="hamburger"><span></span><span></span><span></span></button>
    </div>
</header>

<!-- HERO -->
<section class="hero" id="home">
    <div class="float-badge glass fb-1"><i class="fa-solid fa-chart-line"></i> Real-time progress tracking</div>
    <div class="float-badge glass fb-2"><i class="fa-solid fa-user-check"></i> Vetted, qualified tutors</div>
    <div class="float-badge glass fb-3"><i class="fa-solid fa-bolt"></i> Enroll in minutes</div>

    <div class="container hero-inner reveal in">
        <div class="badge-eyebrow glass"><span class="dot"></span> Now enrolling for the new term</div>
        <h1>The modern way to <span class="grad">learn, teach,</span> and grow.</h1>
        <p class="lead">Strong Base Academy connects students from Primary through A-Levels with expert tutors — backed by structured attendance, transparent fees, and real progress reports.</p>
        <div class="hero-ctas">
            <a href="#admission" class="btn-primary-grad">Book a Free Demo Class <i class="fa-solid fa-arrow-right"></i></a>
            <a href="#courses" class="btn-ghost">Explore Courses</a>
        </div>

        <div class="dash-preview glass reveal in" style="transition-delay:.2s;">
            <div class="dash-topbar">
                <span class="dash-dot" style="background:#F65C9C;"></span>
                <span class="dash-dot" style="background:#F0B429;"></span>
                <span class="dash-dot" style="background:#4CC9F0;"></span>
            </div>
            <div class="dash-body">
                <div class="dash-side">
                    <div class="bar active" style="width:70%;"></div>
                    <div class="bar" style="width:50%;"></div>
                    <div class="bar" style="width:60%;"></div>
                    <div class="bar" style="width:40%;"></div>
                    <div class="bar" style="width:55%;"></div>
                </div>
                <div class="dash-main">
                    <div class="dash-card"><div class="num">248</div><div class="lbl">Active Students</div></div>
                    <div class="dash-card"><div class="num">32</div><div class="lbl">Expert Tutors</div></div>
                    <div class="dash-card"><div class="num">98%</div><div class="lbl">Attendance Rate</div></div>
                    <div class="dash-chart">
                        <div class="bar-col" style="height:40%; animation-delay:.1s;"></div>
                        <div class="bar-col" style="height:65%; animation-delay:.2s;"></div>
                        <div class="bar-col" style="height:45%; animation-delay:.3s;"></div>
                        <div class="bar-col" style="height:80%; animation-delay:.4s;"></div>
                        <div class="bar-col" style="height:55%; animation-delay:.5s;"></div>
                        <div class="bar-col" style="height:90%; animation-delay:.6s;"></div>
                        <div class="bar-col" style="height:70%; animation-delay:.7s;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="stats-strip">
    <div class="container glass stats-grid reveal">
        <div>
            <div class="stat-num" data-count="{{ $tutors->count() }}">0</div>
            <div class="stat-label">Expert Tutors</div>
        </div>
        <div>
            <div class="stat-num" data-count="{{ $subjects->flatten()->count() }}">0</div>
            <div class="stat-label">Subjects Offered</div>
        </div>
        <div>
            <div class="stat-num" data-count="{{ $subjects->keys()->count() }}">0</div>
            <div class="stat-label">Levels Covered</div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="section" id="features">
    <div class="container">
        <div class="section-head reveal">
            <div class="badge-eyebrow glass" style="margin-left:auto;margin-right:auto;"><span class="dot"></span> Why Strong Base</div>
            <h2>Built for outcomes, not just attendance.</h2>
            <p>Every feature is designed around one goal: measurable academic progress.</p>
        </div>
        <div class="feature-grid reveal-stagger">
            <div class="feature-card glass">
                <div class="feature-icon"><i class="fa-solid fa-user-graduate"></i></div>
                <h4>Qualified Tutors</h4>
                <p>Every tutor is vetted for subject expertise, not just availability.</p>
            </div>
            <div class="feature-card glass">
                <div class="feature-icon"><i class="fa-solid fa-chart-line"></i></div>
                <h4>Progress Reports</h4>
                <p>Monthly, data-backed reports so you always know where your child stands.</p>
            </div>
            <div class="feature-card glass">
                <div class="feature-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <h4>Verified Attendance</h4>
                <p>Every session is logged — no guesswork, no missed classes unnoticed.</p>
            </div>
            <div class="feature-card glass">
                <div class="feature-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                <h4>Transparent Fees</h4>
                <p>Clear monthly pricing with digital receipts — no hidden charges, ever.</p>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="section" style="padding-top:0;">
    <div class="container">
        <div class="section-head reveal">
            <div class="badge-eyebrow glass" style="margin-left:auto;margin-right:auto;"><span class="dot"></span> Getting Started</div>
            <h2>Three steps to your first class.</h2>
        </div>
        <div class="steps reveal-stagger">
            <div class="step-card glass">
                <span class="step-num">STEP 01</span>
                <h4>Book a Free Demo</h4>
                <p>Tell us the subject and level — we'll schedule a no-obligation trial class.</p>
            </div>
            <div class="step-card glass">
                <span class="step-num">STEP 02</span>
                <h4>Get Matched</h4>
                <p>We pair your child with a tutor suited to their subject and learning pace.</p>
            </div>
            <div class="step-card glass">
                <span class="step-num">STEP 03</span>
                <h4>Track Progress</h4>
                <p>Attendance, test results, and monthly reports — all in one place.</p>
            </div>
        </div>
    </div>
</section>

<!-- COURSES -->
<section class="section" id="courses">
    <div class="container">
        <div class="section-head reveal">
            <div class="badge-eyebrow glass" style="margin-left:auto;margin-right:auto;"><span class="dot"></span> Curriculum</div>
            <h2>Courses across every level.</h2>
        </div>
        @forelse ($subjects as $level => $subjectsInLevel)
            <div class="mb-4 reveal" style="margin-bottom:36px;">
                <span class="level-tag">{{ $level }}</span>
                <div class="feature-grid">
                    @foreach ($subjectsInLevel as $subject)
                        <div class="subject-card glass">
                            <i class="fa-solid fa-book-open"></i>
                            <h4>{{ $subject->name }}</h4>
                            <span>{{ $subject->level }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p style="text-align:center; color:var(--muted);">Subjects will be listed here soon.</p>
        @endforelse
    </div>
</section>

<!-- TUTORS -->
<section class="section" id="tutors">
    <div class="container">
        <div class="section-head reveal">
            <div class="badge-eyebrow glass" style="margin-left:auto;margin-right:auto;"><span class="dot"></span> Our Team</div>
            <h2>Meet a few of our tutors.</h2>
        </div>
        <div class="feature-grid reveal-stagger">
            @forelse ($tutors as $tutor)
                <div class="tutor-card glass">
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
                <p style="color:var(--muted);">Tutor profiles will be listed here soon.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- TESTIMONIALS (sample placeholders) -->
<section class="section">
    <div class="container">
        <div class="section-head reveal">
            <div class="badge-eyebrow glass" style="margin-left:auto;margin-right:auto;"><span class="dot"></span> Testimonials</div>
            <h2>What families are saying.</h2>
        </div>
        <div class="testi-grid reveal-stagger">
            <div class="testi-card glass">
                <div class="testi-stars">★★★★★</div>
                <p>"The monthly progress reports finally gave us visibility into how our daughter is actually doing — not just her grades, but her attendance and effort too."</p>
                <div class="testi-who">— Parent of a Matric student</div>
            </div>
            <div class="testi-card glass">
                <div class="testi-stars">★★★★★</div>
                <p>"Switching tutors used to mean starting over. Here, everything is tracked, so the next tutor already knows exactly where my son left off."</p>
                <div class="testi-who">— Parent of an FSc student</div>
            </div>
            <div class="testi-card glass">
                <div class="testi-stars">★★★★★</div>
                <p>"Transparent fees and digital receipts — no more confusion about what's paid and what's due. It's a small thing that makes a big difference."</p>
                <div class="testi-who">— Parent of an O-Level student</div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section" id="faq">
    <div class="container" style="max-width:760px;">
        <div class="section-head reveal">
            <div class="badge-eyebrow glass" style="margin-left:auto;margin-right:auto;"><span class="dot"></span> FAQ</div>
            <h2>Frequently asked questions.</h2>
        </div>
        <div class="reveal">
            <div class="faq-item">
                <div class="faq-q">How do I book a free demo class? <i class="fa-solid fa-plus"></i></div>
                <div class="faq-a"><p>Fill out the admission form below with your child's name, class level, and contact number. Our team will reach out within 24 hours to schedule a free trial session.</p></div>
            </div>
            <div class="faq-item">
                <div class="faq-q">How are tutors matched to students? <i class="fa-solid fa-plus"></i></div>
                <div class="faq-a"><p>Tutors are matched based on subject expertise and the student's class level, ensuring the right fit from the very first class.</p></div>
            </div>
            <div class="faq-item">
                <div class="faq-q">How do fee payments work? <i class="fa-solid fa-plus"></i></div>
                <div class="faq-a"><p>Fees are billed monthly with a clear due date. You'll receive a digital receipt for every payment, and reminders are sent for anything outstanding.</p></div>
            </div>
            <div class="faq-item">
                <div class="faq-q">Can I track my child's attendance? <i class="fa-solid fa-plus"></i></div>
                <div class="faq-a"><p>Yes — every class session is logged by the tutor in real time, so attendance records are always accurate and up to date.</p></div>
            </div>
        </div>
    </div>
</section>

<!-- ADMISSION -->
<section class="section" id="admission" style="padding-top:0;">
    <div class="container">
        <div class="admission-wrap glass reveal">
            <div class="admission-grid">
                <div>
                    <div class="badge-eyebrow glass"><span class="dot"></span> Admission Inquiry</div>
                    <h2 style="font-size:2rem; margin-bottom:16px;">Book your free demo class today.</h2>
                    <p style="color:var(--muted); line-height:1.7;">Fill out the form and our team will get back to you within 24 hours to schedule a trial session.</p>
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
                        <button type="submit" class="btn-submit-grad">Send Inquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <a href="#home" class="logo"><img src="{{ asset('favicon.svg') }}" alt="Strong Base Academy" class="logo-mark"> Strong Base Academy</a>
            <ul class="footer-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#courses">Courses</a></li>
                <li><a href="#tutors">Tutors</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="{{ route('login') }}">Sign In</a></li>
            </ul>
        </div>
        <div class="footer-bottom">&copy; {{ date('Y') }} Strong Base Academy. All rights reserved.</div>
    </div>
</footer>

<button id="backToTop" aria-label="Back to top"><i class="fa-solid fa-arrow-up"></i></button>

<script>
// Scroll progress bar
const progressBar = document.getElementById('scrollProgress');
window.addEventListener('scroll', () => {
    const h = document.documentElement;
    const scrolled = (h.scrollTop) / (h.scrollHeight - h.clientHeight) * 100;
    progressBar.style.width = scrolled + '%';

    document.getElementById('siteHeader').classList.toggle('scrolled', window.scrollY > 40);
    document.getElementById('backToTop').classList.toggle('show', window.scrollY > 500);
});

// Back to top
document.getElementById('backToTop').addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Reveal on scroll
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('in'); });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal, .reveal-stagger').forEach(el => observer.observe(el));

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

// FAQ accordion
document.querySelectorAll('.faq-item').forEach(item => {
    item.querySelector('.faq-q').addEventListener('click', () => {
        const isOpen = item.classList.contains('open');
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
        if (!isOpen) item.classList.add('open');
    });
});

// Mouse parallax on hero float badges
document.addEventListener('mousemove', (e) => {
    const x = (e.clientX / window.innerWidth - 0.5) * 20;
    const y = (e.clientY / window.innerHeight - 0.5) * 20;
    document.querySelectorAll('.float-badge').forEach((el, i) => {
        const factor = (i + 1) * 0.4;
        el.style.transform = `translate(${x * factor}px, ${y * factor}px)`;
    });
});
</script>

</body>
</html>
