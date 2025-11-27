<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($lesson['title']); ?> - Shinmen</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <?php 
        $isPython = isset($course) && $course['language'] === 'Python';
        $langIcon = $isPython ? 'python/python-original' : 'javascript/javascript-original';
        $langName = $isPython ? 'Python' : 'JavaScript';
        $langCode = $isPython ? 'python' : 'javascript';
    ?>
    <style>
        body { overflow: hidden; height: 100vh; display: flex; flex-direction: column; }
        
        .lesson-container {
            display: flex;
            flex: 1;
            overflow: hidden;
        }
        
        .lesson-sidebar {
            width: 420px;
            background: var(--void-dark);
            border-right: 1px solid var(--void-border);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        
        .sidebar-header {
            background: var(--void-surface);
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--void-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }
        
        .lesson-title {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--void-border);
        }
        
        .lesson-text {
            color: var(--text-secondary);
            line-height: 1.8;
        }
        
        .lesson-text h2 { font-size: 1.1rem; margin-top: 1.5rem; color: var(--text-primary); }
        .lesson-text code { 
            background: var(--void-elevated); 
            padding: 0.15rem 0.4rem; 
            border-radius: 4px; 
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9em;
            color: var(--accent-primary);
        }
        .lesson-text pre {
            background: var(--void-surface);
            border: 1px solid var(--void-border);
            border-radius: var(--radius-md);
            padding: 1rem;
            overflow-x: auto;
            margin: 1rem 0;
        }
        .lesson-text pre code {
            background: none;
            padding: 0;
            color: var(--text-secondary);
        }
        
        .xp-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(0,217,255,0.1);
            color: var(--accent-primary);
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .challenge-box {
            background: linear-gradient(135deg, rgba(0, 217, 255, 0.1), rgba(124, 58, 237, 0.1));
            border: 1px solid rgba(0, 217, 255, 0.3);
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            margin-top: 1.5rem;
        }
        
        .challenge-box h4 {
            color: var(--accent-primary);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--void-border);
            background: var(--void-surface);
        }
        
        .lesson-nav {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .lesson-nav a {
            flex: 1;
            padding: 0.5rem;
            text-align: center;
            background: var(--void-elevated);
            border: 1px solid var(--void-border);
            border-radius: var(--radius-md);
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.2s;
        }
        
        .lesson-nav a:hover {
            background: var(--void-hover);
            color: var(--text-primary);
            border-color: var(--accent-primary);
        }
        
        .editor-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--void-black);
        }
        
        .editor-header {
            background: var(--void-surface);
            padding: 0.6rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--void-border);
        }
        
        .code-textarea {
            flex: 1;
            background: #0a0a0a;
            color: #e4e4e7;
            border: none;
            padding: 1.25rem;
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 14px;
            line-height: 1.7;
            resize: none;
            outline: none;
            tab-size: 4;
        }
        
        .output-area {
            height: 180px;
            background: var(--void-surface);
            border-top: 2px solid var(--accent-primary);
            display: flex;
            flex-direction: column;
        }
        
        .output-header {
            background: var(--void-elevated);
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0.1em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .output-content {
            flex: 1;
            padding: 1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            color: var(--text-secondary);
            overflow-y: auto;
            white-space: pre-wrap;
        }
        
        .status-success { color: var(--success); }
        .status-error { color: var(--error); }
        
        .completed-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        @media (max-width: 900px) {
            .lesson-container { flex-direction: column; }
            .lesson-sidebar { width: 100%; max-height: 45vh; }
        }
    </style>
</head>
<body>
    <nav class="topnav">
        <div class="topnav-left">
            <a href="/course/<?php echo $lesson['course_id']; ?>" class="nav-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Back
            </a>
            <span style="color: var(--void-border);">|</span>
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/<?php echo $langIcon; ?>.svg" width="18" height="18" alt="">
            <span style="color: var(--text-primary); font-weight: 500;">
                Lesson <?php echo $currentIndex ?? $lesson['lesson_order']; ?> of <?php echo $totalLessons ?? '?'; ?>
            </span>
        </div>
        <div class="topnav-right">
            <?php if (!empty($isCompleted)): ?>
                <span class="completed-badge">✓ Completed</span>
            <?php endif; ?>
            <a href="/editor" class="nav-link">Full Editor</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/dashboard" class="nav-link">Dashboard</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="lesson-container">
        <div class="lesson-sidebar">
            <div class="sidebar-header">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <span style="background: var(--accent-gradient); color: #000; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">
                        <?php echo $lesson['lesson_order']; ?>
                    </span>
                    <span style="color: var(--text-secondary); font-size: 0.9rem;"><?php echo $langName; ?></span>
                </div>
                <span class="xp-indicator">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    +50 XP
                </span>
            </div>
            
            <div class="sidebar-content">
                <h1 class="lesson-title"><?php echo htmlspecialchars($lesson['title']); ?></h1>
                
                <div class="lesson-text">
                    <?php 
                        // Parse markdown-like content
                        $content = $lesson['content'];
                        $content = preg_replace('/^## (.+)$/m', '<h2>$1</h2>', $content);
                        $content = preg_replace('/`([^`]+)`/', '<code>$1</code>', $content);
                        $content = preg_replace('/```(\w+)?\n([\s\S]*?)```/m', '<pre><code>$2</code></pre>', $content);
                        echo nl2br($content);
                    ?>
                </div>
                
                <?php if ($exercise): ?>
                <div class="challenge-box">
                    <h4>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                        Your Challenge
                    </h4>
                    <p style="margin: 0; color: var(--text-secondary); line-height: 1.6;">
                        <?php echo htmlspecialchars($exercise['instructions']); ?>
                    </p>
                    <input type="hidden" id="expected-output" value="<?php echo htmlspecialchars($exercise['expected_output']); ?>">
                </div>
                <?php endif; ?>
            </div>
            
            <div class="sidebar-footer">
                <div class="lesson-nav">
                    <?php if (!empty($prevLesson)): ?>
                        <a href="/lesson/<?php echo $prevLesson['id']; ?>">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                            Previous
                        </a>
                    <?php else: ?>
                        <span style="flex: 1;"></span>
                    <?php endif; ?>
                    
                    <?php if (!empty($nextLesson)): ?>
                        <a href="/lesson/<?php echo $nextLesson['id']; ?>">
                            Next
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
                
                <form action="/lesson/<?php echo $lesson['id']; ?>/complete" method="POST" style="display: inline; width: 100%;">
                    <button type="submit" id="complete-btn" class="btn btn-primary btn-block" style="<?php echo empty($isCompleted) ? 'display: none;' : ''; ?>">
                        <?php if (!empty($nextLesson)): ?>
                            Complete & Continue
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        <?php else: ?>
                            Complete & Take Quiz
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php endif; ?>
                    </button>
                </form>
                <p id="pending-msg" style="color: var(--text-muted); text-align: center; margin: 0; font-size: 0.85rem; <?php echo !empty($isCompleted) ? 'display: none;' : ''; ?>">
                    ✨ Complete the challenge to earn XP
                </p>
            </div>
        </div>

        <div class="editor-area">
            <div class="editor-header">
                <span style="color: var(--text-muted); font-size: 0.85rem; display: flex; align-items: center; gap: 0.5rem;">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/<?php echo $langIcon; ?>.svg" width="16" height="16" alt="">
                    main.<?php echo $isPython ? 'py' : 'js'; ?>
                </span>
                <div style="display: flex; gap: 0.5rem; align-items: center;">
                    <span style="color: var(--text-dim); font-size: 0.8rem;">Ctrl+Enter to run</span>
                    <button class="btn btn-ghost btn-sm" onclick="resetCode()">Reset</button>
                    <button class="btn btn-primary btn-sm" onclick="runCode()" id="run-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        <span id="run-text">Run</span>
                    </button>
                </div>
            </div>
            
            <textarea id="code-editor" class="code-textarea" spellcheck="false"><?php echo htmlspecialchars($exercise['starter_code'] ?? '# Write your code here'); ?></textarea>
            
            <div class="output-area">
                <div class="output-header">
                    <span style="display: flex; align-items: center; gap: 0.5rem;">
                        <span id="output-indicator" style="width: 8px; height: 8px; border-radius: 50%; background: var(--text-muted);"></span>
                        OUTPUT
                    </span>
                    <span id="exec-time" style="font-size: 0.75rem; color: var(--text-dim);"></span>
                </div>
                <div id="output" class="output-content">
                    <span style="color: var(--text-muted);">// Click "Run" or press Ctrl+Enter to execute your code</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        const originalCode = <?php echo json_encode($exercise['starter_code'] ?? ''); ?>;
        const expectedOutput = document.getElementById('expected-output')?.value || null;
        const language = '<?php echo $langCode; ?>';
        
        function resetCode() {
            document.getElementById('code-editor').value = originalCode;
            document.getElementById('output').innerHTML = '<span style="color: var(--text-muted);">// Code reset. Click "Run" to execute.</span>';
            document.getElementById('output-indicator').style.background = 'var(--text-muted)';
            document.getElementById('exec-time').textContent = '';
        }

        async function runCode() {
            const code = document.getElementById('code-editor').value;
            const output = document.getElementById('output');
            const runBtn = document.getElementById('run-btn');
            const runText = document.getElementById('run-text');
            const indicator = document.getElementById('output-indicator');
            const execTime = document.getElementById('exec-time');
            
            runBtn.disabled = true;
            runText.textContent = 'Running...';
            indicator.style.background = 'var(--warning)';
            output.innerHTML = '<span style="color: var(--accent-primary);">⏳ Executing...</span>';
            
            const startTime = Date.now();

            try {
                const response = await fetch('/api/execute', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ code, language })
                });

                const result = await response.json();
                const elapsed = Date.now() - startTime;
                execTime.textContent = `${elapsed}ms`;
                
                if (result.success) {
                    const outputText = result.output || '(No output)';
                    output.innerHTML = `<pre style="margin: 0; white-space: pre-wrap; color: var(--text-primary);">${escapeHtml(outputText)}</pre>`;
                    indicator.style.background = 'var(--success)';
                    
                    if (expectedOutput) {
                        output.innerHTML += '<hr style="border-color: var(--void-border); margin: 1rem 0;">';
                        
                        if (outputText.trim() === expectedOutput.trim()) {
                            output.innerHTML += '<div class="status-success" style="font-weight: 600;">✓ Correct! Your output matches the expected result.</div>';
                            document.getElementById('complete-btn').style.display = 'flex';
                            document.getElementById('pending-msg').style.display = 'none';
                        } else {
                            output.innerHTML += '<div class="status-error">✗ Output does not match expected result.</div>';
                            output.innerHTML += '<div style="color: var(--text-muted); margin-top: 0.5rem;">Expected: <code style="color: var(--accent-primary);">' + escapeHtml(expectedOutput) + '</code></div>';
                            indicator.style.background = 'var(--error)';
                        }
                    } else {
                        document.getElementById('complete-btn').style.display = 'flex';
                        document.getElementById('pending-msg').style.display = 'none';
                    }
                } else {
                    output.innerHTML = `<pre style="margin: 0; color: var(--error); white-space: pre-wrap;">${escapeHtml(result.error)}</pre>`;
                    indicator.style.background = 'var(--error)';
                }
            } catch (error) {
                output.innerHTML = `<span class="status-error">Connection error: ${error.message}</span>`;
                indicator.style.background = 'var(--error)';
            } finally {
                runBtn.disabled = false;
                runText.textContent = 'Run';
            }
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Tab support
        document.getElementById('code-editor').addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                const start = this.selectionStart;
                this.value = this.value.substring(0, start) + '    ' + this.value.substring(this.selectionEnd);
                this.selectionStart = this.selectionEnd = start + 4;
            }
        });

        // Ctrl+Enter to run
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') runCode();
        });
    </script>
</body>
</html>
