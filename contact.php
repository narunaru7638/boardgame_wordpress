<?php
/*
Template Name: CONTACT 〜連絡をする〜
*/
?>

<!--ヘッダー-->
<?php get_header(); ?>

       
        <!-- メニュー -->
        <?php get_template_part( 'content' , 'topmenu' ); ?>

        <!-- メインコンテンツ -->
        <div id="main" class="site-width page-1colum">
            <div class="form-area">
                <form>
                    <h2><?php echo get_the_title(); ?></h2>
                    <div class="err-msg">
                        エラーが発生しました。しばらくしてからやり直してください。
                    </div>
                    <label>
                        <h3>お名前（必須）</h3>
                        <input type="text" name="username">
                    </label>
                    <div class="err-msg">
                        お名前が入力されておりません。
                    </div>
                    <label>
                        <h3>メールアドレス（必須）</h3>
                        <input type="text" name="email">
                    </label>
                    <div class="err-msg">
                        メールアドレスが入力されておりません。
                    </div>

                    <label>
                        <h3>お問い合わせ内容（必須）</h3>
                        <textarea class="js-count" cols="50" rows="50" style="height:350px;"></textarea>
                        <span class="js-count-view">0</span>/255
                    </label>

                    <div class="err-msg">
                        お問い合わせ内容が入力されておりません。
                    </div>

                    <div class="btn-container">
                        <input type="submit" class="btn btn-mid" value="送信">
                    </div>
                </form>
            </div>

        </div>

    <!-- footer -->
    <?php get_template_part( 'content', 'bottommenu' ); ?>
<?php get_footer(); ?>