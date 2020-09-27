<?php
     // DB接続設定
 $dsn = 'mysql:dbname=tb220242db;host=localhost';
 $user = 'tb-220242';
 $password = 'N95N7ba6UV';
 $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-21</title>
    <link rel="stylesheet" href="bmesse.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-left">
                <h1>ROOM:ハードロック</h1>
            </div>
            <div class="header-right">
                <a href="home.php">ホームに戻る</a>
            </div>
        </div>
    </header>
    <div class="top-wrapper" style="overflow:auto;">
        <div class="container">
    <?php  
         $sql = "CREATE TABLE IF NOT EXISTS hard"
 ." ("
 . "id INT AUTO_INCREMENT PRIMARY KEY,"
 . "name char(32),"
 . "comment TEXT,"
 . "created DATETIME,"
 . "pass TEXT"
 .");";
    $stmt = $pdo->query($sql);
    
    $date=date("Y-m-d H:i:s");
     //新規投稿
    if(isset($_POST["Ssubmit"])
        &&!empty($_POST["name"])
        &&!empty($_POST["come"])
        &&empty($_POST["edit_post"])
        &&!empty($_POST["pass1"])){
        $name1=$_POST["name"];
        $comment1=$_POST["come"];
        $pass1=$_POST["pass1"];
         $stmt = $pdo->query($sql);
    $sql = $pdo -> prepare("INSERT INTO hard (name, comment,created, pass) 
    VALUES (:name, :comment, :created, :pass)");
    $sql -> bindParam(':name', $name1, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment1, PDO::PARAM_STR);
    $sql -> bindParam(':created', $date, PDO::PARAM_STR);
    $sql -> bindParam(':pass', $pass1, PDO::PARAM_STR);
    //好きな名前、好きな言葉は自分で決めること
    $sql -> execute();
    }elseif(isset($_POST["Ssubmit"])
        &&!empty($_POST["name"])
        &&!empty($_POST["come"])
        &&!empty($_POST["edit_post"])
        &&!empty($_POST["pass1"])){
        $Ename=$_POST["name"];
        $Ecome=$_POST["come"];
        $pass1=$_POST["pass1"];
            $id =$_POST["edit_post"]; //変更する投稿番号
        //変更したい名前、変更したいコメントは自分で決めること
     $sql = 'UPDATE hard SET name=:name,comment=:comment,created=:created,pass=:pass WHERE id=:id';
     $stmt = $pdo->prepare($sql);
     $stmt->bindParam(':name', $Ename, PDO::PARAM_STR);
     $stmt->bindParam(':comment', $Ecome, PDO::PARAM_STR);
     $stmt->bindParam(':created', $date, PDO::PARAM_STR);
     $stmt->bindParam(':pass', $pass1, PDO::PARAM_STR);
     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
     $stmt->execute();
    }
 
        //削除
    if(isset($_POST["delbox"])&&!empty($_POST["pass2"])){
        $pass2=$_POST["pass2"];
        $Dnum=$_POST["del"];
            $id=$Dnum;
                $sql = 'SELECT * FROM hard WHERE id=:id ';
        $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
        $stmt->execute();                             // ←SQLを実行する。
        $results = $stmt->fetchAll(); 
	        foreach ($results as $row){
	            if($pass2==$row['pass']){
	                   $id = $Dnum;
                    $sql = 'delete from hard where id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
	            }else{
	            }
	            
	        }
    }else{
        
    }
 
        //編集
    $editNumber="";
    $editName="";
    $editComment="";
    if(isset($_POST["Esubmit"])){
        $pass3=$_POST["pass3"];
        $id = $_POST["Enum"] ; // idがこの値のデータだけを抽出したい、とする

        $sql = 'SELECT * FROM hard WHERE id=:id ';
        $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
        $stmt->execute();                             // ←SQLを実行する。
        $results = $stmt->fetchAll(); 
	foreach ($results as $row){
	    if($pass3==$row['pass']){
		//$rowの中にはテーブルのカラム名が入る
		$editNumber=$row['id'];
		$editName=$row['name'];
		$editComment=$row['comment'];
	    }
	}
    }

    $sql = 'SELECT * FROM hard';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
        foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
            echo $row['id'].' ';
            echo $row['name'].' ';
            echo $row['created'].'<br>';
            echo $row['comment'].' ';
            echo "<hr>";
            }
?>
</div>
</div>
    
    <fotter>
    <div class="container">
        <div class="form">
    <form action="" method="post">
        <input type="hidden" name="edit_post"
        value="<?php if(!empty($editNumber)){echo $editNumber;}?>">
        <input type="text" name="name" placeholder="お名前"
        value="<?php if(!empty($editName)){echo $editName;}else{}
        if(!empty($_POST["name"])){echo htmlspecialchars($_POST["name"],ENT_QUOTES);}?>">
        <textarea  name="come" placeholder="コメント"
        value="<?php if(!empty($editComment)){echo $editComment;}?>"></textarea>
        <input type="text" name="pass1" placeholder="password">
        <input type="submit" name="Ssubmit"><br>
        <input type="number" name="del" size="1" placeholder="削除対象番号">
        <input type="text" name="pass2" placeholder="password" 
        value="<?php if(!empty($_POST["pass1"])){echo htmlspecialchars($_POST["pass1"],ENT_QUOTES);}?>">
        <input type="submit" name="delbox" value="削除"><br>
        <input type="number" name="Enum" placeholder="編集番号">
        <input type="text" name="pass3" placeholder="password">
        <input type="submit" name="Esubmit" value="編集">
        
    </form>
    </div>
    </div>
        </fotter>

</body>
</html>