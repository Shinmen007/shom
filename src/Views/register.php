<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Shinmen</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            min-height: 100vh;
            background: #09090b;
            color: #fafafa;
        }
        
        .page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        
        @media (max-width: 1024px) {
            .page { grid-template-columns: 1fr; }
            .hero-side { display: none; }
        }
        
        /* Hero Side */
        .hero-side {
            position: relative;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: linear-gradient(135deg, #0c0c10 0%, #18181b 100%);
        }
        
        .hero-bg {
            position: absolute;
            inset: 0;
            opacity: 0.4;
        }
        
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
        }
        
        .blob-1 {
            width: 600px;
            height: 600px;
            background: #6366f1;
            top: -200px;
            left: -200px;
        }
        
        .blob-2 {
            width: 500px;
            height: 500px;
            background: #06b6d4;
            bottom: -150px;
            right: -150px;
        }
        
        .blob-3 {
            width: 300px;
            height: 300px;
            background: #8b5cf6;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .hero-content {
            position: relative;
            z-index: 10;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 480px;
            margin: 0 auto;
        }
        
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(99, 102, 241, 0.15);
            border: 1px solid rgba(99, 102, 241, 0.3);
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 13px;
            font-weight: 500;
            color: #a5b4fc;
            width: fit-content;
            margin-bottom: 32px;
        }
        
        .hero-title {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: -0.02em;
        }
        
        .hero-title span {
            background: linear-gradient(135deg, #06b6d4, #6366f1, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .hero-desc {
            font-size: 17px;
            line-height: 1.7;
            color: #a1a1aa;
            margin-bottom: 48px;
        }
        
        .stats {
            display: flex;
            gap: 40px;
        }
        
        .stat h3 {
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, #22d3ee, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat p {
            font-size: 14px;
            color: #71717a;
            margin-top: 4px;
        }
        
        .hero-footer {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .avatars {
            display: flex;
        }
        
        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid #09090b;
            margin-left: -10px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
        }
        
        .avatar:first-child { margin-left: 0; }
        
        .hero-footer p {
            font-size: 14px;
            color: #71717a;
        }
        
        .hero-footer strong {
            color: #fafafa;
        }
        
        /* Form Side */
        .form-side {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #09090b;
        }
        
        .form-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .form-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 48px;
        }
        
        .logo {
            font-size: 20px;
            font-weight: 700;
            color: #fafafa;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .logo-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #06b6d4, #6366f1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 16px;
        }
        
        .login-link {
            font-size: 14px;
            color: #71717a;
        }
        
        .login-link a {
            color: #06b6d4;
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-link a:hover { text-decoration: underline; }
        
        .form-header {
            margin-bottom: 32px;
        }
        
        .form-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .form-header p {
            color: #71717a;
            font-size: 15px;
        }
        
        .social-btns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 24px;
        }
        
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px;
            background: #18181b;
            border: 1px solid #27272a;
            border-radius: 10px;
            color: #fafafa;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .social-btn:hover {
            background: #27272a;
            border-color: #3f3f46;
        }
        
        .social-btn svg { width: 18px; height: 18px; }
        
        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }
        
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #27272a;
        }
        
        .divider span {
            font-size: 13px;
            color: #52525b;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #e4e4e7;
            margin-bottom: 8px;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 14px;
            background: #18181b;
            border: 1px solid #27272a;
            border-radius: 10px;
            color: #fafafa;
            font-size: 15px;
            font-family: inherit;
            outline: none;
            transition: all 0.2s;
        }
        
        .form-input::placeholder { color: #52525b; }
        
        .form-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        
        .password-wrap {
            position: relative;
        }
        
        .toggle-pass {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #52525b;
            cursor: pointer;
            padding: 4px;
        }
        
        .toggle-pass:hover { color: #a1a1aa; }
        
        .strength-meter {
            margin-top: 10px;
        }
        
        .strength-bars {
            display: flex;
            gap: 4px;
            margin-bottom: 6px;
        }
        
        .strength-bar {
            height: 4px;
            flex: 1;
            background: #27272a;
            border-radius: 2px;
            transition: all 0.3s;
        }
        
        .strength-bar.active.weak { background: #ef4444; }
        .strength-bar.active.medium { background: #f59e0b; }
        .strength-bar.active.strong { background: #22c55e; }
        
        .strength-label {
            font-size: 12px;
            color: #52525b;
        }
        
        .strength-label.weak { color: #ef4444; }
        .strength-label.medium { color: #f59e0b; }
        .strength-label.strong { color: #22c55e; }
        
        .terms {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 24px;
        }
        
        .terms input {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            accent-color: #6366f1;
            cursor: pointer;
        }
        
        .terms label {
            font-size: 14px;
            color: #a1a1aa;
            line-height: 1.5;
            cursor: pointer;
        }
        
        .terms a {
            color: #06b6d4;
            text-decoration: none;
        }
        
        .terms a:hover { text-decoration: underline; }
        
        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .submit-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
        }
        
        .form-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 13px;
            color: #52525b;
        }
        
        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .form-side {
                padding: 2rem 1.5rem;
            }
        }
        
        @media (max-width: 640px) {
            .form-side {
                padding: 1.5rem 1rem;
            }
            
            .form-nav {
                flex-direction: column;
                gap: 16px;
                margin-bottom: 32px;
            }
            
            .form-header h1 {
                font-size: 24px;
            }
            
            .social-btns {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="hero-side">
            <div class="hero-bg">
                <div class="blob blob-1"></div>
                <div class="blob blob-2"></div>
                <div class="blob blob-3"></div>
            </div>
            
            <div class="hero-content">
                <div class="hero-badge">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    Free forever - No credit card required
                </div>
                
                <h1 class="hero-title">Start your<br><span>coding journey</span><br>today</h1>
                
                <p class="hero-desc">
                    Learn Python, JavaScript, and more with interactive lessons, 
                    real-time code execution, and personalized progress tracking.
                </p>
                
                <div class="stats">
                    <div class="stat">
                        <h3>10K+</h3>
                        <p>Active learners</p>
                    </div>
                    <div class="stat">
                        <h3>50+</h3>
                        <p>Interactive lessons</p>
                    </div>
                    <div class="stat">
                        <h3>5</h3>
                        <p>Languages</p>
                    </div>
                </div>
            </div>
            
            <div class="hero-footer">
                <div class="avatars">
                    <div class="avatar">JD</div>
                    <div class="avatar">AK</div>
                    <div class="avatar">MR</div>
                    <div class="avatar">+</div>
                </div>
                <p><strong>Join 10,000+</strong> developers learning to code</p>
            </div>
        </div>
        
        <div class="form-side">
            <div class="form-container">
                <nav class="form-nav">
                    <a href="/" class="logo">
                        <div class="logo-icon">S</div>
                        Shinmen
                    </a>
                    <span class="login-link">
                        Have an account? <a href="/login">Sign in</a>
                    </span>
                </nav>
                
                <div class="form-header">
                    <h1>Create your account</h1>
                    <p>Start learning to code in minutes</p>
                </div>
                
                <div class="social-btns">
                    <button type="button" class="social-btn">
                        <svg viewBox="0 0 24 24"><path fill="#EA4335" d="M5.27 9.76A7.08 7.08 0 0 1 12 4.5c1.72 0 3.28.6 4.5 1.6l3.36-3.37A11.95 11.95 0 0 0 12 0C7.39 0 3.4 2.6 1.39 6.41l3.88 3.35Z"/><path fill="#34A853" d="M16.04 18.01A7.5 7.5 0 0 1 12 19.5c-3.25 0-6.02-2.14-6.96-5.1l-3.91 3.25A12 12 0 0 0 12 24c3.05 0 5.85-1.13 7.99-3l-3.95-2.99Z"/><path fill="#4A90E2" d="M19.99 21A11.95 11.95 0 0 0 24 12c0-.83-.08-1.64-.24-2.42H12v4.64h6.73c-.32 1.6-1.18 2.9-2.45 3.78l3.95 2.99.76.01Z"/><path fill="#FBBC05" d="M5.04 14.41A7.05 7.05 0 0 1 4.5 12c0-.84.15-1.64.42-2.4L1.04 6.26A12 12 0 0 0 0 12c0 2.07.53 4.01 1.45 5.72l3.59-3.31Z"/></svg>
                        Google
                    </button>
                    <button type="button" class="social-btn">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        GitHub
                    </button>
                </div>
                
                <div class="divider"><span>or continue with email</span></div>
                
                <form action="/register" method="POST">
                    <div class="form-group">
                        <label class="form-label">Full name</label>
                        <input type="text" name="name" class="form-input" placeholder="Enter your name" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email" class="form-input" placeholder="you@example.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="password-wrap">
                            <input type="password" name="password" id="password" class="form-input" placeholder="Create a password" required minlength="6" oninput="checkStrength(this.value)">
                            <button type="button" class="toggle-pass" onclick="togglePassword()">
                                <svg id="eye-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        <div class="strength-meter">
                            <div class="strength-bars">
                                <div class="strength-bar" id="bar1"></div>
                                <div class="strength-bar" id="bar2"></div>
                                <div class="strength-bar" id="bar3"></div>
                                <div class="strength-bar" id="bar4"></div>
                            </div>
                            <span class="strength-label" id="strength-label">Use 6+ characters</span>
                        </div>
                    </div>
                    
                    <div class="terms">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">I agree to the <a href="#">Terms</a> and <a href="#">Privacy Policy</a></label>
                    </div>
                    
                    <button type="submit" class="submit-btn">Create account</button>
                </form>
                
                <p class="form-footer">
                    By signing up, you agree to receive product updates via email.
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            var input = document.getElementById('password');
            var icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
            }
        }
        
        function checkStrength(password) {
            var bars = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3'), document.getElementById('bar4')];
            var label = document.getElementById('strength-label');
            
            var strength = 0;
            if (password.length >= 6) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password) && /[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            
            var level = password.length === 0 ? 0 : Math.min(strength, 4);
            var cls = level <= 1 ? 'weak' : (level <= 2 ? 'medium' : 'strong');
            var msgs = ['Use 6+ characters', 'Weak password', 'Getting better', 'Good password', 'Strong password'];
            
            bars.forEach(function(bar, i) {
                bar.className = 'strength-bar';
                if (i < level) bar.classList.add('active', cls);
            });
            
            label.className = 'strength-label ' + (level > 0 ? cls : '');
            label.textContent = msgs[level];
        }
    </script>
</body>
</html>
