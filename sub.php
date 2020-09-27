<!DOCTYPE html>
<html lang="ja">
 <head>
     <meta charset=utf-8>
     <title>新規会員登録ページ</title>
 </head>
 <body>
 <!--新規登録機能-->
 <h1>新規会員登録フォーム</h1>
 <form action="" method="post">
         <label>　　名前　　　：<label>
         <input type="text" name="name" placeholder="仮登録で使用した名前"><br>
         <label>メールアドレス：<label>
         <input type="text" name="mail" placeholder="仮登録で使用したアドレス"><br>
         <label>　パスワード　：<label>
         <input type="password" name="pass" placeholder="半角英数字"><br>
         <input class=btn type="submit" name="submit"value="新規登録"><br>
</form>
     <p>すでに登録済みの方は<a href="login.php">こちら</a></p>

 <?php
     //データ接続
     $dsn = 'mysql:dbname=tb220242db;host=localhost';
     $user = 'tb-220242';
     $password = 'N95N7ba6UV';
     $dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
     //テーブル作成
     $sql = "CREATE TABLE IF NOT EXISTS sub"
     ." ("
     . "id INT AUTO_INCREMENT PRIMARY KEY,"
     . "name char(32),"
     . "mail char(255),"
     . "date DATETIME,"
     . "pass char(255)"
     .");";
     $stmt = $dbh->query($sql); 

     //フォームに入力されたmailチェック
     if(!empty($_POST["name"]) && !empty($_POST["mail"]) && !empty($_POST["pass"])){
         $mail=$_POST["mail"];
         $sql = "SELECT * FROM sub WHERE mail = :mail";
         $stmt = $dbh->prepare($sql);
         $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
         $stmt->execute();
         $member = $stmt->fetch();
         if ($member["mail"] == $mail) {//すでにテーブルに存在する場合
             $msg = '同じメールアドレスが存在します。';
             $link = '<a href="login.php">ログインページ</a>';
         } else {//登録されていない場合登録
             $mail=$_POST["mail"];
             $sql = "SELECT * FROM kari_mail_1 WHERE kari_mail = :kari_mail";
             $stmt = $dbh->prepare($sql);
             $stmt->bindParam(':kari_mail', $mail, PDO::PARAM_STR);
             $stmt->execute();
             $kari_member = $stmt->fetch();
             if($_POST["mail"] == $kari_member["kari_mail"]){
                 $name = $_POST["name"];
                 $usermail = $_POST["mail"];
                 $date = date("Y/m/d H:i:s");
                 $pass = $_POST["pass"];
                 $sql = $dbh->prepare("INSERT INTO sub (name, mail, date, pass) VALUES (:name, :mail, :date, :pass)");
                 $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                 $sql -> bindParam(':mail', $usermail, PDO::PARAM_STR);
                 $sql -> bindParam(':date', $date, PDO::PARAM_STR);
                 $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
                 $sql -> execute();
                 $msg = '会員登録が完了しました';
                 $link = '<a href="login.php">ログインページ</a>';
             }else{
                 $msg="メールアドレスが間違っているか、仮登録が行われていません";
                 $link='仮登録ページは<a href="nosub.php">こちら</a>';
             }
             
         }
     }
 ?>
     <h2><?php if(isset($msg)){ echo $msg; }?></h2>
     <h3><?php if(isset($link)){ echo $link; }?></h3>
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

