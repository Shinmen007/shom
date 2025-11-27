<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Playground - Shinmen</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; overflow: hidden; background: #1a1a2e; }
        
        .playground-container {
            height: calc(100vh - 64px);
            padding: 1.5rem;
            display: flex;
            gap: 1.5rem;
            background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 50%, #16213e 100%);
        }
        
        .mac-window {
            background: #1e1e2e;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05);
        }
        
        .mac-titlebar {
            background: linear-gradient(180deg, #3d3d4d 0%, #2d2d3d 100%);
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid #0a0a0a;
            user-select: none;
        }
        
        .mac-buttons { display: flex; gap: 8px; }
        
        .mac-btn {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            transition: all 0.15s;
        }
        
        .mac-btn.close { background: #ff5f57; }
        .mac-btn.minimize { background: #ffbd2e; }
        .mac-btn.maximize { background: #28c940; }
        .mac-btn:hover { filter: brightness(1.1); transform: scale(1.1); }
        
        .mac-title {
            flex: 1;
            text-align: center;
            font-size: 0.85rem;
            color: #a0a0b0;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .mac-title img { width: 16px; height: 16px; }
        
        .editor-panel { flex: 1; min-width: 0; }
        
        .editor-toolbar {
            background: #252535;
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #333345;
        }
        
        .lang-selector {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #1a1a28;
            border: 1px solid #333345;
            border-radius: 8px;
            padding: 0.4rem 0.75rem;
        }
        
        .lang-selector img { width: 18px; height: 18px; }
        
        .lang-selector select {
            background: transparent;
            border: none;
            color: #e4e4e7;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            outline: none;
            padding-right: 0.5rem;
        }
        
        .lang-selector select option { background: #1e1e2e; }
        
        .toolbar-actions { display: flex; gap: 0.5rem; align-items: center; }
        
        .toolbar-btn {
            background: #333345;
            border: 1px solid #444455;
            color: #a0a0b0;
            padding: 0.4rem 0.75rem;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.2s;
        }
        
        .toolbar-btn:hover { background: #444455; color: #fff; }
        
        .run-btn {
            background: linear-gradient(135deg, #00d9ff 0%, #7c3aed 100%);
            border: none;
            color: #000;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s;
        }
        
        .run-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 20px rgba(0, 217, 255, 0.3); }
        .run-btn:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
        
        .editor-content { flex: 1; display: flex; flex-direction: column; position: relative; }
        
        .line-numbers {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 50px;
            background: #16161e;
            border-right: 1px solid #2a2a3a;
            padding: 1rem 0;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            line-height: 1.7;
            color: #4a4a5a;
            text-align: right;
            padding-right: 12px;
            overflow: hidden;
            user-select: none;
        }
        
        .code-textarea {
            flex: 1;
            background: #0d0d14;
            color: #e4e4e7;
            border: none;
            padding: 1rem 1rem 1rem 60px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            line-height: 1.7;
            resize: none;
            outline: none;
            tab-size: 4;
            white-space: pre;
            overflow-wrap: normal;
            overflow-x: auto;
        }
        
        .editor-footer {
            background: #1a1a28;
            padding: 0.4rem 1rem;
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #6a6a7a;
            border-top: 1px solid #2a2a3a;
        }
        
        .output-panel { width: 420px; flex-shrink: 0; }
        
        .output-content {
            flex: 1;
            background: #0d0d14;
            padding: 1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            line-height: 1.6;
            color: #a0a0b0;
            overflow: auto;
            white-space: pre-wrap;
        }
        
        .output-success { color: #28c940; }
        .output-error { color: #ff5f57; }
        .output-info { color: #00d9ff; }
        
        .output-footer {
            background: #1a1a28;
            padding: 0.5rem 1rem;
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #6a6a7a;
            border-top: 1px solid #2a2a3a;
        }
        
        .status-dot { width: 8px; height: 8px; border-radius: 50%; margin-right: 0.5rem; }
        .status-dot.ready { background: #28c940; }
        .status-dot.running { background: #ffbd2e; animation: pulse 1s infinite; }
        .status-dot.error { background: #ff5f57; }
        
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        
        .templates-sidebar { width: 280px; flex-shrink: 0; }
        .templates-content { flex: 1; overflow-y: auto; padding: 1rem; }
        .template-section { margin-bottom: 1.5rem; }
        .template-section h4 {
            color: #6a6a7a;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .template-card {
            background: #252535;
            border: 1px solid #333345;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .template-card:hover { background: #2a2a3d; border-color: #00d9ff; transform: translateX(4px); }
        .template-card h5 { margin: 0 0 0.25rem; font-size: 0.85rem; color: #e4e4e7; }
        .template-card p { margin: 0; font-size: 0.75rem; color: #6a6a7a; }
        
        .kbd {
            background: #333345;
            border: 1px solid #444455;
            border-radius: 4px;
            padding: 0.15rem 0.4rem;
            font-size: 0.7rem;
            color: #a0a0b0;
        }
        
        @media (max-width: 1200px) { .templates-sidebar { display: none; } }
        @media (max-width: 900px) {
            .playground-container { flex-direction: column; padding: 1rem; }
            .output-panel { width: 100%; height: 250px; }
        }
    </style>
</head>
<body>
    <nav class="topnav">
        <div class="topnav-left">
            <a href="/" class="logo">Shin<span>men</span></a>
            <a href="/courses" class="nav-link">Tutorials</a>
            <a href="/editor" class="nav-link active">Playground</a>
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

    <div class="playground-container">
        <div class="mac-window editor-panel">
            <div class="mac-titlebar">
                <div class="mac-buttons">
                    <button class="mac-btn close" onclick="window.location.href='/'"></button>
                    <button class="mac-btn minimize"></button>
                    <button class="mac-btn maximize"></button>
                </div>
                <div class="mac-title">
                    <img id="title-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" alt="">
                    <span id="file-name">main.py</span>
                </div>
                <div style="width: 52px;"></div>
            </div>
            
            <div class="editor-toolbar">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div class="lang-selector">
                        <img id="lang-icon" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" alt="">
                        <select id="language-select" onchange="changeLanguage(this.value)">
                            <option value="python" selected>Python</option>
                            <option value="javascript">JavaScript</option>
                            <option value="php">PHP</option>
                            <option value="java">Java</option>
                            <option value="c">C</option>
                            <option value="cpp">C++</option>
                        </select>
                    </div>
                    <span style="color: #6a6a7a; font-size: 0.8rem;">
                        <span class="kbd">Ctrl</span> + <span class="kbd">Enter</span> to run
                    </span>
                </div>
                
                <div class="toolbar-actions">
                    <button class="toolbar-btn" onclick="clearEditor()" title="Clear">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                    </button>
                    <button class="toolbar-btn" onclick="resetCode()" title="Reset">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 109-9 9.75 9.75 0 00-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                    </button>
                    <button class="run-btn" onclick="runCode()" id="run-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        <span id="run-text">Run</span>
                    </button>
                </div>
            </div>
            
            <div class="editor-content">
                <div class="line-numbers" id="line-numbers">1</div>
                <textarea id="code-editor" class="code-textarea" spellcheck="false" 
                    oninput="updateLineNumbers()" onscroll="syncScroll()" onkeyup="updateCursor()"
                    onclick="updateCursor()"># Python Playground
print("Hello, World!")

x = 10
y = 5
print(f"Sum: {x + y}")

squares = [i**2 for i in range(5)]
print(f"Squares: {squares}")</textarea>
            </div>
            
            <div class="editor-footer">
                <span id="cursor-pos">Ln 1, Col 1</span>
                <span id="lang-version">Python 3.10</span>
            </div>
        </div>

        <div class="mac-window output-panel">
            <div class="mac-titlebar">
                <div class="mac-buttons">
                    <button class="mac-btn close" onclick="clearOutput()"></button>
                    <button class="mac-btn minimize"></button>
                    <button class="mac-btn maximize"></button>
                </div>
                <div class="mac-title">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="4 17 10 11 4 5"/><line x1="12" y1="19" x2="20" y2="19"/></svg>
                    Output
                </div>
                <div style="width: 52px;"></div>
            </div>
            
            <div class="output-content" id="output"><span class="output-info">// Click Run or press Ctrl+Enter to execute</span>

<span style="color: #6a6a7a;">Ready to run your code!</span></div>
            
            <div class="output-footer">
                <span style="display: flex; align-items: center;">
                    <span class="status-dot ready" id="status-dot"></span>
                    <span id="status-text">Ready</span>
                </span>
                <span id="exec-time"></span>
            </div>
        </div>

        <div class="mac-window templates-sidebar">
            <div class="mac-titlebar">
                <div class="mac-buttons">
                    <button class="mac-btn close"></button>
                    <button class="mac-btn minimize"></button>
                    <button class="mac-btn maximize"></button>
                </div>
                <div class="mac-title">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
                    Templates
                </div>
                <div style="width: 52px;"></div>
            </div>
            
            <div class="templates-content">
                <div class="template-section">
                    <h4>
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" width="14" height="14">
                        Python
                    </h4>
                    <div class="template-card" onclick="loadTemplate('py-hello')">
                        <h5>Hello World</h5>
                        <p>Basic print statement</p>
                    </div>
                    <div class="template-card" onclick="loadTemplate('py-variables')">
                        <h5>Variables & Types</h5>
                        <p>Data types and operations</p>
                    </div>
                    <div class="template-card" onclick="loadTemplate('py-loop')">
                        <h5>For Loops</h5>
                        <p>Iteration examples</p>
                    </div>
                    <div class="template-card" onclick="loadTemplate('py-function')">
                        <h5>Functions</h5>
                        <p>Define and call functions</p>
                    </div>
                </div>
                
                <div class="template-section">
                    <h4>
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" width="14" height="14">
                        JavaScript
                    </h4>
                    <div class="template-card" onclick="loadTemplate('js-hello')">
                        <h5>Hello World</h5>
                        <p>Console output</p>
                    </div>
                    <div class="template-card" onclick="loadTemplate('js-array')">
                        <h5>Array Methods</h5>
                        <p>map, filter, reduce</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var langConfig = {
            python: { icon: 'python/python-original', ext: 'py', version: 'Python 3.10' },
            javascript: { icon: 'javascript/javascript-original', ext: 'js', version: 'Node.js 18' },
            php: { icon: 'php/php-original', ext: 'php', version: 'PHP 8.2' },
            java: { icon: 'java/java-original', ext: 'java', version: 'Java 15' },
            c: { icon: 'c/c-original', ext: 'c', version: 'GCC 10.2' },
            cpp: { icon: 'cplusplus/cplusplus-original', ext: 'cpp', version: 'G++ 10.2' }
        };

        var defaultCodes = {
            python: '# Python Playground\nprint("Hello, World!")\n\nx = 10\ny = 5\nprint(f"Sum: {x + y}")\n\nsquares = [i**2 for i in range(5)]\nprint(f"Squares: {squares}")',
            javascript: '// JavaScript Playground\nconsole.log("Hello, World!");\n\nconst x = 10;\nconst y = 5;\nconsole.log("Sum: " + (x + y));\n\nconst nums = [1, 2, 3, 4, 5];\nconst doubled = nums.map(n => n * 2);\nconsole.log("Doubled:", doubled);',
            php: '<?php\necho "Hello, World!\\n";\n\n$x = 10;\n$y = 5;\necho "Sum: " . ($x + $y) . "\\n";',
            java: 'public class Main {\n    public static void main(String[] args) {\n        System.out.println("Hello, World!");\n        int x = 10;\n        int y = 5;\n        System.out.println("Sum: " + (x + y));\n    }\n}',
            c: '#include <stdio.h>\n\nint main() {\n    printf("Hello, World!\\n");\n    int x = 10;\n    int y = 5;\n    printf("Sum: %d\\n", x + y);\n    return 0;\n}',
            cpp: '#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << "Hello, World!" << endl;\n    int x = 10;\n    int y = 5;\n    cout << "Sum: " << x + y << endl;\n    return 0;\n}'
        };

        var templates = {
            'py-hello': { lang: 'python', code: '# Hello World\nprint("Hello, World!")\n\nname = "Coder"\nprint(f"Welcome, {name}!")' },
            'py-variables': { lang: 'python', code: '# Variables and Types\nname = "Alice"\nage = 25\nheight = 5.7\nis_student = True\n\nprint(f"Name: {name}")\nprint(f"Age: {age}")\nprint(f"Type: {type(age)}")' },
            'py-loop': { lang: 'python', code: '# For Loop\nfor i in range(1, 6):\n    print(i)\n\n# List comprehension\nsquares = [x**2 for x in range(1, 6)]\nprint(squares)' },
            'py-function': { lang: 'python', code: '# Functions\ndef greet(name):\n    return f"Hello, {name}!"\n\ndef add(a, b):\n    return a + b\n\nprint(greet("Alice"))\nprint(add(5, 3))' },
            'js-hello': { lang: 'javascript', code: '// Hello World\nconsole.log("Hello, World!");\n\nconst name = "Coder";\nconsole.log("Welcome, " + name + "!");' },
            'js-array': { lang: 'javascript', code: '// Array Methods\nconst nums = [1, 2, 3, 4, 5];\n\nconst doubled = nums.map(n => n * 2);\nconsole.log("Doubled:", doubled);\n\nconst evens = nums.filter(n => n % 2 === 0);\nconsole.log("Evens:", evens);' }
        };

        function changeLanguage(lang) {
            var config = langConfig[lang] || langConfig.python;
            var iconUrl = 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/' + config.icon + '.svg';
            
            document.getElementById('lang-icon').src = iconUrl;
            document.getElementById('title-icon').src = iconUrl;
            document.getElementById('file-name').textContent = 'main.' + config.ext;
            document.getElementById('lang-version').textContent = config.version;
            document.getElementById('code-editor').value = defaultCodes[lang] || defaultCodes.python;
            
            updateLineNumbers();
            clearOutput();
        }

        function resetCode() {
            var lang = document.getElementById('language-select').value;
            document.getElementById('code-editor').value = defaultCodes[lang] || defaultCodes.python;
            updateLineNumbers();
        }

        function clearEditor() {
            document.getElementById('code-editor').value = '';
            updateLineNumbers();
        }

        function clearOutput() {
            document.getElementById('output').innerHTML = '<span class="output-info">// Output cleared</span>';
            document.getElementById('status-dot').className = 'status-dot ready';
            document.getElementById('status-text').textContent = 'Ready';
            document.getElementById('exec-time').textContent = '';
        }

        function updateLineNumbers() {
            var code = document.getElementById('code-editor').value;
            var lines = code.split('\n').length;
            var lineNums = document.getElementById('line-numbers');
            var nums = [];
            for (var i = 1; i <= lines; i++) { nums.push(i); }
            lineNums.innerHTML = nums.join('<br>');
        }

        function syncScroll() {
            var editor = document.getElementById('code-editor');
            var lineNums = document.getElementById('line-numbers');
            lineNums.scrollTop = editor.scrollTop;
        }

        function updateCursor() {
            var editor = document.getElementById('code-editor');
            var text = editor.value.substring(0, editor.selectionStart);
            var lines = text.split('\n');
            var line = lines.length;
            var col = lines[lines.length - 1].length + 1;
            document.getElementById('cursor-pos').textContent = 'Ln ' + line + ', Col ' + col;
        }

        function escapeHtml(text) {
            var div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function runCode() {
            var code = document.getElementById('code-editor').value;
            var language = document.getElementById('language-select').value;
            var output = document.getElementById('output');
            var runBtn = document.getElementById('run-btn');
            var runText = document.getElementById('run-text');
            var statusDot = document.getElementById('status-dot');
            var statusText = document.getElementById('status-text');
            var execTime = document.getElementById('exec-time');

            if (!code.trim()) {
                output.innerHTML = '<span class="output-error">Error: No code to execute</span>';
                return;
            }

            runBtn.disabled = true;
            runText.textContent = 'Running...';
            statusDot.className = 'status-dot running';
            statusText.textContent = 'Executing...';
            output.innerHTML = '<span class="output-info">Running code...</span>';

            var startTime = Date.now();

            fetch('/api/execute', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ code: code, language: language })
            })
            .then(function(response) {
                if (!response.ok) throw new Error('Server error: ' + response.status);
                return response.json();
            })
            .then(function(result) {
                var elapsed = Date.now() - startTime;
                execTime.textContent = elapsed + 'ms';

                if (result.success) {
                    var outputText = escapeHtml(result.output || '(No output)');
                    output.innerHTML = outputText + '\n\n<span class="output-success">Completed successfully</span>';
                    statusDot.className = 'status-dot ready';
                    statusText.textContent = 'Success';
                } else {
                    output.innerHTML = '<span class="output-error">' + escapeHtml(result.error || 'Unknown error') + '</span>';
                    statusDot.className = 'status-dot error';
                    statusText.textContent = 'Error';
                }
            })
            .catch(function(error) {
                output.innerHTML = '<span class="output-error">Connection error: ' + escapeHtml(error.message) + '</span>';
                statusDot.className = 'status-dot error';
                statusText.textContent = 'Failed';
                execTime.textContent = '';
            })
            .finally(function() {
                runBtn.disabled = false;
                runText.textContent = 'Run';
            });
        }

        function loadTemplate(id) {
            var template = templates[id];
            if (template) {
                document.getElementById('language-select').value = template.lang;
                changeLanguage(template.lang);
                document.getElementById('code-editor').value = template.code;
                updateLineNumbers();
            }
        }

        document.getElementById('code-editor').addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                e.preventDefault();
                var start = this.selectionStart;
                var end = this.selectionEnd;
                this.value = this.value.substring(0, start) + '    ' + this.value.substring(end);
                this.selectionStart = this.selectionEnd = start + 4;
                updateLineNumbers();
            }
        });

        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                runCode();
            }
        });

        updateLineNumbers();
        updateCursor();
    </script>
</body>
</html>
