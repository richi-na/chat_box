<!DOCTYPE html>
 <html lang="ja">
 <head>
     <meta chrset=utf-8>
     <title>ログインページ</title>
 </head>
 <body>
 <!--ログイン機能-->
 <h1>ログインフォーム</h1>
  <form action="" method="post">
         <label>メールアドレス：<label>
         <input type="text" name="mail" placeholder="登録済みのアドレス"><br>
         <label>　パスワード　：<label>
         <input type="password" name="pass" placeholder="半角英数字"><br>
         <input class=btn type="submit" name="submit" value="ログイン"><br>
   </form>
   <p>新規の方は<a href="nosub.php">こちら</a></p>
 <?php
 session_start();
 $dsn = 'xxxxxxxxx';
 $user = 'xxxxxxxxx';
 $password = 'xxxxxxxxx';
 $dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

 if(!empty($_POST["mail"]) && !empty($_POST["pass"])){
     $mail = $_POST['mail'];
     $pass = $_POST["pass"];
     $sql = "SELECT * FROM sub WHERE mail = :mail";
     $stmt = $dbh->prepare($sql);
     $stmt->bindValue(':mail', $mail);
     $stmt->execute();
     $members = $stmt->fetchAll();
     foreach($members as $member){
         $member_pass=$member['pass'];
     }
     if(!isset($member_pass)){
         $msg="メールアドレスもしくはパスワードが間違っています";
         $link = '新規登録は<a href="nosub.php">こちら</a>';
     }else{
     if ($member_pass==$pass){//DBのユーザー情報をセッションに保存
         $_SESSION['id'] = $member['id'];
         $_SESSION['name'] = $member['name'];
         $_SESSION['pass'] = $member['pass'];
         $msg = 'ログインしました。';
         $link = 'ホームページは<a href="home.php">こちら</a>';
     } else{
         $msg = 'メールアドレスもしくはパスワードが間違っています。';
         $link = '新規登録は<a href="nosub.php">こちら</a>';
     }
    }
  }
 ?>
<h3><?php if(isset($msg)){ echo $msg; }?></h3>
 <h3><?php if(isset($link)){ echo $link; }?><h3>
</body>
<style>
body{
     margin:0 auto;
     margin-top:100px;
     text-align:center;
     width:40%;
     padding-top:0;
     padding-bottom:20px;
     background-color:#FFF;
     border-style:solid;
     border-color:#808080;
     border-radius:10px;
     box-shadow: 5px 2px 3px 0 #C0C0C0;
 }
 input {
  width: 200px;
  padding: 5px;
  font-size: 18px;
  border: 2px solid #a9a9a9; 
}

    .btn{
        background-color: #a9a9a9;
        margin-top: 30px;
        width: 210px;
        padding: 5px;
        border-radius: 3px;
        transition: .3s ease-out;
    }
 </style>
</html>
