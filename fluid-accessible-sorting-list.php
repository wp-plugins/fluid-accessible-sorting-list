<?php
/*
Plugin Name: Fluid Accessible Sorting List
Plugin URI: http://wordpress.org/extend/plugins/fluid-accessible-sorting-list/
Description: WAI-ARIA Enabled Sorting List Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 3.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/
include_once 'getRecentPosts.php';
include_once 'getRecentComments.php';
include_once 'getArchives.php';

add_action("plugins_loaded", "FluidAccessibleSortingList_init");
function FluidAccessibleSortingList_init() {
    register_sidebar_widget(__('Fluid Accessible Sorting List'), 'widget_FluidAccessibleSortingList');
    register_widget_control(   'Fluid Accessible Sorting List', 'FluidAccessibleSortingList_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_FluidAccessibleSortingList') ) {
        wp_register_script('InfusionAll', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-sorting-list/lib/InfusionAll.js'));
        wp_enqueue_script('InfusionAll');

        wp_register_script('FluidAccessibleSortingList', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-sorting-list/lib/FluidAccessibleSortingList.js'));
        wp_enqueue_script('FluidAccessibleSortingList');

        wp_register_style('FluidAccessibleSortingList_css', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-sorting-list/lib/FluidAccessibleSortingList.css'));
        wp_enqueue_style('FluidAccessibleSortingList_css');
		
		wp_register_script('reorderer', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-sorting-list/lib/reorderer.js'));
        wp_enqueue_script('reorderer');
		
		wp_register_script('reorderer_css', ( get_bloginfo('wpurl') . '/wp-content/plugins/fluid-accessible-sorting-list/lib/reorderer.css'));
        wp_enqueue_script('reorderer_css');
    }
}

function widget_FluidAccessibleSortingList($args) {
    extract($args);

    $options = get_option("widget_FluidAccessibleSortingList");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'Fluid Accessible List',
            'archives' => 'Archives',
            'recentPosts' => 'Recent Posts',
            'recentComments' => 'Recent Comments'
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
    FluidAccessibleSortingListContent();
    echo $after_widget;
}

function FluidAccessibleSortingListContent() {
    $recentPosts = get_recent_posts();
    $recentComments = get_recent_comments();
    $archives = get_my_archives();

    $options = get_option("widget_FluidAccessibleSortingList");
    if (!is_array($options)) {
        $options = array(
            'title' => 'Fluid Accessible List',
            'archives' => 'Archives',
            'recentPosts' => 'Recent Posts',
            'recentComments' => 'Recent Comments'
        );
    }

echo '<div id="demo-selector-listReorderer" class="demo-listReorderer-container fl-container-flex" role="application">
            <ol>
                <li class="demo-listReorderer-movable flc-reorderer-movable"> ' . $options['archives'] . '
					<ul>
						' . $archives . '
					</ul>
                </li>
				
                <li class="demo-listReorderer-movable flc-reorderer-movable"> ' . $options['recentPosts'] . '
					<ul>
                        ' . $recentPosts . '
                    </ul>
                </li>
				
                <li class="demo-listReorderer-movable flc-reorderer-movable"> ' . $options['recentComments'] . '
					<ul>
                        ' . $recentComments . '
                    </ul>
                </li>
            </ol>
        </div>
		
        <script type="text/javascript">
            demo.initListReorderer();
        </script>';

}

function FluidAccessibleSortingList_control() {
    $options = get_option("widget_FluidAccessibleSortingList");
    if (!is_array( $options )) {
        $options = array(
                'title' => 'Fluid Accessible List',
            'archives' => 'Archives',
            'recentPosts' => 'Recent Posts',
            'recentComments' => 'Recent Comments'
        );
    }

    if ($_POST['FluidAccessibleSortingList-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['FluidAccessibleSortingList-WidgetTitle']);
        update_option("widget_FluidAccessibleSortingList", $options);
    }
    if ($_POST['FluidAccessibleSortingList-SubmitArchives']) {
        $options['archives'] = htmlspecialchars($_POST['FluidAccessibleSortingList-WidgetArchives']);
        update_option("widget_FluidAccessibleSortingList", $options);
    }
    if ($_POST['FluidAccessibleSortingList-SubmitRecentPosts']) {
        $options['recentPosts'] = htmlspecialchars($_POST['FluidAccessibleSortingList-WidgetRecentPosts']);
        update_option("widget_FluidAccessibleSortingList", $options);
    }
    if ($_POST['FluidAccessibleSortingList-SubmitRecentComments']) {
        $options['recentComments'] = htmlspecialchars($_POST['FluidAccessibleSortingList-WidgetRecentComments']);
        update_option("widget_FluidAccessibleSortingList", $options);
    }
    ?>
    <p>
        <label for="FluidAccessibleSortingList-WidgetTitle">Widget Title: </label>
        <input type="text" id="FluidAccessibleSortingList-WidgetTitle" name="FluidAccessibleSortingList-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="FluidAccessibleSortingList-SubmitTitle" name="FluidAccessibleSortingList-SubmitTitle" value="1" />
    </p>
    <p>
        <label for="FluidAccessibleSortingList-WidgetArchives">Translation for "Archives": </label>
        <input type="text" id="FluidAccessibleSortingList-WidgetArchives" name="FluidAccessibleSortingList-WidgetArchives" value="<?php echo $options['archives'];?>" />
        <input type="hidden" id="FluidAccessibleSortingList-SubmitArchives" name="FluidAccessibleSortingList-SubmitArchives" value="1" />
    </p>
    <p>
        <label for="FluidAccessibleSortingList-WidgetRecentPosts">Translation for "Recent Posts": </label>
        <input type="text" id="FluidAccessibleSortingList-WidgetRecentPosts" name="FluidAccessibleSortingList-WidgetRecentPosts" value="<?php echo $options['recentPosts'];?>" />
        <input type="hidden" id="FluidAccessibleSortingList-SubmitRecentPosts" name="FluidAccessibleSortingList-SubmitRecentPosts" value="1" />
    </p>
    <p>
        <label for="FluidAccessibleSortingList-WidgetRecentComments">Translation for "Recent Comments": </label>
        <input type="text" id="FluidAccessibleSortingList-WidgetRecentComments" name="FluidAccessibleSortingList-WidgetRecentComments" value="<?php echo $options['recentComments'];?>" />
        <input type="hidden" id="FluidAccessibleSortingList-SubmitRecentComments" name="FluidAccessibleSortingList-SubmitRecentComments" value="1" />
    </p>
    
    <?php
}

?>
