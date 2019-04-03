<?php
//================================
// ログ
//================================
//ログを取るか
ini_set('log_errors','on');
//ログの出力ファイルを指定
ini_set('error_log','php.log');

//================================
// デバッグ
//================================
//デバッグフラグ
$debug_flg = true;
//デバッグログ関数
function debug($str){
    global $debug_flg;
    if(!empty($debug_flg)){
        error_log('デバッグ：'.$str);
    }
}

//================================
// セッション準備・セッション有効期限を延ばす
//================================
//セッションを使う
session_start();
//現在のセッションIDを新しく生成したものと置き換える（なりすましのセキュリティ対策）
session_regenerate_id();

//================================
// 定数
//================================
//エラーメッセージを定数に設定
define('MSG01','エラーが発生しました。しばらく経ってからやり直してください。');
define('MSG02','値が未入力です。');
define('MSG03','255文字以下で入力してください。');
define('MSG04','8文字以上で入力してください。');
define('SUC01','メール送信が完了しました。');

//エラーメッセージを格納する配列を用意
$err_msg = array();


//================================
// バリデーション
//================================
//未入力チェック
function validRequired($str, $key){
    if(empty($str)){
        global $err_msg;
        $err_msg[$key] = MSG02;
    }
}

//最大文字数チェック
function validMaxLen($str, $key, $max = 255){
    if(mb_strlen($str) > $max){
        global $err_msg;
        $err_msg[$key] = MSG03;
    }
}

//最小文字数チェック
function validMinLen($str, $key, $min = 8){
    if(mb_strlen($str) < $min){
        global $err_msg;
        $err_msg[$key] = MSG04;
    }
}


//================================
// メール送信
//================================
function sendMail($from, $to, $subject, $text){
    if(!empty($to) && !empty($subject) && !empty($text)){
        //文字化けしないように設定(お決まりパターン)
        mb_language('Japanese');//現在使っている言語を設定する
        mb_internal_encoding("UTF-8");//内部の日本語をどうエンコーディング(機械が分かる言葉へ変換)するかを設定

        //メールを送信(送信結果はtrueかfalseで返ってくる)
        $result = mb_send_mail($to, $subject, $text, "From: ".$from);
        //送信結果を判定
        if($result) {
            debug('メールを送信しました。');
        } else {
            debug('【エラー発生】メールの送信に失敗しました。');
        }

        return $result;
    }
}

//================================
// その他
//================================
//フラッシュメッセージ
function getSesssionFlash($key){
    if(!empty($_SESSION[$key])){
        $data = $_SESSION[$key];
        $_SESSION[$key] = '';
        return $data;
    }

}

/*===================================
WordPress
===================================*/

//カスタムヘッダー画像の設置
$custom_header_defaults = array(
    'default-image' => get_bloginfo('template_url').'/images/headers/logo.png','header-text' => false, //ヘッダー画像上にテキストを被せる

);


//カスタムヘッダー機能を有効にする
add_theme_support( 'custom-header', $custom_header_defaults );

//カスタムメニュー使用
register_nav_menu('topmenu','トップナビゲーション');

//カスタムメニュー使用
register_nav_menu('bottommenu',' ボトムナビゲーション');

//カスタムウォーカー機能を利用して、wp_nav_menuメニューに区切り文字を設定する
class border_link_list extends Walker
{
    public function walk( $elements, $max_depth )
    {
        $list = array ();

        foreach ( $elements as $item )
            $list[] = "<li><a href='$item->url'>$item->title</a></li>";//各アイテムにliタグをつけている
        return join( '<li>|</li>', $list );// 区切り文字に| を使用。liタグをつけて使用。
    }
}

