<footer id="footer-section">
    <div class="container">
        <div class="row mb-2 d-flex justify-content-center">
            <div class="col">
            <?php
            if (is_active_sidebar('footer-sidebar-1')) {
                dynamic_sidebar('footer-sidebar-1');
            }
            ?>
            </div>
            <div class="col">
            <?php
            if (is_active_sidebar('footer-sidebar-2')) {
                dynamic_sidebar('footer-sidebar-2');
            }
            ?>
            </div>
            <div class="col">
            <?php
            if (is_active_sidebar('footer-sidebar-3')) {
                dynamic_sidebar('footer-sidebar-3');
            }
            ?>
            </div>
            <div class="col">
            <?php
            if (is_active_sidebar('footer-sidebar-4')) {
                dynamic_sidebar('footer-sidebar-4');
            }
            ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-2 d-flex justify-content-center">
            <div class="col mt-4 mb-4">
            <p class="text-center">&copy; <?php echo date('Y'); ?> My Custom Theme</p>
            </div>
        </div>
    </div>
    
    <?php wp_footer(); ?>
</footer>

</body>
</html>
