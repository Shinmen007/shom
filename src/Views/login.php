<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Shinmen</title>
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
        
        .signup-link {
            font-size: 14px;
            color: #71717a;
        }
        
        .signup-link a {
            color: #06b6d4;
            text-decoration: none;
            font-weight: 500;
        }
        
        .signup-link a:hover { text-decoration: underline; }
        
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
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        .remember input {
            width: 16px;
            height: 16px;
            accent-color: #6366f1;
        }
        
        .remember span {
            font-size: 14px;
            color: #a1a1aa;
        }
        
        .forgot {
            font-size: 14px;
            color: #06b6d4;
            text-decoration: none;
        }
        
        .forgot:hover { text-decoration: underline; }
        
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
        
        /* Hero Side */
        .hero-side {
            position: relative;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
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
            width: 500px;
            height: 500px;
            background: #06b6d4;
            top: -150px;
            right: -150px;
        }
        
        .blob-2 {
            width: 400px;
            height: 400px;
            background: #6366f1;
            bottom: -100px;
            left: -100px;
        }
        
        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 480px;
            margin: 0 auto;
            text-align: center;
        }
        
        .hero-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #06b6d4, #6366f1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px;
            font-size: 40px;
        }
        
        .hero-title {
            font-size: 40px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 16px;
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
            margin-bottom: 40px;
        }
        
        .tech-icons {
            display: flex;
            justify-content: center;
            gap: 16px;
        }
        
        .tech-icon {
            width: 52px;
            height: 52px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .tech-icon:hover {
            background: rgba(99, 102, 241, 0.15);
            border-color: rgba(99, 102, 241, 0.4);
            transform: translateY(-4px);
        }
        
        .tech-icon img { width: 26px; height: 26px; }
        
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
            
            .form-options {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="form-side">
            <div class="form-container">
                <nav class="form-nav">
                    <a href="/" class="logo">
                        <div class="logo-icon">S</div>
                        Shinmen
                    </a>
                    <span class="signup-link">
                        New here? <a href="/register">Create account</a>
                    </span>
                </nav>
                
                <div class="form-header">
                    <h1>Welcome back</h1>
                    <p>Sign in to continue your learning journey</p>
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
                
                <form action="/login" method="POST">
                    <div class="form-group">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email" class="form-input" placeholder="you@example.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="password-wrap">
                            <input type="password" name="password" id="password" class="form-input" placeholder="Enter your password" required>
                            <button type="button" class="toggle-pass" onclick="togglePassword()">
                                <svg id="eye-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="form-options">
                        <label class="remember">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="submit-btn">Sign in</button>
                </form>
            </div>
        </div>
        
        <div class="hero-side">
            <div class="hero-bg">
                <div class="blob blob-1"></div>
                <div class="blob blob-2"></div>
            </div>
            
            <div class="hero-content">
                <div class="hero-icon">S</div>
                
                <h1 class="hero-title">Learn to code<br><span>interactively</span></h1>
                
                <p class="hero-desc">
                    Master programming with hands-on tutorials, real-time code execution, 
                    and track your progress with XP and achievements.
                </p>
                
                <div class="tech-icons">
                    <div class="tech-icon">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" alt="Python">
                    </div>
                    <div class="tech-icon">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript">
                    </div>
                    <div class="tech-icon">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" alt="React">
                    </div>
                    <div class="tech-icon">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg" alt="Java">
                    </div>
                    <div class="tech-icon">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/cplusplus/cplusplus-original.svg" alt="C++">
                    </div>
                </div>
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
    </script>
</body>
</html>
