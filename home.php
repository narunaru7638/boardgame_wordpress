<?php
/*
Template Name: HOME 〜トップページ〜
*/
?>


<!-- ヘッダー -->
<?php get_header(); ?>

<!-- メニュー -->
<?php get_template_part( 'content', 'topmenu' ); ?>

<!-- メインコンテンツ -->
<div id="main" class="site-width page-3colum">

    <!-- トップバナー -->
    <img src="img/top-baner.jpg" id="top-baner">



    <!-- ABOUT -->
    <section id="home">
        <div id="left-sidebar" class="sidebar sidebar-widget">

            <div class="sidebar-item sidebar-profile">
                <h3 class="sidebar-title">PROFILE</h3>
                <img src="img/prof-pic.jpg" alt="プロフィール写真" class="prof-pic">
                <h4 class="prof-name">なる</h4>
                <p>人が集まる場にボードゲームを持っていっては、布教活動に勤しんでいる。親戚の集まりでボドゲを披露しているときとゲムマで営業トークをしているときが至福。</p>
            </div>
            <div class="sidebar-item sidebar-products">
                <h3 class="sidebar-title">PRODUCTS</h3>
                <h4 class="product-name">サイコロコロンブスの卵</h4>
                <a href=""><img src="img/dice.jpg" alt="サイコロコロンブスの卵画像" class="product-pic"></a>
                <h4 class="product-name">StoneSaga</h4>
                <a href=""><img src="img/stone.jpg" alt="StoneSaga画像" class="product-pic"></a>
                <h4 class="product-name">にゃんこうじょれつ</h4>
                <a href=""><img src="img/nyanko.jpg" alt="にゃんこうじょれつ画像" class="product-pic"></a>
            </div>

        </div>

        <div id="content">
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
        </div>

        <div id="right-sidebar" class="sidebar sidebar-widget">
            <div class="sidebar-item sidebar-nextevent">
                <h3 class="sidebar-title">NEXT EVENT</h3>
                <!--
<p>GameMarket2019春</p>
<p>日付：5/25(土)26(日)</p>
<p>ブース番号：</p>
<p>作品名:にゃんこうじょれつ</p>
-->
                <table>
                    <tbody>
                        <tr><th>イベント名</th><td>GameMarket2019春</td></tr>
                        <tr><th>日付</th><td>◯/◯(△)</td></tr>
                        <tr><th>ブース番号</th><td>〇〇</td></tr>
                        <tr><th>作品名</th><td>にゃんこうじょれつ</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="sidebar-item sidebar-news">
                <h3 class="sidebar-title">NEWS</h3>
                <h4 class="article-title"><a href="">GameMarket2019春のお品書きです</a></h4>
                <h4 class="article-title"><a href="">体験会イベント開催します</a></h4>
                <h4 class="article-title"><a href="">GameMarket2019春に出店します</a></h4>
            </div>
        </div>


    </section>
</div>


<!-- フッター-->
<?php get_template_part( 'content', 'bottommenu' ); ?>

<?php get_footer(); ?>