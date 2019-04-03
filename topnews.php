<?php
/*
Template Name: TOP NEWS 〜トップページのニュース一覧〜
*/
?>


<!--ヘッダー-->
<?php get_header(); ?>

<!-- メニュー -->
<?php get_template_part( 'content', 'topmenu' ); ?>

<!-- メインコンテンツ -->
<div id="main" class="site-width">
    <div class="news-area">
        <h2 class="news">NEWS</h2>
        <div class="article-area">



            <!-- 記事のループ -->
            <?php get_template_part('loop'); ?>

            <?php if (function_exists("pagination")) pagination($additional_loop->max_num_pages); ?>

        </div>

        <!-- サイドバー  -->
        <?php get_sidebar(); ?>

    </div>


</div>

<!-- footer -->
<?php get_template_part( 'content', 'bottommenu' ); ?>
<?php get_footer(); ?>