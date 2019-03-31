<footer>
    <nav id="bottom-nav">
        <div class="bottom-nav-area">
            <h1><a href="index.html">ボドゲサークル</a></h1>

            <p class="cicle-detail">｜いろいろ作っているサークルです</p>

            <a href=""><i class="fab fa-twitter-square"></i></a>
<!--
            <ul>
                <li><a href="about.html">ABOUT</a>｜</li>
                <li><a href="products.html">PRODUCTS</a>｜</li>
                <li><a href="events.html">EVENTS</a>｜</li>
                <li><a href="news.html">NEWS</a>｜</li>
                <li><a href="contact.html">CONTACT</a></li>
            </ul>
-->
            <?php wp_nav_menu( array(
                'theme_location' => 'bottommenu',
                'container' =>'',
                'menu_class' =>'',
                'items_wrap' =>'<ul>%3$s</ul>',
                'walker' => new border_link_list//設定した名前と同じ名前を呼び出します。
                ));
            ?>
        </div>
    </nav>