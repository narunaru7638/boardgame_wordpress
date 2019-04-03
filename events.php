<?php
/*
Template Name: EVENTS 〜最新のイベントについて〜
*/
?>

<?php get_header(); ?>

        <!-- メニュー -->
        <?php get_template_part( 'content' , 'topmenu' ); ?>
        
        <!-- メインコンテンツ -->
        <div id="main" class="site-width page-1colum">
            <div class="event-area">
                <h2 class="events"><?php echo get_the_title(); ?></h2>

<!--                <img class="event-pic" src="img/event-pic.jpg" alt="">-->
                
                <img src="<?php echo get_post_meta($post->ID, 'img-event', true); ?>" class="event-pic">

                
                <?php if (have_posts()) : //WordPressループ
                while (have_posts()) : the_post(); //繰り返し処理開始 ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php the_content(); ?>
                </div>
                <?php   endwhile; //繰り返し処理終了
                else : // ここから記事が見つからなかった場合の処理 ?>
                <div class="post">
                    <h2>記事はありません</h2>
                    <p>お探しの記事は見つかりませんでした</p>
                </div>
                <?php endif; // WordPressループ終了 ?>
            </div>


        </div>

    <!-- footer -->
    <?php get_template_part( 'content' , 'bottommenu' ); ?>
<?php get_footer(); ?>