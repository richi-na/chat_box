<!DOCTYPE html>
 <html lang="ja">
 <head>
     <meta chrset=utf-8>
     <title>ログアウトページ</title>
 </head>
<body>
<?php
 session_start();
 $_SESSION = array();//セッションの中身をすべて削除
 session_destroy();//セッションを破壊
 ?>

 <p>ログアウトしました。</p>
 <a href="login.php">再ログイン</a>
 </body>
</html>