<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try it Yourself - Shinmen</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body { margin: 0; overflow: hidden; background: #000; }
        
        .tryit-container {
            display: flex;
            height: calc(100vh - 64px);
        }
        
        .tryit-editor {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--void-dark);
        }
        
        .tryit-result {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--void-surface);
            border-left: 2px solid var(--accent-primary);
        }
        
        .panel-header {
            background: var(--void-surface);
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--void-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .tryit-textarea {
            flex: 1;
            background: #0a0a0a;
            color: #e4e4e7;
            border: none;
            padding: 1.25rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 14px;
            line-height: 1.7;
            resize: none;
            outline: none;
        }
        
        .result-content {
            flex: 1;
            padding: 1.25rem;
            overflow: auto;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }
        
        .run-area {
            padding: 0.75rem 1rem;
            background: var(--void-surface);
            border-top: 1px solid var(--void-border);
        }
        
        @media (max-width: 768px) {
            .tryit-container { flex-direction: column; }
            .tryit-result { border-left: none; border-top: 2px solid var(--accent-primary); }
        }
    </style>
</head>
<body>
    <nav class="topnav">
        <div class="topnav-left">
            <a href="/" class="logo">Shin<span>men</span></a>
            <span style="color: var(--text-muted); padding: 0 0.5rem;">Try it Yourself</span>
        </div>
        <div class="topnav-right">
            <select id="language-select" style="background: var(--void-elevated); color: var(--text-primary); border: 1px solid var(--void-border); padding: 0.5rem 1rem; border-radius: var(--radius-sm); font-size: 0.9rem;">
                <?php foreach ($languages as $lang): ?>
                    <option value="<?php echo $lang; ?>" <?php echo $lang === $language ? 'selected' : ''; ?>>
                        <?php echo ucfirst($lang); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <a href="/editor" class="nav-link">Full Editor</a>
        </div>
    </nav>

    <div class="tryit-container">
        <div class="tryit-editor">
            <div class="panel-header">
                <span style="display: flex; align-items: center; gap: 0.5rem;">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--accent-primary);"></span>
                    <?php echo ucfirst($language); ?> Code
                </span>
                <button class="btn btn-ghost btn-sm" onclick="resetCode()">Reset</button>
            </div>
            <textarea id="code-input" class="tryit-textarea" spellcheck="false"><?php echo htmlspecialchars($code); ?></textarea>
            <div class="run-area">
                <button class="btn btn-primary btn-block" onclick="runCode()" id="run-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                    <span id="run-text">Run Code</span>
                </button>
            </div>
        </div>
        
        <div class="tryit-result">
            <div class="panel-header">
                <span style="display: flex; align-items: center; gap: 0.5rem;">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--success);"></span>
                    Result
                </span>
                <span id="status" style="font-size: 0.8rem; color: var(--text-muted);">Ready</span>
            </div>
            <div id="result-output" class="result-content">
                <span style="color: var(--text-muted);">Click "Run Code" to see the result...</span>
            </div>
        </div>
    </div>

    <script>
        const originalCode = <?php echo json_encode($code); ?>;
        
        function resetCode() {
            document.getElementById('code-input').value = originalCode;
            document.getElementById('result-output').innerHTML = '<span style="color: var(--text-muted);">Click "Run Code" to see the result...</span>';
            document.getElementById('status').textContent = 'Ready';
            document.getElementById('status').style.color = 'var(--text-muted)';
        }

        async function runCode() {
            const code = document.getElementById('code-input').value;
            const language = document.getElementById('language-select').value;
            const output = document.getElementById('result-output');
            const status = document.getElementById('status');
            const runBtn = document.getElementById('run-btn');
            const runText = document.getElementById('run-text');
            
            runBtn.disabled = true;
            runText.textContent = 'Running...';
            status.textContent = 'Running...';
            status.style.color = 'var(--accent-primary)';
            output.innerHTML = '<span style="color: var(--accent-primary);">⏳ Executing...</span>';

            try {
                const response = await fetch('/api/execute', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ code, language })
                });

                const result = await response.json();
                
                if (result.success) {
                    output.innerHTML = `<pre style="margin: 0; white-space: pre-wrap; color: var(--text-primary);">${escapeHtml(result.output || '(No output)')}</pre>`;
                    status.textContent = '✓ Success';
                    status.style.color = 'var(--success)';
                } else {
                    output.innerHTML = `<pre style="margin: 0; color: var(--error); white-space: pre-wrap;">${escapeHtml(result.error)}</pre>`;
                    status.textContent = '✗ Error';
                    status.style.color = 'var(--error)';
                }
            } catch (error) {
                output.innerHTML = `<span style="color: var(--error);">Error: ${error.message}</span>`;
                status.textContent = '✗ Error';
                status.style.color = 'var(--error)';
            } finally {
                runBtn.disabled = false;
                runText.textContent = 'Run Code';
            }
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        document.getElementById('code-input').addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                const start = this.selectionStart;
                this.value = this.value.substring(0, start) + '    ' + this.value.substring(this.selectionEnd);
                this.selectionStart = this.selectionEnd = start + 4;
            }
        });

        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') runCode();
        });
    </script>
</body>
</html>
