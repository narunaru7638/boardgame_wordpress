<?php
/*
Template Name: PRODUCTS 〜作品一覧〜
*/
?>

<?php get_header(); ?>

<!-- メニュー -->
<?php get_template_part( 'content' , 'topmenu' ); ?>

        <!-- メインコンテンツ -->
        <div id="main" class="site-width">
            <div class="products-area">
                <h2 class="products">PRODUCTS</h2>
                
                <?php dynamic_sidebar( 'widget_products' ); ?>
                


            </div>


        </div>

    <!-- footer -->
    <?php get_template_part( 'content' , 'bottommenu' ); ?>
<?php get_footer(); ?>