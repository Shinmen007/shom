<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorials - Shinmen</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .page-hero {
            position: relative;
            padding: 120px 24px 80px;
            overflow: hidden;
        }
        
        .hero-bg {
            position: absolute;
            inset: 0;
        }
        
        .hero-gradient {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.4;
        }
        
        .gradient-1 {
            width: 600px;
            height: 600px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            top: -300px;
            left: -100px;
        }
        
        .gradient-2 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #06b6d4, #0ea5e9);
            bottom: -100px;
            right: -100px;
        }
        
        .grid-pattern {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(ellipse at 50% 0%, black 30%, transparent 70%);
        }
        
        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 13px;
            font-weight: 500;
            color: #a5b4fc;
            margin-bottom: 20px;
        }
        
        .hero-title {
            font-size: clamp(36px, 5vw, 56px);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 16px;
        }
        
        .hero-title span {
            background: linear-gradient(135deg, #06b6d4, #6366f1, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .hero-desc {
            font-size: 18px;
            color: #a1a1aa;
            max-width: 600px;
            margin: 0 auto 32px;
            line-height: 1.7;
        }
        
        .search-box {
            max-width: 500px;
            margin: 0 auto;
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 16px 20px 16px 52px;
            background: #18181b;
            border: 1px solid #27272a;
            border-radius: 14px;
            color: #fafafa;
            font-size: 16px;
            outline: none;
            transition: all 0.2s;
        }
        
        .search-input::placeholder { color: #52525b; }
        .search-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }
        
        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #52525b;
        }
        
        /* Language Filter */
        .lang-filter {
            display: flex;
            justify-content: center;
            gap: 12px;
            padding: 24px;
            flex-wrap: wrap;
        }
        
        .lang-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            background: #18181b;
            border: 1px solid #27272a;
            border-radius: 12px;
            color: #a1a1aa;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .lang-btn:hover {
            background: #27272a;
            color: #fafafa;
        }
        
        .lang-btn.active {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(139, 92, 246, 0.1));
            border-color: rgba(99, 102, 241, 0.4);
            color: #a5b4fc;
        }
        
        .lang-btn img { width: 20px; height: 20px; }
        
        /* Course Cards */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
            gap: 28px;
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 24px;
        }
        
        .course-card {
            background: linear-gradient(180deg, #18181b 0%, #0f0f12 100%);
            border: 1px solid #27272a;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .course-card:hover {
            border-color: #3f3f46;
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        
        .card-header {
            padding: 32px 28px 24px;
            position: relative;
        }
        
        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }
        
        .card-python .card-header::before {
            background: linear-gradient(90deg, #3776AB, #FFD43B);
        }
        
        .card-javascript .card-header::before {
            background: linear-gradient(90deg, #F7DF1E, #F0DB4F);
        }
        
        .card-logo {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .card-python .card-logo { background: linear-gradient(135deg, rgba(55, 118, 171, 0.2), rgba(255, 212, 59, 0.1)); }
        .card-javascript .card-logo { background: rgba(247, 223, 30, 0.15); }
        
        .card-logo img { width: 36px; height: 36px; }
        
        .card-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .card-desc {
            color: #a1a1aa;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .card-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .card-tag {
            padding: 6px 12px;
            background: #27272a;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            color: #a1a1aa;
        }
        
        .card-footer {
            padding: 20px 28px;
            border-top: 1px solid #27272a;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-meta {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #71717a;
        }
        
        .btn-start {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 10px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .btn-start:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
        }
        
        /* Coming Soon Section */
        .coming-soon {
            max-width: 1100px;
            margin: 0 auto;
            padding: 60px 24px 80px;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .section-desc {
            color: #71717a;
            font-size: 16px;
        }
        
        .coming-grid {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        
        .coming-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 24px;
            background: #18181b;
            border: 1px solid #27272a;
            border-radius: 14px;
            opacity: 0.6;
            transition: all 0.2s;
        }
        
        .coming-item:hover {
            opacity: 0.8;
            border-color: #3f3f46;
        }
        
        .coming-item img { width: 28px; height: 28px; }
        
        .coming-name {
            font-weight: 500;
            color: #a1a1aa;
        }
        
        .soon-badge {
            font-size: 11px;
            padding: 3px 10px;
            background: #27272a;
            border-radius: 100px;
            color: #71717a;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .page-hero {
                padding: 100px 16px 60px;
            }
            
            .hero-title {
                font-size: 32px;
            }
            
            .hero-desc {
                font-size: 16px;
            }
            
            .search-box {
                max-width: 100%;
            }
            
            .lang-filter {
                padding: 16px;
                gap: 8px;
            }
            
            .lang-btn {
                padding: 10px 16px;
                font-size: 13px;
            }
            
            .courses-grid {
                grid-template-columns: 1fr;
                padding: 24px 16px;
                gap: 20px;
            }
            
            .card-header {
                padding: 24px 20px 20px;
            }
            
            .card-title {
                font-size: 20px;
            }
            
            .card-desc {
                font-size: 14px;
            }
            
            .card-footer {
                padding: 16px 20px;
                flex-direction: column;
                gap: 16px;
            }
            
            .card-meta {
                width: 100%;
                justify-content: center;
            }
            
            .btn-start {
                width: 100%;
                justify-content: center;
            }
            
            .coming-soon {
                padding: 40px 16px 60px;
            }
            
            .section-title {
                font-size: 24px;
            }
            
            .coming-grid {
                gap: 12px;
            }
            
            .coming-item {
                padding: 12px 16px;
            }
        }
        
        @media (max-width: 480px) {
            .hero-title {
                font-size: 28px;
            }
            
            .lang-btn span {
                display: none;
            }
            
            .lang-btn {
                padding: 10px 12px;
            }
        }
    </style>
</head>
<body>
    <nav class="topnav">
        <div class="topnav-left">
            <a href="/" class="logo">Shin<span>men</span></a>
            <a href="/courses" class="nav-link active">Tutorials</a>
            <a href="/editor" class="nav-link">Playground</a>
        </div>
        <div class="topnav-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/dashboard" class="nav-link">Dashboard</a>
                <a href="/logout" class="nav-link">Logout</a>
            <?php else: ?>
                <a href="/login" class="nav-link">Log In</a>
                <a href="/register" class="btn btn-signup">Sign Up</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="hero-bg">
            <div class="hero-gradient gradient-1"></div>
            <div class="hero-gradient gradient-2"></div>
            <div class="grid-pattern"></div>
        </div>
        
        <div class="hero-content">
            <div class="hero-badge">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                Interactive Learning
            </div>
            <h1 class="hero-title">Master <span>Programming</span></h1>
            <p class="hero-desc">Choose from our curated courses and learn at your own pace with hands-on coding exercises and real-world projects.</p>
            
            <div class="search-box">
                <svg class="search-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" class="search-input" placeholder="Search courses..." id="searchInput">
            </div>
        </div>
    </section>

    <!-- Language Filter -->
    <div class="lang-filter">
        <button class="lang-btn active" data-filter="all">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            All Courses
        </button>
        <button class="lang-btn" data-filter="python">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" alt="">
            Python
        </button>
        <button class="lang-btn" data-filter="javascript">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="">
            JavaScript
        </button>
    </div>

    <!-- Course Cards -->
    <div class="courses-grid">
        <?php if (empty($courses)): ?>
            <div style="grid-column: 1/-1; text-align: center; padding: 60px 24px; background: #18181b; border-radius: 16px; border: 1px solid #27272a;">
                <p style="color: #71717a; font-size: 16px;">No courses available yet. Check back soon!</p>
            </div>
        <?php else: ?>
            <?php foreach ($courses as $course): ?>
                <?php 
                    $isPython = $course['language'] === 'Python';
                    $icon = $isPython ? 'python/python-original' : 'javascript/javascript-original';
                    $cardClass = $isPython ? 'card-python' : 'card-javascript';
                    $langFilter = strtolower($course['language']);
                ?>
                <div class="course-card <?php echo $cardClass; ?>" data-lang="<?php echo $langFilter; ?>">
                    <div class="card-header">
                        <div class="card-logo">
                            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/<?php echo $icon; ?>.svg" alt="">
                        </div>
                        <h3 class="card-title"><?php echo htmlspecialchars($course['title']); ?></h3>
                        <p class="card-desc"><?php echo htmlspecialchars($course['description']); ?></p>
                        <div class="card-tags">
                            <span class="card-tag"><?php echo htmlspecialchars($course['difficulty']); ?></span>
                            <span class="card-tag"><?php echo $isPython ? 'Data Science' : 'Web Dev'; ?></span>
                            <span class="card-tag">Interactive</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="card-meta">
                            <span class="meta-item">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                <?php echo $isPython ? '15' : '10'; ?> lessons
                            </span>
                            <span class="meta-item">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                ~<?php echo $isPython ? '3' : '2'; ?>h
                            </span>
                        </div>
                        <a href="/course/<?php echo $course['id']; ?>" class="btn-start">
                            Start
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Coming Soon -->
    <section class="coming-soon">
        <div class="section-header">
            <h2 class="section-title">More Coming Soon</h2>
            <p class="section-desc">We're expanding our course library with new languages and frameworks</p>
        </div>
        
        <div class="coming-grid">
            <?php
            $upcoming = [
                ['name' => 'TypeScript', 'icon' => 'typescript/typescript-original'],
                ['name' => 'React', 'icon' => 'react/react-original'],
                ['name' => 'Node.js', 'icon' => 'nodejs/nodejs-original'],
                ['name' => 'Go', 'icon' => 'go/go-original-wordmark'],
                ['name' => 'Rust', 'icon' => 'rust/rust-original'],
                ['name' => 'Java', 'icon' => 'java/java-original'],
            ];
            foreach ($upcoming as $lang):
            ?>
            <div class="coming-item">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/<?php echo $lang['icon']; ?>.svg" alt="">
                <span class="coming-name"><?php echo $lang['name']; ?></span>
                <span class="soon-badge">Soon</span>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer style="padding: 40px 24px; border-top: 1px solid #27272a;">
        <div style="max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <div style="width: 28px; height: 28px; background: linear-gradient(135deg, #06b6d4, #6366f1); border-radius: 6px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 12px; color: #fff;">S</div>
                <span style="font-weight: 600;">Shinmen</span>
            </div>
            <p style="color: #52525b; font-size: 14px;">&copy; <?php echo date('Y'); ?> Shinmen. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Filter functionality
        document.querySelectorAll('.lang-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                document.querySelectorAll('.course-card').forEach(card => {
                    if (filter === 'all' || card.dataset.lang === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
        
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('.course-card').forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                const desc = card.querySelector('.card-desc').textContent.toLowerCase();
                if (title.includes(query) || desc.includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
