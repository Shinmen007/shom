<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - ' : ''; ?>Shinmen</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <?php if (isset($extraCss)): ?>
        <?php foreach ($extraCss as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <nav class="topnav">
        <div class="topnav-left">
            <a href="/" class="logo">Shin<span>men</span></a>
            <a href="/courses" class="nav-link">Tutorials</a>
            <a href="/editor" class="nav-link">Try It</a>
            <a href="/courses" class="nav-link hide-sm">Exercises</a>
        </div>
        <div class="topnav-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/dashboard" class="nav-link">Dashboard</a>
                <a href="/logout" class="nav-link">Logout</a>
                <span class="user-badge"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
            <?php else: ?>
                <a href="/login" class="nav-link">Log In</a>
                <a href="/register" class="btn btn-signup">Sign Up</a>
            <?php endif; ?>
        </div>
    </nav>
    
    <?php if (isset($showLanguageBar) && $showLanguageBar): ?>
    <div class="lang-bar">
        <a href="/course/1" class="lang-link <?php echo (isset($currentLang) && $currentLang === 'Python') ? 'active' : ''; ?>">PYTHON</a>
        <a href="/course/2" class="lang-link <?php echo (isset($currentLang) && $currentLang === 'JavaScript') ? 'active' : ''; ?>">JAVASCRIPT</a>
        <a href="/courses" class="lang-link">HTML</a>
        <a href="/courses" class="lang-link">CSS</a>
        <a href="/courses" class="lang-link">SQL</a>
        <a href="/courses" class="lang-link hide-sm">PHP</a>
        <a href="/courses" class="lang-link hide-sm">JAVA</a>
    </div>
    <?php endif; ?>
    
    <main class="main-content <?php echo isset($fullWidth) && $fullWidth ? 'full-width' : ''; ?>">
