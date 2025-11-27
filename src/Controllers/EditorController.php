<?php

namespace App\Controllers;

use App\Services\CodeExecutionService;

class EditorController
{
    private CodeExecutionService $codeService;

    public function __construct()
    {
        $this->codeService = new CodeExecutionService();
    }

    public function index(): void
    {
        $languages = $this->codeService->getSupportedLanguages();
        $defaultCode = $this->getDefaultCode('python');
        
        view('editor', [
            'languages' => $languages,
            'defaultLanguage' => 'python',
            'defaultCode' => $defaultCode
        ]);
    }

    public function execute(): void
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        
        $code = $input['code'] ?? '';
        $language = $input['language'] ?? 'python';

        if (empty(trim($code))) {
            echo json_encode(['success' => false, 'error' => 'No code provided']);
            return;
        }

        if (strlen($code) > 50000) {
            echo json_encode(['success' => false, 'error' => 'Code too long (max 50KB)']);
            return;
        }

        $result = $this->codeService->execute($code, $language);
        echo json_encode($result);
    }

    public function tryit(): void
    {
        $code = $_GET['code'] ?? '';
        $language = $_GET['lang'] ?? 'python';
        
        if (empty($code)) {
            $code = $this->getDefaultCode($language);
        }

        view('tryit', [
            'code' => $code,
            'language' => $language,
            'languages' => $this->codeService->getSupportedLanguages()
        ]);
    }

    private function getDefaultCode(string $language): string
    {
        $defaults = [
            'python' => "# Python Example\nprint(\"Hello, World!\")\n\n# Try it yourself!\nx = 5\ny = 10\nprint(f\"Sum: {x + y}\")",
            'javascript' => "// JavaScript Example\nconsole.log(\"Hello, World!\");\n\n// Try it yourself!\nlet x = 5;\nlet y = 10;\nconsole.log(\"Sum: \" + (x + y));",
            'php' => "<?php\n// PHP Example\necho \"Hello, World!\\n\";\n\n// Try it yourself!\n\$x = 5;\n\$y = 10;\necho \"Sum: \" . (\$x + \$y);",
            'java' => "public class Main {\n    public static void main(String[] args) {\n        System.out.println(\"Hello, World!\");\n        \n        // Try it yourself!\n        int x = 5;\n        int y = 10;\n        System.out.println(\"Sum: \" + (x + y));\n    }\n}",
            'c' => "#include <stdio.h>\n\nint main() {\n    printf(\"Hello, World!\\n\");\n    \n    // Try it yourself!\n    int x = 5;\n    int y = 10;\n    printf(\"Sum: %d\\n\", x + y);\n    \n    return 0;\n}",
            'cpp' => "#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << \"Hello, World!\" << endl;\n    \n    // Try it yourself!\n    int x = 5;\n    int y = 10;\n    cout << \"Sum: \" << x + y << endl;\n    \n    return 0;\n}"
        ];

        return $defaults[$language] ?? $defaults['python'];
    }
}
