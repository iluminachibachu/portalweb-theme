    <footer class="site-footer">
        <div class="container">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
            
            <div class="site-info">
                <p>
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
                    All rights reserved.
                </p>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ]);
                ?>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>