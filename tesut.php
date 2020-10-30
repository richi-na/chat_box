<?php
//データベースに接続
 $dsn = 'xxxxxxxxx'; 
 $user = 'xxxxxxxxx'; 
 $password = 'xxxxxxxxx'; 
 $dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); 

 //テーブル作成
$sql = "CREATE TABLE IF NOT EXISTS login60" 
." (" 
. "id INT AUTO_INCREMENT PRIMARY KEY,"
. "name char(32)," 
. "mail TEXT,"
. "date DATETIME,"
. "pass TEXT" 
.");";
$stmt = $dbh->query($sql);

// エラーメッセージの初期化 
$errorMessage = ""; 
//本登録ボタンが押された場合 
if(isset($_POST["sub"])) { 
    // 1. ユーザIDの入力チェック 
    if (empty($_POST["name"])) {  // emptyは値が空のとき 
    $errorMessage = 'お名前が未入力です。'; 
    } else if (empty($_POST["password"])) { 
    $errorMessage = 'パスワードが未入力です。'; 
    } else if (empty($_POST["mail"])) { 
    $errorMessage = 'メールアドレスが未入力です。'; 
    }
}

//フォームに入力されたmailがすでに登録されていないかチェック
if(!empty($_POST["name"]) && !empty($_POST["mail"]) && !empty($_POST["pass"])){
    $mail=$_POST["mail"];
    $sql = "SELECT * FROM login60 WHERE mail = :mail";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $stmt->execute();
    $members = $stmt->fetch();
        if ($members['mail'] == $mail) {
        $msg = '同じメールアドレスが存在します。';
        $link = '<a href="sub.php">戻る</a>';
        } else {
        //登録されていなければinsert 
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
         
        
        echo $msg; //メッセージの出力-->
            echo $link;

            $sql = 'SELECT * FROM login60';
            $stmt = $dbh->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                //$rowの中にはテーブルのカラム名が入る
                echo $row['name'].',';
                echo $row['mail'].',';
                echo $row['pass'].'<br>';
            echo "<hr>";
            }
        }
 ?>


 


<!doctype html> 
<html> 
    <head> 
            <meta charset="UTF-8"> 
            <title>本登録</title> 
    </head> 
    <body> 
        <h1>本登録</h1> 
        <form action="" method="POST"> 
            <fieldset> 
                <legend>本登録フォーム</legend> 
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div> 
                <label for="name">お名前</label> 
                <input type="text" name="name" placeholder="登録済みの名前を入力" value="<?php if (!empty($_POST["name"]))  
                {echo htmlspecialchars($_POST["name"],ENT_QUOTES);} ?>"> 
                <br> 
                <label for="mail">メールアドレス</label>
                <input type="text" name="mail" value="" placeholder="メールアドレスを入力"><br>
                <label for="password">パスワード</label>
                <input type="password" name="password" value="" placeholder="パスワードを入力"> 
                <br> 
                <input type="submit" name="sub" value="新規登録"> 
                <p>すでに登録済みの方は
                <a href="login.php">こちら</a>
                </p> 
            </fieldset>
        </form> 
    </body> 
</html>
