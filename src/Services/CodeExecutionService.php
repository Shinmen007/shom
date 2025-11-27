<?php

namespace App\Services;

class CodeExecutionService
{
    private string $pistonUrl = 'https://emkc.org/api/v2/piston/execute';
    private int $timeout = 10;

    private array $languageMap = [
        'python' => ['language' => 'python', 'version' => '3.10.0'],
        'javascript' => ['language' => 'javascript', 'version' => '18.15.0'],
        'php' => ['language' => 'php', 'version' => '8.2.3'],
        'java' => ['language' => 'java', 'version' => '15.0.2'],
        'c' => ['language' => 'c', 'version' => '10.2.0'],
        'cpp' => ['language' => 'c++', 'version' => '10.2.0'],
        'ruby' => ['language' => 'ruby', 'version' => '3.0.1'],
        'go' => ['language' => 'go', 'version' => '1.16.2'],
    ];

    public function execute(string $code, string $language): array
    {
        $language = strtolower(trim($language));
        
        if (!isset($this->languageMap[$language])) {
            return [
                'success' => false,
                'output' => '',
                'error' => "Unsupported language: $language"
            ];
        }

        $langConfig = $this->languageMap[$language];

        $payload = [
            'language' => $langConfig['language'],
            'version' => $langConfig['version'],
            'files' => [
                ['content' => $code]
            ],
            'stdin' => '',
            'args' => [],
            'compile_timeout' => 10000,
            'run_timeout' => 5000,
            'compile_memory_limit' => -1,
            'run_memory_limit' => -1
        ];

        $ch = curl_init($this->pistonUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json'
            ],
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_CONNECTTIMEOUT => 5
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return [
                'success' => false,
                'output' => '',
                'error' => "Connection error: $error"
            ];
        }

        if ($httpCode !== 200) {
            return [
                'success' => false,
                'output' => '',
                'error' => "API error (HTTP $httpCode)"
            ];
        }

        $result = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'success' => false,
                'output' => '',
                'error' => 'Invalid response from execution server'
            ];
        }

        $output = '';
        $errorOutput = '';

        if (isset($result['run'])) {
            $output = $result['run']['stdout'] ?? '';
            $errorOutput = $result['run']['stderr'] ?? '';
            
            if (isset($result['run']['signal']) && $result['run']['signal'] === 'SIGKILL') {
                $errorOutput = "Execution timed out or exceeded memory limit";
            }
        }

        if (isset($result['compile']) && !empty($result['compile']['stderr'])) {
            $errorOutput = "Compilation error:\n" . $result['compile']['stderr'];
        }

        return [
            'success' => empty($errorOutput),
            'output' => trim($output),
            'error' => trim($errorOutput),
            'language' => $language,
            'version' => $langConfig['version']
        ];
    }

    public function getSupportedLanguages(): array
    {
        return array_keys($this->languageMap);
    }

    public function isLanguageSupported(string $language): bool
    {
        return isset($this->languageMap[strtolower($language)]);
    }
}
