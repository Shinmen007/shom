    </main>
    
    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-links">
                <a href="/">Home</a>
                <a href="/courses">Tutorials</a>
                <a href="/editor">Code Editor</a>
            </div>
            <p class="footer-copy">&copy; <?php echo date('Y'); ?> Shinmen. Learn to code interactively.</p>
        </div>
    </footer>
    
    <?php if (isset($extraJs)): ?>
        <?php foreach ($extraJs as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
