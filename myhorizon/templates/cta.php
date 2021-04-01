<?php if ( //Display nothing if it's these templates/pages
        is_page_template('template-products.php')||
        is_page(31)
        ): ?>  

<?php else: //All other pages and posts get the CTA section ?> 
  <div class="section section-cta section-blue">
    <div>
          <?php dynamic_sidebar('contact-cta'); ?>
    </div>
</div>
<?php endif; ?>