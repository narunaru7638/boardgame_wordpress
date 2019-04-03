<!-- footer -->

<!--<p id="copyright">Copyright <a href="https://twitter.com/narumismis">なる</a>. All Rights Reserved.</p>-->

<p id="copyright">Copyright <?php dynamic_sidebar( 'copyright_name' ); ?>. All Rights Reserved.</p>


</footer>
<script src="/boardgame_wordpress/wp-content/themes/boardgame/js/vendor/jquery-2.2.2.min.js"></script>

<script type="text/javascript">
jQuery(function($){
    
//フラッシュメッセージ
//DOMを変数に入れる。DOMが入った変数名には$をつける。
var $msgShow = $('#js-show-msg');
//DOMのテキスト内容を変数に入れる。
var msg = $msgShow.text();
//replaceで余分なスペース、タブを無くし、長さ(中身があるか)を確認
if(msg.replace(/^[\s　]+|[\s　]+$/g, "").length){
$msgShow.slideToggle('slow');
setTimeout(function(){ $msgShow.slideToggle('slow')}, 5000 );
}
    
});
</script>

</body>
</html>