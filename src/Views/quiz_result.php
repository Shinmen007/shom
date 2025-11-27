<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results - Shinmen</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .result-card {
            background: var(--void-card);
            border: 1px solid var(--void-border);
            border-radius: var(--radius-xl);
            padding: 3rem;
            text-align: center;
            max-width: 550px;
            margin: 0 auto;
        }
        
        .result-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            animation: popIn 0.5s ease;
        }
        
        @keyframes popIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        
        .result-icon.excellent { background: rgba(16, 185, 129, 0.15); }
        .result-icon.good { background: rgba(245, 158, 11, 0.15); }
        .result-icon.retry { background: rgba(239, 68, 68, 0.15); }
        
        .score-display {
            margin: 2rem 0;
        }
        
        .score-number {
            font-size: 5rem;
            font-weight: 800;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
        }
        
        .score-detail {
            color: var(--text-muted);
            margin-top: 0.5rem;
        }
        
        .stats-row {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 2rem 0;
            padding: 1.5rem;
            background: var(--void-elevated);
            border-radius: var(--radius-lg);
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-item .value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-primary);
        }
        
        .stat-item .label {
            font-size: 0.85rem;
            color: var(--text-muted);
        }
        
        .feedback-message {
            padding: 1rem 1.5rem;
            border-radius: var(--radius-md);
            margin-bottom: 2rem;
        }
        
        .feedback-message.excellent {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: var(--success);
        }
        
        .feedback-message.good {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: var(--warning);
        }
        
        .feedback-message.retry {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: var(--error);
        }
        
        .xp-earned {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--void-elevated);
            padding: 0.75rem 1.5rem;
            border-radius: 20px;
            font-weight: 600;
            color: var(--accent-primary);
            margin-bottom: 2rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .confetti {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <?php if ($percentage >= 80): ?>
    <canvas id="confetti" class="confetti"></canvas>
    <?php endif; ?>
    
    <nav class="topnav">
        <div class="topnav-left">
            <a href="/" class="logo">Shin<span>men</span></a>
            <a href="/courses" class="nav-link">Tutorials</a>
        </div>
        <div class="topnav-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/dashboard" class="nav-link">Dashboard</a>
                <a href="/logout" class="nav-link">Logout</a>
            <?php endif; ?>
        </div>
    </nav>

    <main class="main-content" style="display: flex; align-items: center; justify-content: center; min-height: calc(100vh - 200px);">
        <div class="result-card">
            <?php if ($percentage >= 80): ?>
                <div class="result-icon excellent">🎉</div>
                <h1 style="color: var(--success);">Excellent Work!</h1>
                <div class="feedback-message excellent">
                    You've mastered this material! Great job understanding the concepts.
                </div>
            <?php elseif ($percentage >= 50): ?>
                <div class="result-icon good">👍</div>
                <h1 style="color: var(--warning);">Good Progress!</h1>
                <div class="feedback-message good">
                    You're on the right track. Review the lessons and try again to improve.
                </div>
            <?php else: ?>
                <div class="result-icon retry">📚</div>
                <h1>Keep Learning!</h1>
                <div class="feedback-message retry">
                    No worries! Review the course material and give it another shot.
                </div>
            <?php endif; ?>

            <div class="score-display">
                <div class="score-number"><?php echo $percentage; ?>%</div>
                <div class="score-detail"><?php echo $score; ?> out of <?php echo $total; ?> correct</div>
            </div>
            
            <div class="progress" style="height: 12px; margin-bottom: 2rem;">
                <div class="progress-bar" style="width: <?php echo $percentage; ?>%;"></div>
            </div>
            
            <div class="stats-row">
                <div class="stat-item">
                    <div class="value"><?php echo $score; ?>/<?php echo $total; ?></div>
                    <div class="label">Correct</div>
                </div>
                <div class="stat-item">
                    <div class="value"><?php echo isset($timeTaken) ? gmdate('i:s', $timeTaken) : '--:--'; ?></div>
                    <div class="label">Time</div>
                </div>
                <div class="stat-item">
                    <div class="value"><?php echo $percentage >= 80 ? 'A' : ($percentage >= 60 ? 'B' : ($percentage >= 40 ? 'C' : 'D')); ?></div>
                    <div class="label">Grade</div>
                </div>
            </div>
            
            <div class="xp-earned">
                <span>⚡</span>
                <span>+<?php echo $score * 10; ?> XP earned</span>
            </div>
            
            <div class="action-buttons">
                <a href="/course/<?php echo $courseId; ?>/quiz" class="btn btn-ghost">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 109-9 9.75 9.75 0 00-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                    Retry Quiz
                </a>
                <a href="/course/<?php echo $courseId; ?>" class="btn btn-secondary">Review Course</a>
                <a href="/dashboard" class="btn btn-primary">Dashboard</a>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <p class="footer-copy">&copy; <?php echo date('Y'); ?> Shinmen</p>
        </div>
    </footer>

    <?php if ($percentage >= 80): ?>
    <script>
        // Simple confetti effect
        const canvas = document.getElementById('confetti');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        
        const particles = [];
        const colors = ['#00D9FF', '#7C3AED', '#10B981', '#F59E0B', '#EF4444'];
        
        for (let i = 0; i < 150; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height - canvas.height,
                r: Math.random() * 6 + 2,
                d: Math.random() * 150 + 10,
                color: colors[Math.floor(Math.random() * colors.length)],
                tilt: Math.random() * 10 - 5,
                tiltAngle: 0,
                tiltAngleIncrement: Math.random() * 0.1 + 0.05
            });
        }
        
        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            particles.forEach(p => {
                ctx.beginPath();
                ctx.fillStyle = p.color;
                ctx.arc(p.x + p.tilt, p.y, p.r, 0, Math.PI * 2);
                ctx.fill();
            });
            
            update();
        }
        
        function update() {
            particles.forEach(p => {
                p.tiltAngle += p.tiltAngleIncrement;
                p.y += (Math.cos(p.d) + 3 + p.r / 2) / 2;
                p.tilt = Math.sin(p.tiltAngle) * 15;
                
                if (p.y > canvas.height) {
                    p.y = -10;
                    p.x = Math.random() * canvas.width;
                }
            });
        }
        
        let frames = 0;
        function animate() {
            draw();
            frames++;
            if (frames < 300) {
                requestAnimationFrame(animate);
            } else {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            }
        }
        animate();
    </script>
    <?php endif; ?>
</body>
</html>
