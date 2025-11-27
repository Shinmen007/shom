<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Shinmen</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 2rem;
        }
        
        @media (max-width: 1024px) {
            .dashboard-grid { grid-template-columns: 1fr; }
        }
        
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-box {
            background: var(--void-card);
            border: 1px solid var(--void-border);
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            text-align: center;
        }
        
        .stat-box .icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .stat-box .value {
            font-size: 1.75rem;
            font-weight: 800;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-box .label {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
        
        .today-card {
            background: linear-gradient(135deg, var(--void-card) 0%, var(--void-surface) 100%);
            border: 1px solid var(--void-border);
            border-radius: var(--radius-xl);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .today-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .today-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        
        .today-stat {
            text-align: center;
            padding: 0.75rem;
            background: var(--void-elevated);
            border-radius: var(--radius-md);
        }
        
        .today-stat .num {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-primary);
        }
        
        .course-progress-card {
            background: var(--void-card);
            border: 1px solid var(--void-border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 1.5rem;
            transition: all 0.2s;
        }
        
        .course-progress-card:hover {
            border-color: var(--void-hover);
            transform: translateY(-2px);
        }
        
        .course-progress-header {
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .course-progress-body {
            padding: 0 1.25rem 1.25rem;
        }
        
        .lesson-dots {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin: 1rem 0;
        }
        
        .lesson-dot {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--void-elevated);
            border: 2px solid var(--void-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            transition: all 0.2s;
        }
        
        .lesson-dot.completed {
            background: var(--success);
            border-color: var(--success);
            color: #000;
        }
        
        .lesson-dot.current {
            border-color: var(--accent-primary);
            color: var(--accent-primary);
            box-shadow: var(--accent-glow);
        }
        
        .sidebar-card {
            background: var(--void-card);
            border: 1px solid var(--void-border);
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }
        
        .sidebar-card h3 {
            font-size: 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .badge-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.5rem;
        }
        
        .badge-item {
            width: 40px;
            height: 40px;
            background: var(--void-elevated);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            position: relative;
        }
        
        .badge-item.locked {
            opacity: 0.3;
            filter: grayscale(1);
        }
        
        .badge-item:not(.locked):hover {
            transform: scale(1.1);
            box-shadow: var(--accent-glow);
        }
        
        .streak-flame {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(239, 68, 68, 0.1) 100%);
            border-radius: var(--radius-md);
            margin-bottom: 1rem;
        }
        
        .streak-flame .num {
            font-size: 2rem;
            font-weight: 800;
            color: var(--warning);
        }
        
        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .quick-action {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: var(--void-elevated);
            border: 1px solid var(--void-border);
            border-radius: var(--radius-md);
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .quick-action:hover {
            background: var(--void-hover);
            border-color: var(--accent-primary);
            color: var(--text-primary);
        }
        
        .activity-chart {
            display: flex;
            align-items: flex-end;
            gap: 0.5rem;
            height: 80px;
            margin-top: 1rem;
        }
        
        .activity-bar {
            flex: 1;
            background: var(--void-elevated);
            border-radius: 4px 4px 0 0;
            min-height: 8px;
            transition: all 0.3s;
        }
        
        .activity-bar:hover {
            background: var(--accent-primary);
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
            <a href="/dashboard" class="nav-link active">Dashboard</a>
            <a href="/logout" class="nav-link">Logout</a>
            <span class="user-badge"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
        </div>
    </nav>

    <div class="lang-bar">
        <a href="/course/1" class="lang-link">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" alt="">
            PYTHON
        </a>
        <a href="/course/2" class="lang-link">
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="">
            JAVASCRIPT
        </a>
    </div>

    <main class="main-content">
        <div style="margin-bottom: 2rem;">
            <h1 style="margin-bottom: 0.25rem;">Welcome back, <span class="text-gradient"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Learner'); ?></span> 👋</h1>
            <p style="color: var(--text-muted);">Track your progress and keep the streak going!</p>
        </div>

        <div class="dashboard-grid">
            <div class="main-column">
                <!-- Today's Progress -->
                <div class="today-card">
                    <div class="today-header">
                        <h2 style="margin: 0; font-size: 1.1rem;">📅 Today's Progress</h2>
                        <span style="color: var(--text-muted); font-size: 0.85rem;"><?php echo date('l, F j'); ?></span>
                    </div>
                    <div class="today-stats">
                        <div class="today-stat">
                            <div class="num"><?php echo $stats['today_progress']['lessons_completed'] ?? 0; ?></div>
                            <div style="color: var(--text-muted); font-size: 0.8rem;">Lessons</div>
                        </div>
                        <div class="today-stat">
                            <div class="num"><?php echo $stats['today_progress']['xp_earned'] ?? 0; ?></div>
                            <div style="color: var(--text-muted); font-size: 0.8rem;">XP Earned</div>
                        </div>
                        <div class="today-stat">
                            <div class="num"><?php echo round(($stats['today_progress']['time_spent_seconds'] ?? 0) / 60); ?></div>
                            <div style="color: var(--text-muted); font-size: 0.8rem;">Minutes</div>
                        </div>
                    </div>
                </div>

                <!-- Stats Overview -->
                <div class="stats-row">
                    <div class="stat-box">
                        <div class="icon">⚡</div>
                        <div class="value"><?php echo $stats['total_xp'] ?? 0; ?></div>
                        <div class="label">Total XP</div>
                    </div>
                    <div class="stat-box">
                        <div class="icon">📖</div>
                        <div class="value"><?php echo $stats['lessons_completed'] ?? 0; ?></div>
                        <div class="label">Lessons Done</div>
                    </div>
                    <div class="stat-box">
                        <div class="icon">🎯</div>
                        <div class="value"><?php echo $stats['quiz_avg_score'] ?? 0; ?>%</div>
                        <div class="label">Quiz Avg</div>
                    </div>
                    <div class="stat-box">
                        <div class="icon">⏱️</div>
                        <div class="value"><?php echo $stats['total_time_minutes'] ?? 0; ?></div>
                        <div class="label">Minutes</div>
                    </div>
                </div>

                <!-- Course Progress -->
                <h2 style="font-size: 1.25rem; margin-bottom: 1rem;">My Courses</h2>

                <?php if (!empty($progressData)): ?>
                    <?php foreach ($progressData as $data): ?>
                        <?php 
                            $isPython = strpos(strtolower($data['course']['language']), 'python') !== false;
                            $icon = $isPython ? 'python/python-original' : 'javascript/javascript-original';
                            $gradient = $isPython ? 'linear-gradient(135deg, #3776AB, #FFD43B)' : 'linear-gradient(135deg, #F7DF1E, #F0DB4F)';
                        ?>
                        <div class="course-progress-card">
                            <div class="course-progress-header" style="background: <?php echo $gradient; ?>;">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/<?php echo $icon; ?>.svg" width="40" height="40" alt="">
                                <div style="flex: 1;">
                                    <h3 style="margin: 0; color: <?php echo $isPython ? '#fff' : '#000'; ?>; font-size: 1.1rem;"><?php echo htmlspecialchars($data['course']['title']); ?></h3>
                                    <span style="font-size: 0.85rem; opacity: 0.8; color: <?php echo $isPython ? '#fff' : '#000'; ?>;">
                                        <?php echo $data['completed_lessons']; ?>/<?php echo $data['total_lessons']; ?> lessons
                                    </span>
                                </div>
                                <span style="font-size: 1.5rem; font-weight: 800; color: <?php echo $isPython ? '#fff' : '#000'; ?>;"><?php echo $data['percentage']; ?>%</span>
                            </div>
                            <div class="course-progress-body">
                                <div class="progress" style="height: 8px; margin: 1rem 0;">
                                    <div class="progress-bar" style="width: <?php echo $data['percentage']; ?>%;"></div>
                                </div>
                                
                                <div class="lesson-dots">
                                    <?php for ($i = 1; $i <= min($data['total_lessons'], 15); $i++): ?>
                                        <?php 
                                            $isCompleted = $i <= $data['completed_lessons'];
                                            $isCurrent = $i == $data['completed_lessons'] + 1;
                                        ?>
                                        <div class="lesson-dot <?php echo $isCompleted ? 'completed' : ($isCurrent ? 'current' : ''); ?>">
                                            <?php echo $isCompleted ? '✓' : $i; ?>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                                
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
                                    <span style="color: var(--text-muted); font-size: 0.85rem;">
                                        <?php if ($data['percentage'] == 100): ?>
                                            🎉 Course completed!
                                        <?php else: ?>
                                            Est. <?php echo round(($data['total_lessons'] - $data['completed_lessons']) * 10); ?> min remaining
                                        <?php endif; ?>
                                    </span>
                                    <a href="/course/<?php echo $data['course']['id']; ?>" class="btn btn-primary btn-sm">
                                        <?php echo $data['percentage'] > 0 ? 'Continue' : 'Start'; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="card" style="text-align: center; padding: 3rem;">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">📚</div>
                        <h3>Start Your Journey</h3>
                        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">Choose a course and begin learning today!</p>
                        <a href="/courses" class="btn btn-primary btn-lg">Browse Tutorials</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="sidebar-column">
                <!-- Streak Card -->
                <div class="sidebar-card">
                    <div class="streak-flame">
                        <span style="font-size: 2rem;">🔥</span>
                        <div>
                            <div class="num"><?php echo $stats['streak_days'] ?? 0; ?></div>
                            <div style="color: var(--text-muted); font-size: 0.85rem;">Day Streak</div>
                        </div>
                    </div>
                    <p style="color: var(--text-muted); font-size: 0.85rem; margin: 0;">
                        <?php if (($stats['streak_days'] ?? 0) > 0): ?>
                            Keep it up! Complete a lesson today to continue your streak.
                        <?php else: ?>
                            Start a streak by completing a lesson today!
                        <?php endif; ?>
                    </p>
                </div>

                <!-- Badges -->
                <div class="sidebar-card">
                    <h3>🏆 Badges</h3>
                    <div class="badge-grid">
                        <?php 
                        $allBadges = [
                            ['id' => 'first_lesson', 'icon' => '🎯'],
                            ['id' => 'five_lessons', 'icon' => '🚀'],
                            ['id' => 'ten_lessons', 'icon' => '📚'],
                            ['id' => 'streak_3', 'icon' => '🔥'],
                            ['id' => 'streak_7', 'icon' => '⚡'],
                            ['id' => 'quiz_master', 'icon' => '🏆'],
                            ['id' => 'xp_100', 'icon' => '💯'],
                            ['id' => 'xp_500', 'icon' => '⭐'],
                        ];
                        $earnedIds = array_column($stats['badges'] ?? [], 'badge_id');
                        foreach ($allBadges as $badge):
                            $earned = in_array($badge['id'], $earnedIds);
                        ?>
                            <div class="badge-item <?php echo !$earned ? 'locked' : ''; ?>" title="<?php echo $badge['id']; ?>">
                                <?php echo $badge['icon']; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 1rem; margin-bottom: 0;">
                        <?php echo count($stats['badges'] ?? []); ?>/<?php echo count($allBadges); ?> badges earned
                    </p>
                </div>

                <!-- Weekly Activity -->
                <div class="sidebar-card">
                    <h3>📊 This Week</h3>
                    <div class="activity-chart">
                        <?php 
                        $weekData = $weeklyActivity ?? [];
                        $maxXp = max(array_column($weekData, 'xp_earned') ?: [1]);
                        for ($i = 0; $i < 7; $i++):
                            $xp = isset($weekData[$i]) ? $weekData[$i]['xp_earned'] : 0;
                            $height = $maxXp > 0 ? ($xp / $maxXp) * 100 : 0;
                        ?>
                            <div class="activity-bar" style="height: <?php echo max(8, $height); ?>%;"></div>
                        <?php endfor; ?>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 0.5rem;">
                        <span style="color: var(--text-dim); font-size: 0.75rem;">Mon</span>
                        <span style="color: var(--text-dim); font-size: 0.75rem;">Sun</span>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="sidebar-card">
                    <h3>⚡ Quick Actions</h3>
                    <div class="quick-actions">
                        <a href="/editor" class="quick-action">
                            <span>💻</span>
                            <span>Open Playground</span>
                        </a>
                        <a href="/courses" class="quick-action">
                            <span>📖</span>
                            <span>Browse Tutorials</span>
                        </a>
                        <a href="/course/1/quiz" class="quick-action">
                            <span>🎯</span>
                            <span>Take a Quiz</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-links">
                <a href="/">Home</a>
                <a href="/courses">Tutorials</a>
                <a href="/editor">Playground</a>
            </div>
            <p class="footer-copy">&copy; <?php echo date('Y'); ?> Shinmen</p>
        </div>
    </footer>
</body>
</html>
