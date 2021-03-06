<!-- メニュー -->
<header class="site-width">
    <!-- トップサークル名-->
    <div id="top-circle-name" class="site-width">
        <h1>
            <a href="<?php echo home_url(); ?>">
                <img src="<?php header_image(); ?>" class="img-responsive" alt="<?php bloginfo( 'name' ); ?>">
            </a>
        </h1>
        <?php dynamic_sidebar( 'sight_sub_title' ); ?>

<!--        <p class="cicle-detail">いろいろ作っているサークルです</p>-->
<!--
        <a href="">
            <i class="fab fa-twitter-square"></i></a>
-->
        <?php dynamic_sidebar( 'sns_link' ); ?>

            
    </div> 
    <!-- トップグローバルナビゲーション-->
    <nav id="top-nav" class="site-width">
<!--
        <ul>
            <li><a href="about.php"><i class="fas fa-question-circle"></i>ABOUT</a></li>
            <li><a href="products.php"><i class="fas fa-gift"></i>PRODUCTS</a></li>
            <li><a href="events.php"><i class="fas fa-bell"></i>EVENTS</a></li>
            <li><a href="news.php"><i class="fas fa-newspaper"></i>NEWS</a></li>
            <li><a href="contact.php"><i class="fas fa-envelope"></i>CONTACT</a></li>
        </ul>
-->
            <?php wp_nav_menu( array(
                'theme_location' => 'topmenu',
                'container' =>'',
                'menu_class' =>'',
                'items_wrap' =>'<ul>%3$s</ul>'));
            ?>
    </nav>
</header>