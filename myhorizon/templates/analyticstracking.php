<?php

/* 
 * This tracking is page is for adding multiple trackers per page
 * It is a work-around until Yoast GA has a way
 * 
 * Our main tracker is included across all pages via the Yoast plugin
 * DO NOT add our tracking to this page
 * 
 * Use conditional statements to add per page/template etc...
 */
?>

<?php if(is_page(12)) :  //If is the NOTE card page ?> 
<!-- Multiple tracking objects - NOTE - Aurora  -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');
  
  __gaTracker('create', 'UA-50804864-1', 'auto', {'name': 'testTracker'});  // test tracker
  __gaTracker('testTracker.send', 'pageview'); // Send page view for test tracker.
  
  __gaTracker('create', 'UA-61846902-1', 'auto', {'name': 'auroraTracker'});  // Aurora tracker.
  __gaTracker('auroraTracker.send', 'pageview'); // Send page view for Aurora tracker.
  
</script>
<!-- / Multiple tracking objects -->
    <?php else: ?>
    <?php endif; ?>