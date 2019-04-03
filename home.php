<?php
/*
Template Name: HOME 〜トップページ〜
*/
?>


<!-- ヘッダー -->
<?php get_header(); ?>

<!-- メニュー -->
<?php get_template_part( 'content', 'topmenu' ); ?>

<!--フラッシュメッセージ-->
<p id="js-show-msg" style="display:none;" class="msg-slide">
    <?php echo getSesssionFlash('msg_success'); ?>
</p>


<!-- メインコンテンツ -->
<div id="main" class="site-width page-3colum">

    <!-- トップバナー -->
    <img src="<?php echo get_post_meta($post->ID, 'img-top', true); ?>" id="top-baner">



    <!-- ABOUT -->
    <section id="home">
        <div id="left-sidebar" class="sidebar sidebar-widget">

            <div class="sidebar-item sidebar-profile">
                <h3 class="sidebar-title">PROFILE</h3>
                <img src="<?php echo get_post_meta($post->ID, 'img-prof', true); ?>" id="prof-pic">

                <h4 class="prof-name"><?php dynamic_sidebar( 'profile_name' ); ?>
                </h4>
                <p>
                    <?php echo get_post_meta($post->ID, 'prof_msg' ,true); ?>
                </p>
            </div>
            <div class="sidebar-item sidebar-products">
                <h3 class="sidebar-title">PRODUCTS</h3>
                <?php dynamic_sidebar( 'home_products' ); ?>

            </div>

        </div>

        <div id="content">
            <!-- 記事のループ -->
            <?php
            $args = array(
                'posts_per_page' => 5 // 表示件数の指定
            );
            $posts = get_posts( $args );
            foreach ( $posts as $post ): // ループの開始
            setup_postdata( $post ); // 記事データの取得
            ?>
            <div class="article">
                <div class="article-head">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="date"><?php the_time("Y.m.j"); ?></p>
                    <category><?php the_category(' '); ?></category>

                </div>

                <div class="content-area">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php
            endforeach; // ループの終了
            wp_reset_postdata(); // 直前のクエリを復元する
            ?>
<!--
            <div id="top-article">
                <category>お知らせ</category>
                <img src="img/news-top.jpg" alt="" class="news-top-pic">
                <p class="date">2019.◯.◯</p>
                <h3><a href="">GameMarket2019春のお品書きです</a></h3>
                <p>新作「にゃんこうじょれつ」完成しました！！ゲームマーケットで販売予定です！
                    ブース番号「〇〇」!他にも二作品ございますのでぜひ！</p>
            </div>
            <div class="article">
                <category>イベント</category>
                <img src="img/article1.jpg" alt="" class="news-pic">
                <div class="article-info-area">
                    <p class="date">2019.◯.◯</p>
                    <h3><a href="">体験会イベント開催します</a></h3>
                </div>
            </div>
            <div class="article">
                <category>お知らせ</category>
                <img src="img/article2.jpg" alt="" class="news-pic">
                <div class="article-info-area">
                    <p class="date">2019.◯.◯</p>
                    <h3><a href="">GameMarket2019春に出店します</a></h3>
                </div>
            </div>
-->
        </div>

        <div id="right-sidebar" class="sidebar sidebar-widget">
            <div class="sidebar-item sidebar-nextevent">
                <h3 class="sidebar-title">NEXT EVENT</h3>

                                   <table>
                    <tbody>
                        <tr><th>イベント名</th><td><?php echo get_post_meta($post->ID, 'next_event_info1', true); ?></td></tr>
                        <tr><th>日付</th><td><?php echo get_post_meta($post->ID, 'next_event_info2', true); ?></td></tr>
                        <tr><th>ブース番号</th><td><?php echo get_post_meta($post->ID, 'next_event_info3', true); ?></td></tr>
                        <tr><th>作品名</th><td><?php echo get_post_meta($post->ID, 'next_event_info4', true); ?></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="sidebar-item sidebar-news">

                <?php dynamic_sidebar( 'home_news' ); ?>

           
            </div>
        </div>


    </section>
</div>


<!-- フッター-->
<?php get_template_part( 'content', 'bottommenu' ); ?>

<?php get_footer(); ?>