<?php
/**
 * The template for displaying the footer.
 * *
 * @package myhorizon
 */
?>
<footer role="contentinfo">
    <a href="#" class="back-to-top">Back to top</a>
    <div class="footer-brand">
        <div>
            <div>
                <div class="brand-links">
                    <div>
                        <?php dynamic_sidebar('footer-brand'); ?>
                    </div>
                </div>
                <div class="brand-address"><?php dynamic_sidebar('footer-address'); ?></div>
            </div>
        </div>
    </div>
    <div class="footer-legal">
        <div>
            <div>
                <div class="legal-meta"><?php dynamic_sidebar('footer-legal'); ?></div>
            </div>
        </div>
    </div>
</footer>
    
<?php wp_footer(); ?>