//ページネーション
function pagination($pages = 5, $range = 2)
{
    $showitems = ($range * 2)+1;//表示するページ数（５ページ）

    global $paged;//現在のページ値（WordPressのグローバル変数）
    if(empty($paged)) $paged = 1;//デフォルトのページ

    if($pages == '')//呼び出す関数で引数を渡していなかった場合
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;//全ページを取得
        if(!$pages)
        {
            $pages = 1;
        }

    }

    if(1 != $pages)//全ページが２ページ以上ページがあるときページネーションを表示する
    {
        echo "<div class=\"pagination\">\n";
        echo "<ul>\n";
        
        //Prev: 現在のページ値が1より大きい場合は表示
        if( $paged > 1) echo "<li class=\"prev\"><a href='".get_pagenum_link($paged - 1)."'>Prev</a></li>\n";

        for ( $i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                //三項演算子での条件分岐
                echo ($paged == $i)? "<li class=\"active\">".$i."</li>\n":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>\n";//現在ページならaタグをつけない。それ以外はaタグをつける。
            }


        }
        //Next: 総ページ数より現在のページ値が小さい場合は表示
        if ($paged < $pages) echo "<li class=\"next\"><a href=\"".get_pagenum_link($paged + 1)."\">Next</a></li>\n";
        echo "</ul>\n";
        echo "</div>\n";
    }
}


/*=========================
カスタムフィールド
==========================*/
/*投稿ページに表示するカスタムボックスを定義する*/
add_action('admin_menu', 'add_custom_inputbox');
/*追加した表示項目のデータ更新・保存のためのアクションフック*/
add_action('save_post', 'save_custom_postdata');

//入力項目がどの投稿タイプのページに表示されるかの設定
function add_custom_inputbox(){
    //第一引数：編集画面のhtmlに挿入されるid属性名
    //第二引数：管理画面に表示されるカスタムフィールド名
    //第三引数：メタボックスの中に出力される関数名
    //第四引数：管理画面に表示するカスタムフィールドの場所(postなら投稿、pageなら固定ページ)
    //第五引数：配置される順序
    add_meta_box( 'prof_id','HOME＆ABOUT : PROFILE入力欄', 'custom_area1', 'page', 'normal');
    add_meta_box( 'about_greet_id','ABOUT : ごあいさつ入力欄', 'custom_area2', 'page', 'normal');
    add_meta_box( 'next_event_info_id','HOME : NEXT EVENT入力欄', 'custom_area3', 'page', 'normal');
    add_meta_box( 'top_img_id','HOME : トップ画像URL入力欄', 'custom_area4', 'page', 'normal');
    add_meta_box( 'prof_img_id','HOME＆ABOUT : プロフィール画像URL入力欄', 'custom_area5', 'page', 'normal');
    add_meta_box( 'sight_history_id','ABOUT : 沿革入力欄', 'custom_area6', 'page', 'normal');
    add_meta_box( 'event_img_id','EVENTS : EVENTページ画像URL入力欄', 'custom_area7', 'page', 'normal');



}

/*管理画面に表示される内容*/
function custom_area1(){
    global $post;
    
    echo 'プロフィール：<textarea cols="50" rows="5" name="prof_msg">'.get_post_meta($post->ID,'prof_msg',true).'</textarea><br>';
}

/*管理画面に表示される内容*/
function custom_area2(){
    global $post;

    echo 'aboutごあいさつ：<textarea cols="50" rows="5" name="about_greet_msg">'.get_post_meta($post->ID,'about_greet_msg',true).'</textarea><br>';
}

/*管理画面に表示される内容*/
function custom_area3(){
    global $post;
    echo '<table>';
    for($i = 1; $i <=4 ; $i++){
        echo '<tr><td>info'.$i.':</td><td><input cols="50" rows="5" name="next_event_info'.$i.'" value="'.get_post_meta($post->ID,'next_event_info'.$i,true).'"></td></tr>';
    }
    echo '</table>';
}

/*管理画面に表示される内容*/
function custom_area4(){
    global $post;
    echo 'トップ画像URL：<input type="text"  name="img-top" value="'.get_post_meta($post->ID,'img-top',true).'">';
}

/*管理画面に表示される内容*/
function custom_area5(){
    global $post;
    echo 'プロフィール画像URL：<input type="text"  name="img-prof" value="'.get_post_meta($post->ID,'img-prof',true).'">';
}

/*管理画面に表示される内容*/
function custom_area6(){
    global $post;

    echo '沿革：<textarea cols="50" rows="5" name="sight_history">'.get_post_meta($post->ID,'sight_history',true).'</textarea><br>';
}

/*管理画面に表示される内容*/
function custom_area7(){
    global $post;
    echo 'EVENT画像URL：<input type="text"  name="img-event" value="'.get_post_meta($post->ID,'img-event',true).'">';
}


