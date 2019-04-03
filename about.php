<?php
/*
Template Name: ABOUT 〜このサイトについて〜
*/
?>

<!--ヘッダー-->
<?php get_header(); ?>

        <!-- メニュー -->
        <?php get_template_part( 'content', 'topmenu' ); ?>
        
        <!-- メインコンテンツ -->
        <div id="main" class="site-width">
            <div class="about-area">
                <h2 class="about page-1colum"><?php echo get_the_title(); ?></h2>
                <h3>ごあいさつ</h3>
                <p>
                    <?php echo get_post_meta($post->ID, 'about_greet_msg' ,true); ?>
                </p>
                <h3>
                    作者（<?php dynamic_sidebar( 'profile_name' ); ?>）プロフィール
                </h3>
                <div class="prof-area">
                   
                    <img src="img/prof-pic.jpg" alt="">
                    <img src="<?php echo get_post_meta($post->ID, 'img-prof', true); ?>" id="prof-pic">
                    <p>
                        <?php echo get_post_meta($post->ID, 'prof_msg' ,true); ?>

                    </p>
                </div>

                <h3>沿革</h3>

<!--
                <table>
                    <tbody>
                        <tr><th>〇〇年◯月◯日</th><td>ゲームマーケット〇〇にて、〇〇発売</td></tr>
                        <tr><th>〇〇年◯月◯日</th><td>〇〇発売</td></tr>
                        <tr><th>〇〇年◯月◯日</th><td>〇〇発売</td></tr>
                        <tr><th>〇〇年◯月◯日</th><td>〇〇発売</td></tr>
                    </tbody>
                </table>
-->
                <p class="sight-history-area">
                    <?php echo get_post_meta($post->ID, 'sight_history' ,true); ?>

                </p>
            </div>


        </div>

    <!-- footer -->
    <?php get_template_part( 'content', 'bottommenu' ); ?>
<?php get_footer(); ?>