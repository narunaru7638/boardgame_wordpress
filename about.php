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


                <h3>作者プロフィール</h3>
                <div class="prof-area">
                    <img src="img/prof-pic.jpg" alt="">
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

                <h3>沿革</h3>
                <table>
                    <tbody>
                        <tr><th>〇〇年◯月◯日</th><td>ゲームマーケット〇〇にて、〇〇発売</td></tr>
                        <tr><th>〇〇年◯月◯日</th><td>〇〇発売</td></tr>
                        <tr><th>〇〇年◯月◯日</th><td>〇〇発売</td></tr>
                        <tr><th>〇〇年◯月◯日</th><td>〇〇発売</td></tr>
                    </tbody>
                </table>

            </div>


        </div>

    <!-- footer -->
    <?php get_template_part( 'content', 'bottommenu' ); ?>
<?php get_footer(); ?>