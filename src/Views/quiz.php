<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - <?php echo htmlspecialchars($course['title']); ?> - Shinmen</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .quiz-header {
            background: linear-gradient(135deg, var(--void-surface) 0%, var(--void-card) 100%);
            border: 1px solid var(--void-border);
            border-radius: var(--radius-xl);
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .quiz-timer {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--void-elevated);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.1rem;
            color: var(--accent-primary);
        }
        
        .quiz-progress {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .quiz-progress-bar {
            flex: 1;
            height: 8px;
            background: var(--void-elevated);
            border-radius: 4px;
            overflow: hidden;
        }
        
        .quiz-progress-fill {
            height: 100%;
            background: var(--accent-gradient);
            transition: width 0.3s ease;
        }
        
        .quiz-question-card {
            background: var(--void-card);
            border: 1px solid var(--void-border);
            border-radius: var(--radius-xl);
            padding: 2rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .quiz-question-card.answered {
            border-color: var(--accent-primary);
        }
        
        .question-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background: var(--accent-gradient);
            color: #000;
            border-radius: 50%;
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .question-text {
            font-size: 1.15rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }
        
        .quiz-options {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .quiz-option {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            background: var(--void-elevated);
            border: 2px solid var(--void-border);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .quiz-option:hover {
            background: var(--void-hover);
            border-color: var(--text-muted);
        }
        
        .quiz-option input {
            display: none;
        }
        
        .quiz-option .option-marker {
            width: 24px;
            height: 24px;
            border: 2px solid var(--void-border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--text-muted);
            flex-shrink: 0;
            transition: all 0.2s;
        }
        
        .quiz-option input:checked + .option-marker {
            background: var(--accent-gradient);
            border-color: var(--accent-primary);
            color: #000;
        }
        
        .quiz-option input:checked ~ .option-text {
            color: var(--text-primary);
            font-weight: 500;
        }
        
        .quiz-option:has(input:checked) {
            border-color: var(--accent-primary);
            background: rgba(0, 217, 255, 0.1);
        }
        
        .option-text {
            flex: 1;
            color: var(--text-secondary);
        }
        
        .quiz-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--void-border);
        }
        
        .questions-nav {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .q-nav-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--void-elevated);
            border: 2px solid var(--void-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .q-nav-dot.answered {
            background: var(--success);
            border-color: var(--success);
            color: #000;
        }
        
        .q-nav-dot.current {
            border-color: var(--accent-primary);
            box-shadow: var(--accent-glow);
        }
    </style>
</head>
<body>
    <nav class="topnav">
        <div class="topnav-left">
            <a href="/" class="logo">Shin<span>men</span></a>
            <a href="/courses" class="nav-link">Tutorials</a>
        </div>
        <div class="topnav-right">
            <div class="quiz-timer" id="timer">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span id="timer-display">00:00</span>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/dashboard" class="nav-link">Dashboard</a>
            <?php endif; ?>
        </div>
    </nav>

    <main class="main-content" style="max-width: 800px;">
        <div style="margin-bottom: 1.5rem;">
            <a href="/course/<?php echo $course['id']; ?>" style="color: var(--text-muted); display: inline-flex; align-items: center; gap: 0.5rem;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Back to Course
            </a>
        </div>

        <div class="quiz-header">
            <h1 style="margin-bottom: 0.5rem;"><?php echo htmlspecialchars($course['title']); ?> Quiz</h1>
            <p style="color: var(--text-muted); margin-bottom: 1rem;">Test your knowledge • <?php echo count($questions); ?> questions</p>
            
            <div class="quiz-progress">
                <span style="color: var(--text-muted); font-size: 0.9rem;">Progress</span>
                <div class="quiz-progress-bar">
                    <div class="quiz-progress-fill" id="progress-fill" style="width: 0%;"></div>
                </div>
                <span id="progress-text" style="color: var(--accent-primary); font-weight: 600;">0/<?php echo count($questions); ?></span>
            </div>
        </div>
        
        <form action="/course/<?php echo $course['id']; ?>/quiz/submit" method="POST" id="quiz-form">
            <input type="hidden" name="time_taken" id="time-taken" value="0">
            
            <?php foreach ($questions as $index => $q): ?>
                <div class="quiz-question-card" id="q-card-<?php echo $index; ?>">
                    <span class="question-number"><?php echo ($index + 1); ?></span>
                    <p class="question-text"><?php echo htmlspecialchars($q['question']); ?></p>
                    
                    <div class="quiz-options">
                        <?php foreach ($q['options'] as $optIndex => $option): ?>
                            <label class="quiz-option">
                                <input type="radio" 
                                       name="q<?php echo $q['id']; ?>" 
                                       value="<?php echo $optIndex; ?>" 
                                       onchange="markAnswered(<?php echo $index; ?>)"
                                       required>
                                <span class="option-marker"><?php echo chr(65 + $optIndex); ?></span>
                                <span class="option-text"><?php echo htmlspecialchars($option); ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="quiz-footer">
                <div class="questions-nav">
                    <?php for ($i = 0; $i < count($questions); $i++): ?>
                        <div class="q-nav-dot" id="nav-<?php echo $i; ?>" onclick="scrollToQuestion(<?php echo $i; ?>)">
                            <?php echo $i + 1; ?>
                        </div>
                    <?php endfor; ?>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">
                    Submit Quiz
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
            </div>
        </form>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <p class="footer-copy">&copy; <?php echo date('Y'); ?> Shinmen</p>
        </div>
    </footer>

    <script>
        let startTime = Date.now();
        let answeredCount = 0;
        const totalQuestions = <?php echo count($questions); ?>;
        
        // Timer
        function updateTimer() {
            const elapsed = Math.floor((Date.now() - startTime) / 1000);
            const minutes = Math.floor(elapsed / 60).toString().padStart(2, '0');
            const seconds = (elapsed % 60).toString().padStart(2, '0');
            document.getElementById('timer-display').textContent = `${minutes}:${seconds}`;
            document.getElementById('time-taken').value = elapsed;
        }
        setInterval(updateTimer, 1000);
        
        // Mark answered
        function markAnswered(index) {
            const card = document.getElementById(`q-card-${index}`);
            const navDot = document.getElementById(`nav-${index}`);
            
            if (!card.classList.contains('answered')) {
                card.classList.add('answered');
                navDot.classList.add('answered');
                answeredCount++;
                
                // Update progress
                const progress = (answeredCount / totalQuestions) * 100;
                document.getElementById('progress-fill').style.width = `${progress}%`;
                document.getElementById('progress-text').textContent = `${answeredCount}/${totalQuestions}`;
            }
        }
        
        // Scroll to question
        function scrollToQuestion(index) {
            document.getElementById(`q-card-${index}`).scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        
        // Form validation
        document.getElementById('quiz-form').addEventListener('submit', function(e) {
            if (answeredCount < totalQuestions) {
                if (!confirm(`You have only answered ${answeredCount} of ${totalQuestions} questions. Submit anyway?`)) {
                    e.preventDefault();
                }
            }
        });
    </script>
</body>
</html>
