<?php

/**
 * Plugin Name: Megamenu shortcode for italiastyle.pl
 * Author: Runbyit
 * Description: Megamenu shortcode for italiastyle.pl
 * Version: 0.1.1
 * text-domain: Shortcode
 */


function rbit_custom_scripts_menu() {

    wp_enqueue_script( 'rbit-custom-js12', plugins_url("shortcode-menu.js" , __FILE__), array( 'jquery' ), "1.0",true );
    wp_enqueue_style( 'rbit-custom-css12', plugins_url("shortcode-menu.css", __FILE__));

}
add_action( 'wp_enqueue_scripts', 'rbit_custom_scripts_menu' );

function megaMenu($atts) {


    extract(shortcode_atts(array(
        'only_main' => true,
        'where' => 'meble',
    ), $atts));


    ?>



    <div>
        <div id="megaMenu" style="min-height: 400px; height: 400px; padding: 25px 60px;" >

            <?php



            $taxonomy = 'product_cat';
            $orderby = 'name';
            $show_count = 0;      // 1 for yes, 0 for no
            $pad_counts = 0;      // 1 for yes, 0 for no
            $hierarchical = 1;      // 1 for yes, 0 for no
            $title = '';
            $empty = 0;

            $args = array(
                'taxonomy' => $taxonomy,
                'orderby' => $orderby,
                'show_count' => $show_count,
                'pad_counts' => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li' => $title,
                'hide_empty' => $empty
            );
            $all_categories = get_categories($args);
            $categoriesId = []

            ?>

            <div class="menu-wraper d-flex">
                <div class="parent-category  w-25 d-flex flex-wrap">
                    <?php
                    foreach ($all_categories as $cat) { ?>

                        <?php

                        if ($cat->category_parent == 0) {
                            $category_id = $cat->term_id;

                            $whereShow = get_field('where_show', 'product_cat_' . $category_id);

                            if($whereShow == $where){
                                ?>
                                <a data-id="<?php echo $category_id ?>" class="d-flex justify-content-between text-black" style=" padding-right: 120px; font-weight: 300; flex-basis: 100%; color: black; font-size: 15px; height: 40px;" href="<?php echo get_term_link( $cat->term_id, 'product_cat' ); ?>">
                                    <?= $cat->name ?>
                                    <img  style="position: relative; top: 5px; height: 10px; width: 10px;" src="https://italiastyle.runbyit.com/wp-content/uploads/2023/01/icon-chevron-right.svg">
                                </a>
                                <?php

                                array_push($categoriesId, $category_id);
                            }
                        }
                        ?>
                        <?php

                    }
                    ?>
                </div>
                <div class="child-category w-50">

                        <?php
                        $showFirst = true;
                         foreach($categoriesId as $category) {?>
                             <div id="child-<?php echo $category ?>"  style="height: 100%; <?php echo $showFirst ?  'display:flex;' :  'display: none;'; $showFirst = false; ?> align-items: flex-start; flex-wrap: wrap; align-content: baseline; width: 100% !important;">
                                 <?php
                                $args2 = array(
                                    'taxonomy' => $taxonomy,
                                    'child_of' => 0,
                                    'parent' => $category,
                                    'orderby' => $orderby,
                                    'show_count' => $show_count,
                                    'pad_counts' => $pad_counts,
                                    'hierarchical' => $hierarchical,
                                    'title_li' => $title,
                                    'hide_empty' => $empty
                                );
                                $sub_cats = get_categories($args2);

                                if ($sub_cats) {
                                    foreach ($sub_cats as $sub_category) { ?>

                                                <a class="text-black gap-2" style="font-weight: 300; flex-basis: 50% !important; color: black; font-size: 15px; height: 40px;" href="<?php echo get_term_link( $sub_category->term_id, 'product_cat' ); ?>"><?= $sub_category->name?></a>

                                        <?php
                                    }
                                } ?>
                             </div>
                             <?php
                        }

                        ?>

                    </div>
                <div class="parent-category-image w-25">

                </div>
            </div>
        </div>
    </div>


    <?php

}



add_shortcode('megaMenu', 'megaMenu');