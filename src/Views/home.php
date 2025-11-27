<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shinmen - Learn to Code Interactively</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        /* Void Black & Neon Purple Theme */
        .hero-section {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 120px 24px 80px;
            background: #000000;
        }
        
        .hero-bg {
            position: absolute;
            inset: 0;
            overflow: hidden;
            background: 
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(168, 85, 247, 0.18) 0%, transparent 50%),
                radial-gradient(ellipse 60% 40% at 80% 60%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse 50% 30% at 20% 80%, rgba(124, 58, 237, 0.08) 0%, transparent 50%);
        }
        
        /* Neon purple glow orbs */
        .hero-gradient {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.5;
        }
        
        .gradient-1 {
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.5) 0%, rgba(139, 92, 246, 0.25) 40%, transparent 70%);
            top: -400px;
            left: 50%;
            transform: translateX(-50%);
            animation: pulseGlow1 8s ease-in-out infinite;
        }
        
        .gradient-2 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.4) 0%, rgba(109, 40, 217, 0.2) 40%, transparent 70%);
            bottom: -300px;
            left: -200px;
            animation: pulseGlow2 10s ease-in-out infinite;
        }
        
        .gradient-3 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(192, 132, 252, 0.3) 0%, transparent 60%);
            top: 40%;
            right: -150px;
            animation: pulseGlow3 12s ease-in-out infinite;
        }
        
        .gradient-4 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(216, 180, 254, 0.25) 0%, transparent 60%);
            bottom: 20%;
            left: 10%;
            animation: pulseGlow4 9s ease-in-out infinite;
        }
        
        @keyframes pulseGlow1 {
            0%, 100% { opacity: 0.5; transform: translateX(-50%) scale(1); }
            50% { opacity: 0.7; transform: translateX(-50%) scale(1.1); }
        }
        
        @keyframes pulseGlow2 {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.15); }
        }
        
        @keyframes pulseGlow3 {
            0%, 100% { opacity: 0.3; transform: scale(1) translateY(0); }
            50% { opacity: 0.5; transform: scale(1.1) translateY(-20px); }
        }
        
        @keyframes pulseGlow4 {
            0%, 100% { opacity: 0.25; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.2); }
        }
        
        /* Subtle scan lines effect */
        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(168, 85, 247, 0.015) 2px,
                rgba(168, 85, 247, 0.015) 4px
            );
            pointer-events: none;
        }
        
        .hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 50%, transparent 0%, rgba(0,0,0,0.4) 100%);
            pointer-events: none;
        }
        
        .grid-pattern {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(168, 85, 247, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(168, 85, 247, 0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 70% 50% at 50% 30%, black 0%, transparent 70%);
        }
        
        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 1200px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }
        
        @media (max-width: 1024px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 48px;
            }
            .hero-text { order: 1; }
            .hero-visual { order: 2; }
        }
        
        /* Void badge */
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(56, 189, 248, 0.08);
            border: 1px solid rgba(56, 189, 248, 0.2);
            padding: 10px 18px;
            border-radius: 100px;
            font-size: 13px;
            font-weight: 500;
            color: #7dd3fc;
            margin-bottom: 28px;
        }
        
        .hero-badge svg {
            color: #38bdf8;
            animation: glow 2s ease-in-out infinite;
        }
        
        @keyframes glow {
            0%, 100% { opacity: 1; filter: drop-shadow(0 0 4px rgba(56, 189, 248, 0.5)); }
            50% { opacity: 0.8; filter: drop-shadow(0 0 8px rgba(56, 189, 248, 0.8)); }
        }
        
        .hero-title {
            font-size: clamp(42px, 5.5vw, 72px);
            font-weight: 700;
            line-height: 1.05;
            letter-spacing: -0.035em;
            margin-bottom: 24px;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        .hero-title span {
            background: linear-gradient(
                135deg,
                #ffffff 0%,
                #38bdf8 40%,
                #0ea5e9 60%,
                #7dd3fc 100%
            );
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: blueShimmer 6s ease-in-out infinite;
        }
        
        @keyframes blueShimmer {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .hero-desc {
            font-size: 18px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 36px;
            max-width: 480px;
            font-weight: 400;
        }
        
        @media (max-width: 1024px) {
            .hero-desc { margin: 0 auto 36px; }
        }
        
        .hero-buttons {
            display: flex;
            gap: 14px;
            margin-bottom: 56px;
        }
        
        @media (max-width: 1024px) {
            .hero-buttons { justify-content: center; }
        }
        
        /* Electric blue primary button */
        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 28px;
            background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
            border: none;
            border-radius: 12px;
            color: #000;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 
                0 0 20px rgba(56, 189, 248, 0.3),
                0 4px 16px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-hero-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #38bdf8 0%, #7dd3fc 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .btn-hero-primary:hover {
            transform: translateY(-2px) scale(1.02);
            color: #000;
            box-shadow: 
                0 0 40px rgba(56, 189, 248, 0.5),
                0 8px 32px rgba(0, 0, 0, 0.3);
        }
        
        .btn-hero-primary:hover::before {
            opacity: 1;
        }
        
        .btn-hero-primary span {
            position: relative;
            z-index: 1;
        }
        
        /* Ghost secondary button */
        .btn-hero-secondary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 28px;
            background: transparent;
            border: 1px solid rgba(56, 189, 248, 0.3);
            border-radius: 12px;
            color: #7dd3fc;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-hero-secondary:hover {
            background: rgba(56, 189, 248, 0.1);
            border-color: rgba(56, 189, 248, 0.5);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.15);
        }
        
        /* Stats */
        .hero-stats {
            display: flex;
            gap: 40px;
        }
        
        @media (max-width: 1024px) {
            .hero-stats { justify-content: center; }
        }
        
        .stat-item {
            position: relative;
        }
        
        .stat-item h3 {
            font-size: 36px;
            font-weight: 700;
            letter-spacing: -0.02em;
            background: linear-gradient(180deg, #38bdf8 0%, #0ea5e9 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-item p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.35);
            margin-top: 4px;
            font-weight: 500;
            letter-spacing: 0.02em;
        }
        
        /* Code editor window */
        .hero-visual {
            position: relative;
        }
        
        .code-window {
            background: rgba(8, 8, 12, 0.9);
            border: 1px solid rgba(56, 189, 248, 0.15);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 
                0 0 60px rgba(56, 189, 248, 0.1),
                0 50px 100px -20px rgba(0, 0, 0, 0.7),
                inset 0 1px 0 rgba(56, 189, 248, 0.1);
            transform: perspective(1200px) rotateY(-3deg) rotateX(3deg);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .code-window:hover {
            transform: perspective(1200px) rotateY(0) rotateX(0);
            border-color: rgba(56, 189, 248, 0.25);
            box-shadow: 
                0 0 80px rgba(56, 189, 248, 0.15),
                0 50px 100px -20px rgba(0, 0, 0, 0.7),
                inset 0 1px 0 rgba(56, 189, 248, 0.15);
        }
        
        .code-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            background: rgba(56, 189, 248, 0.03);
            border-bottom: 1px solid rgba(56, 189, 248, 0.1);
        }
        
        .window-dots {
            display: flex;
            gap: 8px;
        }
        
        .window-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            transition: all 0.2s ease;
        }
        
        .dot-red { 
            background: #3b3b3b;
            border: 1px solid #555;
        }
        .dot-yellow { 
            background: #3b3b3b;
            border: 1px solid #555;
        }
        .dot-green { 
            background: #3b3b3b;
            border: 1px solid #555;
        }
        
        .code-window:hover .dot-red { background: #ff5f57; border-color: #e0443d; }
        .code-window:hover .dot-yellow { background: #febc2e; border-color: #dea123; }
        .code-window:hover .dot-green { background: #28c840; border-color: #1aab29; }
        
        .code-tabs {
            display: flex;
            gap: 2px;
            margin-left: auto;
        }
        
        .code-tab {
            padding: 6px 14px;
            background: rgba(56, 189, 248, 0.05);
            border-radius: 6px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }
        
        .code-tab.active {
            background: rgba(56, 189, 248, 0.12);
            color: #7dd3fc;
        }
        
        .code-tab img { 
            width: 14px; 
            height: 14px;
            opacity: 0.9;
        }
        
        .code-body {
            padding: 24px;
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 13px;
            line-height: 1.9;
            background: transparent;
        }
        
        .code-line {
            display: flex;
        }
        
        .line-num {
            color: rgba(56, 189, 248, 0.2);
            width: 28px;
            text-align: right;
            margin-right: 20px;
            user-select: none;
            font-size: 12px;
        }
        
        .code-output {
            margin-top: 20px;
            padding: 16px;
            background: rgba(56, 189, 248, 0.05);
            border-radius: 8px;
            border-left: 3px solid #38bdf8;
        }
        
        .output-label {
            font-size: 10px;
            font-weight: 600;
            color: #38bdf8;
            letter-spacing: 0.12em;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        
        .output-text {
            color: rgba(255, 255, 255, 0.9);
        }
        
        /* Floating Elements */
        .floating-icons {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }
        
        .floating-icon {
            position: absolute;
            background: rgba(56, 189, 248, 0.05);
            border: 1px solid rgba(56, 189, 248, 0.15);
            border-radius: 14px;
            padding: 14px;
            animation: floatGlow 8s ease-in-out infinite;
        }
        
        .floating-icon img { 
            width: 26px; 
            height: 26px;
            opacity: 0.85;
        }
        
        .float-1 { top: 8%; left: -70px; animation-delay: 0s; }
        .float-2 { top: 55%; left: -50px; animation-delay: 2s; }
        .float-3 { top: 15%; right: -60px; animation-delay: 1s; }
        .float-4 { bottom: 12%; right: -70px; animation-delay: 3s; }
        
        @keyframes floatGlow {
            0%, 100% { 
                transform: translateY(0); 
                box-shadow: 0 0 20px rgba(56, 189, 248, 0.1);
            }
            50% { 
                transform: translateY(-12px); 
                box-shadow: 0 0 30px rgba(56, 189, 248, 0.2);
            }
        }
        
        /* Cyan/Blue syntax colors */
        .kw { color: #38bdf8; }
        .fn { color: #7dd3fc; }
        .str { color: #67e8f9; }
        .num { color: #a5f3fc; }
        .var { color: #e0f2fe; }
        .cm { color: rgba(56, 189, 248, 0.4); }
        .op { color: #0ea5e9; }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .hero-section {
                padding: 100px 16px 60px;
                min-height: auto;
            }
            
            .hero-title {
                font-size: 34px;
            }
            
            .hero-desc {
                font-size: 16px;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-hero-primary, .btn-hero-secondary {
                width: 100%;
                max-width: 280px;
                justify-content: center;
                padding: 14px 24px;
            }
            
            .hero-stats {
                gap: 28px;
                flex-wrap: wrap;
            }
            
            .stat-item h3 {
                font-size: 28px;
            }
            
            .code-window {
                transform: none;
                margin: 0 -8px;
                border-radius: 10px;
            }
            
            .code-window:hover {
                transform: none;
            }
            
            .code-body {
                padding: 16px;
                font-size: 11px;
            }
            
            .code-tabs {
                display: none;
            }
            
            .floating-icons {
                display: none;
            }
            
            .hero-visual {
                margin: 0 -8px;
            }
        }
        
        @media (max-width: 480px) {
            .hero-title {
                font-size: 28px;
            }
            
            .hero-badge {
                font-size: 11px;
                padding: 8px 14px;
            }
            
            .stat-item h3 {
                font-size: 22px;
            }
            
            .stat-item p {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <nav class="topnav">
        <div class="topnav-left">
            <a href="/" class="logo">Shin<span>men</span></a>
            <a href="/courses" class="nav-link">Tutorials</a>
            <a href="/editor" class="nav-link">Playground</a>
        </div>
        <div class="topnav-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/dashboard" class="nav-link">Dashboard</a>
                <a href="/logout" class="nav-link">Logout</a>
            <?php else: ?>
                <a href="/login" class="nav-link">Log In</a>
                <a href="/register" class="btn btn-signup">Sign Up Free</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-bg">
            <div class="hero-gradient gradient-1"></div>
            <div class="hero-gradient gradient-2"></div>
            <div class="hero-gradient gradient-3"></div>
            <div class="hero-gradient gradient-4"></div>
            <div class="grid-pattern"></div>
        </div>
        
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    Free interactive coding platform
                </div>
                
                <h1 class="hero-title">
                    Learn to code<br><span>the right way</span>
                </h1>
                
                <p class="hero-desc">
                    Master Python, JavaScript, and more with interactive lessons, 
                    real-time code execution, and personalized progress tracking.
                </p>
                
                <div class="hero-buttons">
                    <a href="/register" class="btn-hero-primary">
                        Start Learning Free
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="/editor" class="btn-hero-secondary">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        Try Playground
                    </a>
                </div>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <h3>10K+</h3>
                        <p>Active learners</p>
                    </div>
                    <div class="stat-item">
                        <h3>50+</h3>
                        <p>Lessons</p>
                    </div>
                    <div class="stat-item">
                        <h3>5</h3>
                        <p>Languages</p>
                    </div>
                </div>
            </div>
            
            <div class="hero-visual">
                <div class="code-window">
                    <div class="code-header">
                        <div class="window-dots">
                            <div class="window-dot dot-red"></div>
                            <div class="window-dot dot-yellow"></div>
                            <div class="window-dot dot-green"></div>
                        </div>
                        <div class="code-tabs">
                            <div class="code-tab active">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" alt="">
                                main.py
                            </div>
                        </div>
                    </div>
                    <div class="code-body">
                        <div class="code-line"><span class="line-num">1</span><span class="cm"># Welcome to Shinmen!</span></div>
                        <div class="code-line"><span class="line-num">2</span><span class="kw">def</span> <span class="fn">greet</span>(<span class="var">name</span>):</div>
                        <div class="code-line"><span class="line-num">3</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="kw">return</span> <span class="str">f"Hello, </span><span class="op">{</span><span class="var">name</span><span class="op">}</span><span class="str">!"</span></div>
                        <div class="code-line"><span class="line-num">4</span></div>
                        <div class="code-line"><span class="line-num">5</span><span class="var">message</span> <span class="op">=</span> <span class="fn">greet</span>(<span class="str">"Coder"</span>)</div>
                        <div class="code-line"><span class="line-num">6</span><span class="fn">print</span>(<span class="var">message</span>)</div>
                        
                        <div class="code-output">
                            <div class="output-label">OUTPUT</div>
                            <div class="output-text">Hello, Coder!</div>
                        </div>
                    </div>
                </div>
                
                <div class="floating-icons">
                    <div class="floating-icon float-1">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" alt="">
                    </div>
                    <div class="floating-icon float-2">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="">
                    </div>
                    <div class="floating-icon float-3">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" alt="">
                    </div>
                    <div class="floating-icon float-4">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Languages Bar -->
    <section style="background: #0c0c0f; border-top: 1px solid #27272a; border-bottom: 1px solid #27272a; padding: 24px 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 48px; flex-wrap: wrap;">
                <span style="color: #52525b; font-size: 14px; font-weight: 500;">LEARN</span>
                <a href="/course/1" style="display: flex; align-items: center; gap: 10px; color: #a1a1aa; text-decoration: none; transition: color 0.2s;">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" width="24" height="24" alt="">
                    <span style="font-weight: 500;">Python</span>
                </a>
                <a href="/course/2" style="display: flex; align-items: center; gap: 10px; color: #a1a1aa; text-decoration: none; transition: color 0.2s;">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" width="24" height="24" alt="">
                    <span style="font-weight: 500;">JavaScript</span>
                </a>
                <a href="/courses" style="display: flex; align-items: center; gap: 10px; color: #52525b; text-decoration: none;">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg" width="24" height="24" alt="" style="opacity: 0.5;">
                    <span style="font-weight: 500;">Java</span>
                    <span style="font-size: 11px; padding: 2px 8px; background: #27272a; border-radius: 100px;">Soon</span>
                </a>
                <a href="/courses" style="display: flex; align-items: center; gap: 10px; color: #52525b; text-decoration: none;">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/cplusplus/cplusplus-original.svg" width="24" height="24" alt="" style="opacity: 0.5;">
                    <span style="font-weight: 500;">C++</span>
                    <span style="font-size: 11px; padding: 2px 8px; background: #27272a; border-radius: 100px;">Soon</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section style="padding: 100px 24px; background: #09090b;">
        <div style="max-width: 1100px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 64px;">
                <h2 style="font-size: 40px; font-weight: 800; margin-bottom: 16px;">Why choose Shinmen?</h2>
                <p style="color: #71717a; font-size: 18px; max-width: 600px; margin: 0 auto;">Everything you need to go from beginner to confident programmer</p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px;">
                <div style="background: #18181b; border: 1px solid #27272a; border-radius: 16px; padding: 32px; transition: all 0.3s;">
                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, rgba(6, 182, 212, 0.2), rgba(6, 182, 212, 0.05)); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <svg width="28" height="28" fill="none" stroke="#06b6d4" stroke-width="2" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 8px;">Instant Execution</h3>
                    <p style="color: #71717a; line-height: 1.6;">Write code and see results instantly. No setup required - just start coding in your browser.</p>
                </div>
                
                <div style="background: #18181b; border: 1px solid #27272a; border-radius: 16px; padding: 32px; transition: all 0.3s;">
                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(99, 102, 241, 0.05)); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <svg width="28" height="28" fill="none" stroke="#6366f1" stroke-width="2" viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 8px;">Structured Learning</h3>
                    <p style="color: #71717a; line-height: 1.6;">Follow our step-by-step curriculum from basics to advanced with hands-on exercises.</p>
                </div>
                
                <div style="background: #18181b; border: 1px solid #27272a; border-radius: 16px; padding: 32px; transition: all 0.3s;">
                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(34, 197, 94, 0.05)); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <svg width="28" height="28" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
                    </div>
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 8px;">Track Progress</h3>
                    <p style="color: #71717a; line-height: 1.6;">Earn XP, unlock badges, and maintain streaks as you complete lessons and challenges.</p>
                </div>
                
                <div style="background: #18181b; border: 1px solid #27272a; border-radius: 16px; padding: 32px; transition: all 0.3s;">
                    <div style="width: 56px; height: 56px; background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(245, 158, 11, 0.05)); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <svg width="28" height="28" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    </div>
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 8px;">Interactive Quizzes</h3>
                    <p style="color: #71717a; line-height: 1.6;">Test your knowledge with quizzes and coding challenges after each module.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Cards -->
    <section style="padding: 100px 24px; background: #0c0c0f;">
        <div style="max-width: 1100px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 64px;">
                <h2 style="font-size: 40px; font-weight: 800; margin-bottom: 16px;">Start your journey</h2>
                <p style="color: #71717a; font-size: 18px;">Choose a language and begin learning today</p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 32px;">
                <!-- Python Card -->
                <div style="background: linear-gradient(180deg, #18181b 0%, #0f0f12 100%); border: 1px solid #27272a; border-radius: 20px; overflow: hidden; transition: all 0.3s;">
                    <div style="padding: 32px; border-bottom: 1px solid #27272a;">
                        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                            <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #3776AB, #FFD43B); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" width="32" height="32" alt="">
                            </div>
                            <div>
                                <h3 style="font-size: 22px; font-weight: 700;">Python</h3>
                                <p style="color: #71717a; font-size: 14px;">15 lessons • Beginner</p>
                            </div>
                        </div>
                        <p style="color: #a1a1aa; line-height: 1.6;">The most beginner-friendly language. Perfect for AI, data science, automation, and web development.</p>
                    </div>
                    <div style="padding: 24px 32px; display: flex; justify-content: space-between; align-items: center;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <span style="color: #71717a; font-size: 14px;">+750 XP</span>
                        </div>
                        <a href="/course/1" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 10px; color: #fff; font-weight: 600; text-decoration: none; font-size: 14px;">
                            Start Course
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
                
                <!-- JavaScript Card -->
                <div style="background: linear-gradient(180deg, #18181b 0%, #0f0f12 100%); border: 1px solid #27272a; border-radius: 20px; overflow: hidden; transition: all 0.3s;">
                    <div style="padding: 32px; border-bottom: 1px solid #27272a;">
                        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                            <div style="width: 56px; height: 56px; background: linear-gradient(135deg, #F7DF1E, #F0DB4F); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" width="32" height="32" alt="">
                            </div>
                            <div>
                                <h3 style="font-size: 22px; font-weight: 700;">JavaScript</h3>
                                <p style="color: #71717a; font-size: 14px;">10 lessons • Beginner</p>
                            </div>
                        </div>
                        <p style="color: #a1a1aa; line-height: 1.6;">The language of the web. Build interactive websites, web apps, and server-side applications.</p>
                    </div>
                    <div style="padding: 24px 32px; display: flex; justify-content: space-between; align-items: center;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <svg width="18" height="18" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <span style="color: #71717a; font-size: 14px;">+500 XP</span>
                        </div>
                        <a href="/course/2" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 10px; color: #fff; font-weight: 600; text-decoration: none; font-size: 14px;">
                            Start Course
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section style="padding: 120px 24px; background: #09090b; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 800px; height: 800px; background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 60%); pointer-events: none;"></div>
        
        <div style="max-width: 700px; margin: 0 auto; text-align: center; position: relative; z-index: 1;">
            <h2 style="font-size: 48px; font-weight: 800; margin-bottom: 20px; line-height: 1.1;">Ready to start coding?</h2>
            <p style="color: #71717a; font-size: 18px; margin-bottom: 40px; line-height: 1.7;">Join thousands of learners who are mastering programming with Shinmen. It's completely free to get started.</p>
            <a href="/register" style="display: inline-flex; align-items: center; gap: 12px; padding: 18px 36px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 14px; color: #fff; font-size: 17px; font-weight: 600; text-decoration: none; transition: all 0.3s; box-shadow: 0 20px 40px rgba(99, 102, 241, 0.3);">
                Get Started Free
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer style="padding: 48px 24px; background: #0c0c0f; border-top: 1px solid #27272a;">
        <div style="max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 24px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #06b6d4, #6366f1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; color: #fff;">S</div>
                <span style="font-weight: 700; font-size: 18px;">Shinmen</span>
            </div>
            <div style="display: flex; gap: 32px;">
                <a href="/courses" style="color: #71717a; text-decoration: none; font-size: 14px;">Tutorials</a>
                <a href="/editor" style="color: #71717a; text-decoration: none; font-size: 14px;">Playground</a>
                <a href="/login" style="color: #71717a; text-decoration: none; font-size: 14px;">Sign In</a>
                <a href="/register" style="color: #71717a; text-decoration: none; font-size: 14px;">Sign Up</a>
            </div>
            <p style="color: #52525b; font-size: 14px;">&copy; <?php echo date('Y'); ?> Shinmen</p>
        </div>
    </footer>
</body>
</html>
