<?php

// Use [woocommerce_mini_cart] to display content mini cart
add_shortcode('woocommerce_mini_cart','lemon_woocommerce_mini_cart_shortcode_func'); 
function lemon_woocommerce_mini_cart_shortcode_func($atts) {
    extract(shortcode_atts(array(

    ), $atts));
    ob_start();
    ?>
    <div class="widget_shopping_cart_content">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;

}
