<?php
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

?>