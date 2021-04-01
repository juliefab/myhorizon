<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
  <label class="sr-only"><?php _e('Search for:', 'mht'); ?></label>
  <div class="form-group">
    <label for="filter-by"><i class="fa fa-search"></i></label>
    <input type="search" id="filter-by" value="<?php echo get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('What would you like to know?', 'mht'); ?>">
  </div>
</form>
