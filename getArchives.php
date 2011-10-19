<?php

if (!function_exists('get_my_archives')) {

    function get_my_archives($before = '<li>', $after = '</li>') {
        /** Define ABSPATH as this files directory */
        define('ABSPATH', dirname(__FILE__) . '/../../../');
        include_once(ABSPATH . "wp-config.php");

        $args = array(
        'type' => 'monthly',
        'format' => 'html',
        'show_post_count' => false,
        'echo' => 0 );

        $archives = wp_get_archives($args);
        $output = $archives;
        return $output;
    }

}
?>
