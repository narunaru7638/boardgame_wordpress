<?php
/*
Template Name: CONTACT 〜連絡をする〜
*/


if(!empty($_POST)){
    
    
    
    $email = $_POST['email'];
    $username = $_POST['username'];
    $comment = $_POST['comment'];
    
    validRequired($email, 'email');
    validRequired($username, 'username');
    validRequired($comment, 'comment');

    if(empty($err_msg)){
        
        //メールアドレスの長さチェック
        validMaxLen($email, 'email');
        validMinLen($email, 'email');

        //ニックネームの長さチェック
        validMaxLen($username,'username');

        validMaxLen($comment, 'comment');

        if(empty($err_msg)){
            
            //メールを送信
            
            ////メール送信前の準備
            //                1./etc/postfix/main.cfのファイル最後尾に以下を追加
            //                relayhost = [smtp.gmail.com]:587
            //                #sasl setting
            //                smtp_sasl_auth_enable = yes
            //                smtp_sasl_password_maps = hash:/etc/postfix/sasl_passwd
            //                smtp_sasl_security_options = noanonymous
            //                smtp_sasl_tls_security_options = noanonymous 
            //                smtp_sasl_mechanism_filter = plain
            //                #tls setting
            //                smtp_use_tls = yes
            //                2./etc/postfix/内に「sasl_passwd」というファイルを作成し、以下を記入
            //                [smtp.gmail.com]:587 Gmailアカウント@gmail.com:Gmailのパスワード
            //                3.コンソールで「sudo postmap /etc/postfix/sasl_passwd」と入力
            //                4.sudo postfix start
            //                5.sudo postfix reload
            //                6.date | mail -s test Gmailアカウント@gmail.com
            //                7.メールが届いていれば完了

            
            
            //一般設定の管理者のアドレスへ通知メールを送る
            $from = get_option( 'admin_email' , 'false'  );

            $to = get_option( 'admin_email' , 'false'  );
            
            $blogname = get_option( 'blogname' , 'false'  );
            $blogdescription = get_option( 'blogdescription' , 'false'  );

           
            $subject = 'お問い合わせが届いております';
            //EOTでもなんでもよい。先頭の<<<あとの文字列と合わせる。最後のEOTの前後に空白などは何も入れてはいけない。
            //EOT内の半角空白もすべてそのまま扱われるのでインデントはしないこと。
            $text = <<<EOT
「{$username}」様よりお問い合わせがございます。
〇〇様のメールアドレス：{$email}

■お問い合わせ内容
{$comment}

///////////////////////////////////////
サイト名「{$blogname}」より
（サイト説明：{$blogdescription}）
///////////////////////////////////////
EOT;

            $result = sendMail($from, $to, $subject, $text);

            if($result){
                $_SESSION['msg_success'] = SUC01;
                header("Location:".home_url() );
            }else{
                $err_msg['common'] = MSG01;

            }
            
        }
    }
}


?>

<!--ヘッダー-->
<?php get_header(); ?>

       
        <!-- メニュー -->
        <?php get_template_part( 'content' , 'topmenu' ); ?>

        <!-- メインコンテンツ -->
        <div id="main" class="site-width page-1colum">
            <div class="form-area">
                <form action="" method="post">
                    <h2><?php echo get_the_title(); ?></h2>
                    <div class="err-msg">
                        <?php if(!empty($err_msg)) echo $err_msg['common'] ?>
                    </div>
                    <label>
                        <h3>お名前（必須）</h3>
                        <input type="text" name="username" value="<?php if(!empty($_POST['username'])) echo $_POST['username'] ?>">
                    </label>
                    <div class="err-msg">
                        <?php if(!empty($err_msg)) echo $err_msg['username'] ?>
                    </div>
                    <label>
                        <h3>メールアドレス（必須）</h3>
                        <input type="text" name="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email'] ?>">
                    </label>
                    <div class="err-msg">
                        <?php if(!empty($err_msg)) echo $err_msg['email'] ?>
                    </div>

                    <label>
                        <h3>お問い合わせ内容（必須）</h3>
                        <textarea class="js-count" cols="50" rows="50" name="comment" style="height:350px;"><?php if(!empty($_POST['comment'])) echo $_POST['comment'] ?></textarea>
                    </label>

                    <div class="err-msg">
                        <?php if(!empty($err_msg)) echo $err_msg['comment'] ?>
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