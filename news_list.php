<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="utf-8">
        <title>ボードゲームサークル用ページ</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>

    <body class="page-1colum">

        <!-- メニュー -->
        <header class="site-width">
            <!-- トップサークル名-->
            <div id="top-circle-name" class="site-width">
                <h1><a href="index.html">ボドゲサークル</a></h1>
                <p class="cicle-detail">いろいろ作っているサークルです</p>
                <a href="">
                    <i class="fab fa-twitter-square"></i></a>
            </div> 
            <!-- トップグローバルナビゲーション-->
            <nav id="top-nav" class="site-width">
                <ul>
                    <li><a href="about.html"><i class="fas fa-question-circle"></i>ABOUT</a></li>
                    <li><a href="products.html"><i class="fas fa-gift"></i>PRODUCTS</a></li>
                    <li><a href="events.html"><i class="fas fa-bell"></i>EVENTS</a></li>
                    <li><a href="news.html"><i class="fas fa-newspaper"></i>NEWS</a></li>
                    <li><a href="contact.html"><i class="fas fa-envelope"></i>CONTACT</a></li>
                </ul>
            </nav>
        </header>

        <!-- メインコンテンツ -->
        <div id="main" class="site-width">
            <div class="news-area">
                <h2 class="news">NEWS</h2>
                <div class="article-area">
                    <div class="one-article-area">
                        <h3 class="article-title"><a href="single.html">GameMarket2019春のお品書きです</a></h3>
                        <ul>
                            <li>なる</li>
                            <li>2019.3.30</li>
                            <li>カテゴリー：お知らせ</li>
                        </ul>
                        <img src="img/news-top.jpg" alt="">
                        <p>新作「にゃんこうじょれつ」完成しました！！ゲームマーケットで販売予定です！ブース番号「〇〇」!他にも二作品ございますのでぜひ！</p>

                    </div>
                    <div class="one-article-area">
                        <h3 class="article-title">GameMarket2019春のお品書きです</h3>
                        <ul>
                            <li>なる</li>
                            <li>2019.3.30</li>
                            <li>カテゴリー：お知らせ</li>
                        </ul>
                        <img src="img/news-top.jpg" alt="">
                        <p>新作「にゃんこうじょれつ」完成しました！！ゲームマーケットで販売予定です！ブース番号「〇〇」!他にも二作品ございますのでぜひ！</p>

                    </div>
                    <div class="one-article-area">
                        <h3 class="article-title">GameMarket2019春のお品書きです</h3>
                        <ul>
                            <li>なる</li>
                            <li>2019.3.30</li>
                            <li>カテゴリー：お知らせ</li>
                        </ul>
                        <img src="img/news-top.jpg" alt="">
                        <p>新作「にゃんこうじょれつ」完成しました！！ゲームマーケットで販売予定です！ブース番号「〇〇」!他にも二作品ございますのでぜひ！</p>

                    </div>

                    <div class="pagination">
                        <ul>
                            <li><a href="">PREV</a>｜</li>
                            <li><a href="">1</a>｜</li>
                            <li><a href="">2</a>｜</li>
                            <li><a href="">3</a>｜</li>
                            <li><a href="">NEXT</a></li>
                        </ul>

                    </div>

                </div>

                <!-- サイドバー  -->
                <?php get_sidebar(); ?>

            </div>


        </div>

        <!-- footer -->
        <footer>
            <nav id="bottom-nav">
                <div class="bottom-nav-area">
                    <h1><a href="index.html">ボドゲサークル</a></h1>

                    <p class="cicle-detail">｜いろいろ作っているサークルです</p>

                    <a href=""><i class="fab fa-twitter-square"></i></a>
                    <ul>
                        <li><a href="about.html">ABOUT</a>｜</li>
                        <li><a href="products.html">PRODUCTS</a>｜</li>
                        <li><a href="events.html">EVENTS</a>｜</li>
                        <li><a href="news.html">NEWS</a>｜</li>
                        <li><a href="contact.html">CONTACT</a></li>
                    </ul>
                </div>
            </nav>
            <p id="copyright">Copyright <a href="https://twitter.com/narumismis">なる</a>. All Rights Reserved.</p>
        </footer>

    </body>
</html>