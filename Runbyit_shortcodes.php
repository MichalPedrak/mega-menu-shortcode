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


function megaMenu($atts) {


    extract(shortcode_atts(array(
        'only_main' => '',
        'where' => 'meble',
    ), $atts));

    $only_main === 'true' ? $only_main = true : $only_main = false;

    ?>



    <div>
        <div class="megaMenu">


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

            <div class="desktop-mega-menu menu-wraper" style="background: #f5f5f5; min-height: 400px; height: 400px; padding: 25px 60px;" >
                <div class="parent-category d-flex flex-wrap <?= $only_main === true ?  'w-75 flex-column only-parent' : 'w-25' ?>">
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
                                    <?php if(!$only_main){ ?>
                                    <img  style="position: relative; top: 5px; height: 10px; width: 10px;" src="https://italiastyle.runbyit.com/wp-content/uploads/2023/01/icon-chevron-right.svg">
                                    <?php } ?>
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

                <?php if(!$only_main){?>
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
                <?php } ?>

                <div class="parent-category-image w-25">
                    <?php if($only_main){?>
                        <img src="https://italiastyle.runbyit.com/wp-content/uploads/2023/03/1_2603.webp">
                    <?php } else {
                         foreach($categoriesId as $category) {
                             $thumbnail_id = get_term_meta( $category, 'thumbnail_id', true );

                             ?>
                         <img data-lazyloaded="0" style="display: none" id="img-<?php echo $category ?>" src="<?=  wp_get_attachment_url( $thumbnail_id, 'medium') ?>">
                    <?php } } ?>

                </div>
            </div>

            <div class="mobile-mega-menu menu-wraper flex-wrap" style=" padding: 25px 60px;">

                <?php

                foreach ($all_categories as $cat) { ?>

                    <?php
                    if ($cat->category_parent == 0) {
                        $category_id = $cat->term_id;
                        $whereShow = get_field('where_show', 'product_cat_' . $category_id);
                        if($whereShow == $where){
                            ?>
                            <div class="d-flex flex-wrap w-100">
                            <div class="parent-category d-flex flex-wrap w-100"> <!-- <?php echo get_term_link( $cat->term_id, 'product_cat' ); ?> -->
                                <a data-id="<?php echo $category_id ?>" class="d-flex justify-content-between text-black" style=" padding-right: 120px; font-weight: 300; flex-basis: 100%; color: black; font-size: 15px; height: 40px;" href="#">
                                    <?= $cat->name ?>
                                    <?php if(!$only_main){ ?>
                                        <img  style="position: relative; top: 5px; height: 10px; width: 10px;" src="https://italiastyle.runbyit.com/wp-content/uploads/2023/01/icon-chevron-right.svg">
                                    <?php } ?>
                                </a>
                            </div>

                            <?php if(!$only_main){?>


                            <div class="child-mobile-<?php echo $category_id ?> mobile-child"  style="height: 100%; align-items: flex-start; flex-wrap: wrap; align-content: baseline; width: 100% !important;">
                                                <?php
                                                $args2 = array(
                                                    'taxonomy' => $taxonomy,
                                                    'child_of' => $category_id,
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

                                                        <a class="text-black gap-2" style="font-weight: 300; flex-basis: 100% !important; color: black; font-size: 15px; height: 40px;" href="<?php echo get_term_link( $sub_category->term_id, 'product_cat' ); ?>"><?= $sub_category->name?></a>

                                                        <?php
                                                    }
                                                } ?>
                            </div>


                                <?php } ?>
                            </div>
                            <?php

                        }
                    } ?>

                    <?php

                }
                ?>




            </div>


        </div>
    </div>




    <?php
    wp_reset_postdata();
}



add_shortcode('megaMenu', 'megaMenu');

add_action( 'wp_enqueue_scripts', 'rbit_custom_scripts_menu' );