/*投稿ボタンを押した際のデータ更新と保存*/
function save_custom_postdata($post_id){
    
    $prof_msg = '';
    $about_greet_msg = '';
    $next_event_info = '';
    $img_top = '';
    $img_prof = '';
    $sight_history = '';
    $img_event = '';
    
    //カスタムフィールドに入力された情報を取り出す
    if(isset($_POST['prof_msg'])){
        $prof_msg = $_POST['prof_msg'];        
    }
    //内容が変わっていた場合、保存していた情報を更新する
    if($prof_msg != get_post_meta($post_id, 'prof_msg', true)){//第二引数はDBにデータを保存するときのkey
        update_post_meta($post_id, 'prof_msg', $prof_msg);
    }elseif($prof_msg == ''){
        delete_post_meta($post_id, 'prof_msg', get_post_meta($post_id,'prof_msg',true));
    }

    //カスタムフィールドに入力された情報を取り出す
    if(isset($_POST['about_greet_msg'])){
        $about_greet_msg = $_POST['about_greet_msg'];
    }
    //内容が変わっていた場合、保存していた情報を更新する
    if($about_greet_msg != get_post_meta($post_id, 'about_greet_msg', true)){//第二引数はDBにデータを保存するときのkey
        update_post_meta($post_id, 'about_greet_msg', $about_greet_msg);
    }elseif($about_greet_msg == ''){
        delete_post_meta($post_id, 'about_greet_msg', get_post_meta($post_id,'about_greet_msg',true));
    }


    
    for($i = 1; $i<=4; $i++ ){        
        //カスタムフィールドに入力された情報を取り出す
        if(isset($_POST['next_event_info'.$i])){
            $next_event_info = $_POST['next_event_info'.$i];
        }
        
        //内容が変わっていた場合、保存していた情報を更新する
        if($next_event_info != get_post_meta($post_id, 'next_event_info'.$i, true)){//第二引数はDBにデータを保存するときのkey
            update_post_meta($post_id, 'next_event_info'.$i, $next_event_info);
        }elseif($next_event_info == ''){
            delete_post_meta($post_id, 'next_event_info'.$i, get_post_meta($post_id,'next_event_info'.$i,true));
            error_log("6666666");
        }
    }
    
    //カスタムフィールドに入力された情報を取り出す
    if(isset($_POST['img-top'])){
        $img_top = $_POST['img-top'];
    }
    //内容が変わっていた場合、保存していた情報を更新する
    if($img_top != get_post_meta($post_id, 'img-top', true)){//第二引数はDBにデータを保存するときのkey
        update_post_meta($post_id, 'img-top', $img_top);
    }elseif($img_top == ''){
        delete_post_meta($post_id, 'img-top', get_post_meta($post_id,'img-top',true));
    }
    
    //カスタムフィールドに入力された情報を取り出す
    if(isset($_POST['img-prof'])){
        $img_prof = $_POST['img-prof'];
    }
    //内容が変わっていた場合、保存していた情報を更新する
    if($img_prof != get_post_meta($post_id, 'img-prof', true)){//第二引数はDBにデータを保存するときのkey
        update_post_meta($post_id, 'img-prof', $img_prof);
    }elseif($img_prof == ''){
        delete_post_meta($post_id, 'img-prof', get_post_meta($post_id,'img-prof',true));
    }


    //カスタムフィールドに入力された情報を取り出す
    if(isset($_POST['sight_history'])){
        $sight_history = $_POST['sight_history'];
    }
    //内容が変わっていた場合、保存していた情報を更新する
    if($sight_history != get_post_meta($post_id, 'sight_history', true)){//第二引数はDBにデータを保存するときのkey
        update_post_meta($post_id, 'sight_history', $sight_history);
    }elseif($sight_history == ''){
        delete_post_meta($post_id, 'sight_history', get_post_meta($post_id,'sight_history',true));
    }
    
    //カスタムフィールドに入力された情報を取り出す
    if(isset($_POST['img-event'])){
        
        $img_event = $_POST['img-event'];
    }
    //内容が変わっていた場合、保存していた情報を更新する
    if($img_event != get_post_meta($post_id, 'img-event', true)){//第二引数はDBにデータを保存するときのkey
        update_post_meta($post_id, 'img-event', $img_event);
    }elseif($img_event == ''){
        delete_post_meta($post_id, 'img-event', get_post_meta($post_id,'img-event',true));
    }


}


