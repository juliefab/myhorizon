<?php
    if (is_tree(33)) { //If is Legal or children of legal
        dynamic_sidebar('legal-sidebar'); 
        
    }
    else {
        dynamic_sidebar('default-sidebar');        
    }
    ?>