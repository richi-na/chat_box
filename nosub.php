<!DOCTYPE html>
<html lang="ja">
 <head>
     <meta charset=utf-8>
     <title>新規会員登録ページ</title>
 </head>
<body>
 <!--仮登録-->
 <h1>仮登録フォーム</h1>
 <form action="" method="post">
     <label>　　名前　　　：<label>
     <input type=text name=name placeholder="なんでもOK"><br>
     <label>メールアドレス：<label>
     <input type=text name=kari_mail placeholder="利用可能なアドレス"><br>
     <input class=btn type=submit name=submit value="送信">
 </form>
 <p>すでに会員の方は<a href="login.php">こちら</a></p>
 <?php
 $dsn = 'mysql:dbname=tb220242db;host=localhost';
 $user = 'tb-220242';
 $password = 'N95N7ba6UV';
 $dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

 $sql = "CREATE TABLE IF NOT EXISTS kari_mail_1"
 ." ("
 . "id INT AUTO_INCREMENT PRIMARY KEY,"
 . "name varchar(35),"
 . "kari_mail varchar(255)"
 .");";
 $stmt = $dbh->query($sql);
 
 if(!empty($_POST["kari_mail"]) && !empty($_POST["name"])){
    $kari_mail=$_POST["kari_mail"];
    $sql = "SELECT * FROM sub WHERE mail = :mail";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':mail', $kari_mail, PDO::PARAM_STR);
    $stmt->execute();
    $member = $stmt->fetch();
    if ($member["mail"] == $kari_mail) {//すでにテーブルに存在する場合
        echo '<br>'.'同じメールアドレスが存在します。'.'<br>';
        echo '<a href="login.php">ログインページ</a>';
    }else{
     $kari_mail=$_POST["kari_mail"];//存在しない場合
     $name=$_POST["name"];
     $sql = $dbh->prepare("INSERT INTO kari_mail_1 (kari_mail) VALUES (:kari_mail)");
     $sql -> bindParam(':kari_mail', $kari_mail, PDO::PARAM_STR);
     $sql -> execute();
     
     require 'src/Exception.php';
     require 'src/PHPMailer.php';
     require 'src/SMTP.php';
     require 'setting.php';
     $mail = new PHPMailer\PHPMailer\PHPMailer();
     $mail->isSMTP(); 
     $mail->SMTPAuth = true;
     $mail->Host = MAIL_HOST;
     $mail->Username = MAIL_USERNAME;
     $mail->Password = MAIL_PASSWORD;
     $mail->SMTPSecure = MAIL_ENCRPT;
     $mail->Port = SMTP_PORT;

     // メール内容設定
     $mail->CharSet = "UTF-8";
     $mail->Encoding = "base64";
     $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);
     $mail->addAddress($kari_mail); 
     $mail->addReplyTo('richina0509@gmail.com');
     $mail->Subject = MAIL_SUBJECT; 
     $mail->isHTML(true);   
     $body = 'こんにちは' .htmlspecialchars($name, \ENT_QUOTES, 'UTF-8').'さん'."<br>"."<br>".
            "まだ登録は完了してません。"."<br>"."下記のURLから本登録をお願いいたします。"."<br>".
            "https://tb-220242.tech-base.net/sub.php"."<br>"."<br>"
            ."りいな";

     $mail->Body  = $body; 

     // メール送信の実行
     if(!$mail->send()) {
         $msg= 'メッセージは送られませんでした。'."<br>".'メールアドレスをご確認ください。'."<br>"
         .'Mailer Error:' . $mail->ErrorInfo;
     } else {
         $msg= "<br>"."メールを送信しました。メール内のURLから本登録をお願いします。";
     }
 }
}
 ?>
     <h3><?php if(isset($msg)){ echo $msg; }?></h3>
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
</body>
</html>