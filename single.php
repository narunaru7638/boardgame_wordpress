<!--ヘッダー-->
<?php get_header(); ?>

<!-- メニュー -->
<?php get_template_part( 'content', 'topmenu' ); ?>

        <!-- メインコンテンツ -->
        <div id="main" class="site-width">
            <div class="news-area">
                <h2 class="news">NEWS</h2>
                <div class="article-area">
                    


                    <?php if(have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="one-article-area">
                            <h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <ul>
                                <li><?php the_author_nickname(); ?></li>
                                <li><?php the_time("Y.m.j"); ?></li>
                                <li><?php single_cat_title('カテゴリー： '); ?></li>
                            </ul>
                            <img src="img/news-top.jpg" alt="">
                            <p><?php the_content(); ?></p>

                        </div>

                    <?php endwhile; ?>


                    <div class="pagination">
                        <ul>
                            <li class="prev"><?php previous_post_link('%link','PREV'); ?></li>
                            <li class="next"><?php next_post_link('%link','NEXT'); ?></li>
                        </ul>

                    </div>


                    <!--コメント -->
                    <?php comments_template(); ?>

                    <?php else : ?>

                        <h2 class="title">記事が見つかりませんでした。</h2>
                        <p>検索で見つかるかもしれません。</p><br />
                        <?php get_search_form(); ?>

                    <?php endif; ?>

                </div>

                <!-- サイドバー  -->
                <?php get_sidebar(); ?>



            </div>


        </div>

    <!-- footer -->
    <?php get_template_part( 'content', 'bottommenu' ); ?>
<?php get_footer(); ?>