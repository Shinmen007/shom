<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - Shinmen</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <?php 
        $isPython = $course['language'] === 'Python';
        $icon = $isPython ? 'python/python-original' : 'javascript/javascript-original';
        $gradientColors = $isPython ? ['#3776AB', '#FFD43B'] : ['#F7DF1E', '#323330'];
        
        $totalLessons = count($lessons);
        $completedCount = 0;
        if (!empty($progress)) {
            foreach ($progress as $lessonId => $isComplete) {
                if ($isComplete) $completedCount++;
            }
        }
        $progressPercent = $totalLessons > 0 ? round(($completedCount / $totalLessons) * 100) : 0;
    ?>
    <style>
        .course-hero {
            position: relative;
            padding: 100px 24px 60px;
            overflow: hidden;
        }
        
        .hero-bg {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, <?php echo $gradientColors[0]; ?>20 0%, <?php echo $gradientColors[1]; ?>10 100%);
        }
        
        .hero-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(150px);
            opacity: 0.3;
            background: <?php echo $gradientColors[0]; ?>;
            top: -300px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
            font-size: 14px;
        }
        
        .breadcrumb a {
            color: #71717a;
            text-decoration: none;
        }
        
        .breadcrumb a:hover { color: #a1a1aa; }
        .breadcrumb span { color: #52525b; }
        
        .course-header {
            display: flex;
            gap: 24px;
            align-items: flex-start;
        }
        
        @media (max-width: 640px) {
            .course-header { flex-direction: column; align-items: center; text-align: center; }
        }
        
        .course-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, <?php echo $gradientColors[0]; ?>, <?php echo $gradientColors[1]; ?>);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 20px 40px <?php echo $gradientColors[0]; ?>40;
        }
        
        .course-icon img { width: 44px; height: 44px; }
        
        .course-info h1 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 8px;
        }
        
        .course-desc {
            color: #a1a1aa;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            max-width: 600px;
        }
        
        .course-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .meta-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            font-size: 14px;
            color: #a1a1aa;
        }
        
        .meta-badge svg { color: #71717a; }
        
        /* Progress Card */
        .progress-card {
            background: linear-gradient(135deg, #18181b 0%, #0f0f12 100%);
            border: 1px solid #27272a;
            border-radius: 20px;
            padding: 28px;
            margin: -40px auto 40px;
            max-width: 900px;
            position: relative;
            z-index: 20;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 32px;
            align-items: center;
        }
        
        @media (max-width: 640px) {
            .progress-card { grid-template-columns: 1fr; text-align: center; }
        }
        
        .progress-info h3 {
            font-size: 14px;
            font-weight: 500;
            color: #71717a;
            margin-bottom: 8px;
        }
        
        .progress-stats {
            display: flex;
            align-items: baseline;
            gap: 16px;
            margin-bottom: 16px;
        }
        
        @media (max-width: 640px) {
            .progress-stats { justify-content: center; }
        }
        
        .progress-percent {
            font-size: 48px;
            font-weight: 800;
            background: linear-gradient(135deg, #06b6d4, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .progress-detail {
            font-size: 15px;
            color: #71717a;
        }
        
        .progress-bar-wrap {
            background: #27272a;
            border-radius: 10px;
            height: 10px;
            overflow: hidden;
        }
        
        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #06b6d4, #6366f1);
            border-radius: 10px;
            transition: width 0.5s ease;
        }
        
        .btn-continue {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 14px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            white-space: nowrap;
        }
        
        .btn-continue:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
        }
        
        /* Main Content */
        .main-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 24px 80px;
        }
        
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 32px;
        }
        
        @media (max-width: 900px) {
            .content-grid { grid-template-columns: 1fr; }
        }
        
        /* Lessons List */
        .lessons-section h2 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .lessons-list {
            background: #18181b;
            border: 1px solid #27272a;
            border-radius: 16px;
            overflow: hidden;
        }
        
        .lesson-item {
            display: flex;
            align-items: center;
            padding: 18px 20px;
            border-bottom: 1px solid #27272a;
            text-decoration: none;
            color: #fafafa;
            transition: all 0.2s;
        }
        
        .lesson-item:last-child { border-bottom: none; }
        
        .lesson-item:hover {
            background: #27272a;
        }
        
        .lesson-num {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            margin-right: 16px;
            flex-shrink: 0;
        }
        
        .lesson-num.pending {
            background: #27272a;
            color: #71717a;
            border: 2px dashed #3f3f46;
        }
        
        .lesson-num.completed {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: #fff;
        }
        
        .lesson-num.current {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.4);
        }
        
        .lesson-content {
            flex: 1;
            min-width: 0;
        }
        
        .lesson-title {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .lesson-meta {
            font-size: 13px;
            color: #71717a;
        }
        
        .lesson-xp {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: rgba(6, 182, 212, 0.1);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #06b6d4;
            margin-left: 12px;
        }
        
        .lesson-arrow {
            color: #52525b;
            margin-left: 8px;
        }
        
        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        
        .sidebar-card {
            background: #18181b;
            border: 1px solid #27272a;
            border-radius: 16px;
            padding: 24px;
        }
        
        .sidebar-card h3 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .xp-overview {
            text-align: center;
        }
        
        .xp-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.2), rgba(99, 102, 241, 0.1));
            border: 3px solid #06b6d4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        
        .xp-amount {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #06b6d4, #6366f1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .xp-label {
            font-size: 12px;
            color: #71717a;
        }
        
        .xp-breakdown {
            display: flex;
            justify-content: space-around;
            padding-top: 16px;
            border-top: 1px solid #27272a;
        }
        
        .xp-item {
            text-align: center;
        }
        
        .xp-item-value {
            font-size: 18px;
            font-weight: 700;
            color: #fafafa;
        }
        
        .xp-item-label {
            font-size: 12px;
            color: #71717a;
        }
        
        .quiz-promo {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.05));
            border-color: rgba(99, 102, 241, 0.2);
        }
        
        .quiz-promo p {
            color: #a1a1aa;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 16px;
        }
        
        .btn-quiz {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 12px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .btn-quiz:hover {
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }
        
        .features-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: #a1a1aa;
        }
        
        .feature-icon {
            width: 32px;
            height: 32px;
            background: #27272a;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #71717a;
            flex-shrink: 0;
        }
        
        /* Mobile Responsive */
        @media (max-width: 900px) {
            .course-hero {
                padding: 90px 16px 50px;
            }
            
            .course-info h1 {
                font-size: 28px;
            }
            
            .course-meta {
                gap: 12px;
            }
            
            .meta-badge {
                padding: 6px 12px;
                font-size: 13px;
            }
            
            .progress-card {
                margin: -30px 16px 32px;
                padding: 20px;
                gap: 20px;
            }
            
            .progress-percent {
                font-size: 36px;
            }
            
            .progress-detail {
                font-size: 13px;
            }
            
            .btn-continue {
                padding: 14px 24px;
                font-size: 14px;
                width: 100%;
                justify-content: center;
            }
            
            .main-content {
                padding: 0 16px 60px;
            }
            
            .sidebar {
                order: -1;
            }
            
            .lesson-item {
                padding: 14px 16px;
            }
            
            .lesson-num {
                width: 36px;
                height: 36px;
                margin-right: 12px;
            }
            
            .lesson-xp {
                display: none;
            }
        }
        
        @media (max-width: 640px) {
            .course-icon {
                width: 64px;
                height: 64px;
            }
            
            .course-icon img {
                width: 36px;
                height: 36px;
            }
            
            .course-info h1 {
                font-size: 24px;
            }
            
            .course-desc {
                font-size: 14px;
            }
            
            .meta-badge {
                padding: 6px 10px;
                font-size: 12px;
            }
            
            .meta-badge svg {
                display: none;
            }
            
            .breadcrumb {
                font-size: 13px;
            }
            
            .progress-percent {
                font-size: 32px;
            }
            
            .lessons-section h2 {
                font-size: 18px;
            }
            
            .lesson-title {
                font-size: 14px;
            }
            
            .lesson-meta {
                font-size: 12px;
            }
            
            .sidebar-card {
                padding: 20px;
            }
            
            .xp-circle {
                width: 80px;
                height: 80px;
            }
            
            .xp-amount {
                font-size: 22px;
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
                <a href="/register" class="btn btn-signup">Sign Up</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Course Hero -->
    <section class="course-hero">
        <div class="hero-bg">
            <div class="hero-glow"></div>
        </div>
        
        <div class="hero-content">
            <nav class="breadcrumb">
                <a href="/courses">Tutorials</a>
                <span>/</span>
                <span style="color: #fafafa;"><?php echo htmlspecialchars($course['title']); ?></span>
            </nav>
            
            <div class="course-header">
                <div class="course-icon">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/<?php echo $icon; ?>.svg" alt="">
                </div>
                <div class="course-info">
                    <h1><?php echo htmlspecialchars($course['title']); ?></h1>
                    <p class="course-desc"><?php echo htmlspecialchars($course['description']); ?></p>
                    <div class="course-meta">
                        <span class="meta-badge">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            <?php echo $totalLessons; ?> Lessons
                        </span>
                        <span class="meta-badge">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            ~<?php echo $totalLessons * 10; ?> min
                        </span>
                        <span class="meta-badge">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
                            <?php echo htmlspecialchars($course['difficulty']); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Progress Card -->
    <div class="progress-card">
        <div class="progress-info">
            <h3>Your Progress</h3>
            <div class="progress-stats">
                <span class="progress-percent"><?php echo $progressPercent; ?>%</span>
                <span class="progress-detail"><?php echo $completedCount; ?> of <?php echo $totalLessons; ?> lessons completed</span>
            </div>
            <div class="progress-bar-wrap">
                <div class="progress-bar-fill" style="width: <?php echo $progressPercent; ?>%;"></div>
            </div>
        </div>
        
        <?php 
            $nextLessonId = $lessons[0]['id'];
            foreach ($lessons as $lesson) {
                if (empty($progress[$lesson['id']])) {
                    $nextLessonId = $lesson['id'];
                    break;
                }
            }
        ?>
        <a href="/lesson/<?php echo $nextLessonId; ?>" class="btn-continue">
            <?php echo $progressPercent > 0 ? 'Continue Learning' : 'Start Course'; ?>
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-grid">
            <!-- Lessons List -->
            <div class="lessons-section">
                <h2>
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Course Content
                </h2>
                
                <div class="lessons-list">
                    <?php foreach ($lessons as $index => $lesson): 
                        $isCompleted = !empty($progress[$lesson['id']]);
                        $isCurrent = false;
                        if (!$isCompleted) {
                            if ($index === 0 || !empty($progress[$lessons[$index-1]['id']])) {
                                $isCurrent = true;
                            }
                        }
                        $statusClass = $isCompleted ? 'completed' : ($isCurrent ? 'current' : 'pending');
                    ?>
                        <a href="/lesson/<?php echo $lesson['id']; ?>" class="lesson-item">
                            <span class="lesson-num <?php echo $statusClass; ?>">
                                <?php if ($isCompleted): ?>
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                <?php else: ?>
                                    <?php echo $lesson['lesson_order']; ?>
                                <?php endif; ?>
                            </span>
                            <div class="lesson-content">
                                <div class="lesson-title"><?php echo htmlspecialchars($lesson['title']); ?></div>
                                <div class="lesson-meta">Lesson <?php echo $lesson['lesson_order']; ?> • ~10 min</div>
                            </div>
                            <?php if (!$isCompleted): ?>
                                <span class="lesson-xp">+50 XP</span>
                            <?php endif; ?>
                            <svg class="lesson-arrow" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Sidebar -->
            <aside class="sidebar">
                <!-- XP Overview -->
                <div class="sidebar-card">
                    <h3>
                        <svg width="16" height="16" fill="none" stroke="#06b6d4" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        XP Potential
                    </h3>
                    <div class="xp-overview">
                        <div class="xp-circle">
                            <span class="xp-amount"><?php echo $totalLessons * 50; ?></span>
                            <span class="xp-label">Total XP</span>
                        </div>
                        <div class="xp-breakdown">
                            <div class="xp-item">
                                <div class="xp-item-value"><?php echo $completedCount * 50; ?></div>
                                <div class="xp-item-label">Earned</div>
                            </div>
                            <div class="xp-item">
                                <div class="xp-item-value"><?php echo ($totalLessons - $completedCount) * 50; ?></div>
                                <div class="xp-item-label">Remaining</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Quiz Promo -->
                <?php if (isset($_SESSION['user_id'])): ?>
                <div class="sidebar-card quiz-promo">
                    <h3>
                        <svg width="16" height="16" fill="none" stroke="#a855f7" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        Test Your Knowledge
                    </h3>
                    <p>Complete the course quiz to earn bonus XP and unlock achievement badges!</p>
                    <a href="/course/<?php echo $course['id']; ?>/quiz" class="btn-quiz">
                        Take Quiz
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
                <?php endif; ?>
                
                <!-- Course Features -->
                <div class="sidebar-card">
                    <h3>
                        <svg width="16" height="16" fill="none" stroke="#22c55e" stroke-width="2" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        What You'll Learn
                    </h3>
                    <div class="features-list">
                        <div class="feature-item">
                            <span class="feature-icon">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                            </span>
                            Interactive code examples
                        </div>
                        <div class="feature-item">
                            <span class="feature-icon">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/></svg>
                            </span>
                            Real-world exercises
                        </div>
                        <div class="feature-item">
                            <span class="feature-icon">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
                            </span>
                            Progress tracking
                        </div>
                        <div class="feature-item">
                            <span class="feature-icon">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                            </span>
                            Earn badges & XP
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <!-- Footer -->
    <footer style="padding: 40px 24px; border-top: 1px solid #27272a;">
        <div style="max-width: 900px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <a href="/courses" style="display: inline-flex; align-items: center; gap: 8px; color: #71717a; text-decoration: none; font-size: 14px;">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Back to Tutorials
            </a>
            <p style="color: #52525b; font-size: 14px;">&copy; <?php echo date('Y'); ?> Shinmen</p>
        </div>
    </footer>
</body>
</html>