/*==============================
カスタムウィジェット
================================*/


//ウィジェットエリアを作成する関数がどれなのかを登録する
add_action( 'widgets_init' , 'my_widgets_area');

//ウィジェット自体の作成するクラスがどれなのかを登録する
//PRODUCTSウィジェット
add_action( 'widgets_init' , create_function('', 'return register_widget("my_widgets_item1");'));

//ウィジェット自体の作成するクラスがどれなのかを登録する
//リンクウィジェット
add_action( 'widgets_init' , create_function('', 'return register_widget("my_widgets_item2");'));



//ウィジェットエリアを作成する
function my_widgets_area() {
    
    register_sidebar( array(
        'name' => 'PRODUCTSエリア',
        'id' => 'widget_products',
        'before_widget' => '<div>',
        'after_widget' => '</div>'
    ));
    
    register_sidebar( array(
        'name' => 'NEWS サイドバー',
        'id' => 'my_sidebar',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar( array(
        'name' => 'home products',
        'id' => 'home_products',
        'before_widget' => '<div class="sidebar-products-area">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="product-name">',
        'after_title' => '</h4>'
    ));

    register_sidebar( array(
        'name' => 'home news',
        'id' => 'home_news',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sidebar-title">',
        'after_title' => '</h3>'
    ));
    
    register_sidebar( array(
        'name' => 'home sight_sub_title',
        'id' => 'sight_sub_title',
        'before_widget' => '<p class="circle_detail">',
        'after_widget' => '</p>',
    ));
    
    register_sidebar( array(
        'name' => 'contact_mail_to_address',
        'id' => 'contact_mail_to_address',
        'before_widget' => '',
        'after_widget' => '',
    ));
    
    register_sidebar( array(
        'name' => 'copyright_name',
        'id' => 'copyright_name',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    
    register_sidebar( array(
        'name' => 'sns_link',
        'id' => 'sns_link',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    
    register_sidebar( array(
        'name' => 'profile_name',
        'id' => 'profile_name',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));


}




//ウィジェット自体を作成する
//PRODUCTSエリア用ウィジェットの作成
class my_widgets_item1 extends WP_Widget {
    
    //初期化（管理画面で表示するウィジェットの名前を設定する）
    function my_widgets_item1(){
        parent::WP_Widget(false, $name = 'PRODUCTウィジェット');
    }
    
    // ウィジェットの入力項目を作成する処理
    function form($instance) {
        //入力された情報をサニタイズして変数へ格納
        $title = esc_attr($instance['title']);
        $product_link = esc_attr($instance['product-link']);

        $product_img = esc_attr($instance['product-img']);
        
        $member = esc_attr($instance['member']);
        $time = esc_attr($instance['time']);
        $age = esc_attr($instance['age']);
        $price = esc_attr($instance['price']);
        $body = esc_attr($instance['body']);
    ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php echo 'タイトル：'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('product-link'); ?>">
        <?php echo '作品リンク：'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('product-link'); ?>" name="<?php echo $this->get_field_name('product-link'); ?>" type="text" value="<?php echo $product_link; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('product-img'); ?>">
        <?php echo '写真：'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('product-img'); ?>" name="<?php echo $this->get_field_name('product-img'); ?>" type="text" value="<?php echo $product_img; ?>" />
</p>



<p>
    <label for="<?php echo $this->get_field_id('member'); ?>">
        <?php echo '人数：'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('member'); ?>" name="<?php echo $this->get_field_name('member'); ?>" type="text" value="<?php echo $member; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('time'); ?>">
        <?php echo '時間：'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('time'); ?>" name="<?php echo $this->get_field_name('time'); ?>" type="text" value="<?php echo $time; ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('age'); ?>">
        <?php echo '対象年齢：'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('age'); ?>" name="<?php echo $this->get_field_name('age'); ?>" type="text" value="<?php echo $age; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('price'); ?>">
        <?php echo '価格：'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('price'); ?>" name="<?php echo $this->get_field_name('price'); ?>" type="text" value="<?php echo $price; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('body'); ?>">
        <?php echo '内容：'; ?>
    </label>
    <textarea class="widefat" rows="16" colls="20" id="<?php echo $this->get_field_id('body'); ?>" name="<?php echo $this->get_field_name('body'); ?>"><?php echo $body; ?></textarea>
</p>
<?php
    }
    
    //ウィジェットに入力された情報を保存する処理
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']); //サニタイズ php,htmlタグを取り除く
        $instance['product-link'] = strip_tags($new_instance['product-link']); //サニタイズ php,htmlタグを取り除く

        $instance['product-img'] = strip_tags($new_instance['product-img']); //サニタイズ php,htmlタグを取り除く
        $instance['member'] = strip_tags($new_instance['member']); //サニタイズ php,htmlタグを取り除く
        $instance['time'] = strip_tags($new_instance['time']); //サニタイズ php,htmlタグを取り除く
        $instance['age'] = strip_tags($new_instance['age']); //サニタイズ php,htmlタグを取り除く
        $instance['price'] = strip_tags($new_instance['price']); //サニタイズ php,htmlタグを取り除く

        $instance['body'] = trim($new_instance['body']); //サニタイズ 先頭と最後尾の空白を取り除く
        
        return $instance;
    }
    
    // 管理画面から入力されたウィジェットを画面に表示する処理
    function widget($args, $instance) {
        //配列を変数に展開
        extract($args);
        
        //ウィジェットに入力された情報を取得
        $title = apply_filters( 'widget_title', $instance['title']);
        $product_link = apply_filters( 'widget_product_link', $instance['product-link']);
        $product_img = apply_filters( 'widget_product_img', $instance['product-img']);
        $member = apply_filters( 'widget_member', $instance['member']);
        $time = apply_filters( 'widget_time', $instance['time']);
        $age = apply_filters( 'widget_age', $instance['age']);
        $price = apply_filters( 'widget_price', $instance['price']);
        $body = apply_filters( 'widget_body', $instance['body']);
        
        //ウィジェットから入力された情報がある場合、htmlを表示する
        if( $title ) {
?>

<div class="one-product-area">
    <a href="<?php echo $product_link; ?>"><img src="<?php echo $product_img; ?>" alt=""></a>
    <div class="product-detail">
        <h3><a href="<?php echo $product_link; ?>"><?php echo $title; ?></a></h3>

        <ul>
            <li><i class="fas fa-users"></i><?php echo $member; ?></li>
            <li><i class="fas fa-clock"></i><?php echo $time; ?></li>
            <li><i class="fas fa-child"></i><?php echo $age; ?></li>
            <li><i class="fas fa-yen-sign"></i><?php echo $price; ?></li>
        </ul>

        <P><?php echo $body; ?></P>
    </div>
</div>


<?php
        }
    }
}

//ウィジェット自体を作成する
//リンクウィジェットの作成
class my_widgets_item2 extends WP_Widget {

    //初期化（管理画面で表示するウィジェットの名前を設定する）
    function my_widgets_item2(){
        parent::WP_Widget(false, $name = 'リンクウィジェット');
    }

    // ウィジェットの入力項目を作成する処理
    function form($instance) {
        //入力された情報をサニタイズして変数へ格納
        $text = esc_attr($instance['text']);
        $link = esc_attr($instance['link']);
?>
<p>
    <label for="<?php echo $this->get_field_id('text'); ?>">
        <?php echo 'テキスト：'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('link'); ?>">
        <?php echo 'リンクURL：'; ?>
    </label>
    <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
</p>

<?php
    }

    //ウィジェットに入力された情報を保存する処理
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
//        $instance['text'] = strip_tags($new_instance['text']); //サニタイズ php,htmlタグを取り除く
        $instance['text'] = $new_instance['text']; //サニタイズ php,htmlタグを取り除く

        $instance['link'] = strip_tags($new_instance['link']); //サニタイズ php,htmlタグを取り除く
        return $instance;
    }

    // 管理画面から入力されたウィジェットを画面に表示する処理
    function widget($args, $instance) {
        //配列を変数に展開
        extract($args);

        //ウィジェットに入力された情報を取得
        $text = apply_filters( 'widget_text', $instance['text']);
        $link = apply_filters( 'widget_link', $instance['link']);

        //ウィジェットから入力された情報がある場合、htmlを表示する
        if( $text || $link ) {
?>

<a href="<?php echo $link; ?>"><?php echo $text; ?></a>

<?php
                     }
    }
}

