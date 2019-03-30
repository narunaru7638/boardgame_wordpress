<?php if(have_posts()): ?>
<?php while(have_posts()):the_post(); ?>
<div class="one-article-area">
    <h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <ul>
        <li><?php the_author_nickname(); ?></li>
        <li><?php the_time("Y.m.j"); ?></li>
        <li><?php single_cat_title('カテゴリー： '); ?></li>
    </ul>
    <p><?php the_content(); ?></p>
</div>


<?php endwhile; ?>

<?php endif; ?>