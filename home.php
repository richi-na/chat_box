<?php
session_start();
$dsn = 'xxxxxxxxx';
$user = 'xxxxxxxxx';
$password = 'xxxxxxxxx';
$dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
if (isset($_SESSION['id'])) {//ログインしているとき
    $username = $_SESSION['name'];
    $msg = 'こんにちは' . htmlspecialchars($username, \ENT_QUOTES, 'UTF-8') . 'さん';
    $link = '<a href="logout.php">ログアウト</a>';
} else {//ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="login2.php">ログイン</a>';
}



?>

        <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUSICBOX</title>
    <link rel="stylesheet" href="simple.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a0f5cf51b1.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <div class="container">
        <div class="header-left">
          <a><?php echo $msg.$link; ?></a>
          <?php if(isset($_SESSION["id"])):?>
          <h1>MUSICBOX</h1>
        </div>
        <div class="header-right">
          <a href="honn.php">新規登録</a>
          <a href="login2.php">ログイン</a>
        </div>
      </div>
    </header>
    <div class="top-wrapper">
      <div class="container">
        <h1>EVERYDAY IS A NEW DAY.</h1>
        <p>MUSICBOXは匿名チャット交流サービスです。</p>
        <p>世の中にはあなたの知らない"音楽"がたくさんあります。</p>
        <p>まだ見ぬ世界中の音楽に触れる機会として是非お役立てください。</p>

      </div>
    </div>
    <div class="lesson-wrapper">
      <div class="container">
        <div class="heading">
          <h2>音楽のジャンルを発祥時代ごとに区分けしました<br>さっそく気になる時代から見ていきましょう!</h2>
          <p>※ジャンルを選ぶとチャットルームに飛びます。</p>
        </div>
        <div class="btn-wrapper">
          
        <div class="lesson">
            <div class="hidden_box">
              <label for="label1">
              <a class="btn music">-1900s</a>
              </label>
              <input type="checkbox" id="label1">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
                <li><a href="https://tb-220242.tech-base.net/music.php">クラシック</a></li>
                <p class="text-contents">古典西洋音楽。オペラやミュージカルといった舞台音楽も含まれる。</p>
                <li><a href="https://tb-220242.tech-base.net/jazz.php">ジャズ</a></li>
                <p class="text-contents">アメリカ南部都市で発祥。ヨーロッパ音楽＋アフリカ系アメリカ人のリズム感＋民族音楽</p>
                <li><a href="https://tb-220242.tech-base.net/blue.php">ブルース</a></li>
                <p class="text-contents">米国深南部でアフリカ系アメリカ人の間で発祥。ギターを用いた歌が主役。</p>
                <li><a href="https://tb-220242.tech-base.net/gos.php">ゴスペル</a></li>
                <p class="text-contents">アメリカ発祥。キリスト教プロテスタントの福音音楽。</p>
                <li><a href="https://tb-220242.tech-base.net/fork.php">フォーク</a></li>
                <p class="text-contents">民謡、民族音楽</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>
          
          <div class="lesson">
            <div class="hidden_box">
              <label for="label2">
              <a class="btn sports"></span>-1930s</a>
              </label>
              <input type="checkbox" id="label2">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
                <li><a href="https://tb-220242.tech-base.net/country.php">カントリー</a></li>
                <p class="text-contents">アメリカ発祥。シンプルなハーモニーが特徴で、バラードからダンス音楽まで様々な音楽性をもつ</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>

          <div class="lesson">
            <div class="hidden_box">
              <label for="label3">
              <a class="btn food">-1940s</a>
              </label>
              <input type="checkbox" id="label3">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
              <li><a href="https://tb-220242.tech-base.net/r&b.php">R＆B</a></li>
              <p class="text-contents">リズム＆ブルース。リズム、ビートに乗りながらブルースやゴスペル調の歌を叫ぶように歌うのが特徴。ブラックミュージックの発展形</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>

          <div class="lesson">
            <div class="hidden_box">
              <label for="label4">
              <a class="btn travel">-1950s</a>
              </label>
              <input type="checkbox" id="label4">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
              <li><a href="https://tb-220242.tech-base.net/r&r.php">R＆R</a></li>
              <p class="text-contents">ロックンロール。アメリカの大衆音楽。R&Bやブルースなどの黒人音楽をベースに、
              カントリーなどの白人音楽が融合。</p>
              <li><a href="https://tb-220242.tech-base.net/soul.php">ソウル</a></li>
              <p class="text-contents">アフリカ系アメリカ人のゴスペルとブルースから発展。ゴスペルより濃厚な音楽のことを言う。</p>
              <li><a href="https://tb-220242.tech-base.net/pop.php">ポップ・ミュージック</a></li>
              <p class="text-contents">R&Rから派生。様々なジャンルから影響。長さが短～中程度で、ベーシックな様式、同一のコーラスやメロディや
              耳に残るフレーズが反復される特徴がある。</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>

          <div class="lesson">
            <div class="hidden_box">
              <label for="label5">
              <a class="btn game">1960s</a>
              </label>
              <input type="checkbox" id="label5">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
              <li><a href="https://tb-220242.tech-base.net/fank.php">ファンク</a></li>
              <p class="text-contents">ソウルミュージックの派生。バックビートを意識した16ビートのリズムとフレーズの反復を多用。
              ダンスミュージックとしての色彩が強い。</p>
              <li><a href="https://tb-220242.tech-base.net/rock.php">ロック</a></li>
              <p class="text-contents">R＆Rより、ブルース、フォーク、ジャズ、クラシックなど他のジャンルの影響を受けている。
              主にエレクトリックな楽器編成。パンク、ヘヴィメタルなど派生が多様的。</p>
              <li><a href="https://tb-220242.tech-base.net/fujon.php">フュージョン</a></li>
              <p class="text-contents">ジャズをベースに、ロック、ラテン音楽、R&B、電子音楽を融合(フュージョン)
              ボーカルがないことが特徴</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>

          <div class="lesson">
            <div class="hidden_box">
              <label for="label6">
              <a class="btn study">-1970s</a>
              </label>
              <input type="checkbox" id="label6">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
              <li><a href="https://tb-220242.tech-base.net/hard.php">ハードロック</a></li>
              <p class="text-contents">ブルースをベースとした激しいロック。歪んだ音のエレクトリックギターを強調したサウンドが特徴。</p>
              <li><a href="https://tb-220242.tech-base.net/pank.php">パンク</a></li>
              <p class="text-contents">ブルースが払拭され、スピード感のある簡素なロック</p>
              <li><a href="https://tb-220242.tech-base.net/heavy.php">ヘヴィーメタル</a></li>
              <p class="text-contents">ハードロックの延長線上にあり「ヘヴィ」さが特徴。ギターやベースのチューニングを下げている。</p>
              <li><a href="https://tb-220242.tech-base.net/disco.php">ディスコ</a></li>
              <p class="text-contents">ダンスミュージックの一種。音量の大きい反響するボーカル、一定のリズムを刻む４打ち、
              ８音符ないし１６分音符刻みかつオフビートでオープンするハイハットパターン。</p>
              <li><a href="https://tb-220242.tech-base.net/house.php">ハウス</a></li>
              <p class="text-contents">アメリカシカゴ発祥。初期はR&Bを音源にゲイ(性差別)をテーマとし、
              現代はポップスを音源にミックス技術をテーマとする。</p>
              <li><a href="https://tb-220242.tech-base.net/hiphop.php">HIP HOP</a></li>
              <p class="text-contents">ラップ、DJ、ブレイクダンス、グラフィティが四大要素。
              音楽としては、バックトラックに、MCによるラップを乗せた形態。</p>
              <li><a href="https://tb-220242.tech-base.net/horock.php">邦ロック</a></li>
              <p class="text-contents">日本のロックバンドが誕生</p>
              <li><a href="https://tb-220242.tech-base.net/idol.php">アイドル歌謡</a></li>
              <p class="text-contents">日本のアイドルが誕生</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>

          <div class="lesson">
            <div class="hidden_box">
              <label for="label7">
              <a class="btn vehicle">-1980s</a>
              </label>
              <input type="checkbox" id="label7">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
              <li><a href="https://tb-220242.tech-base.net/city.php">シティポップ</a></li>
              <p class="text-contents">ニューミュージックの中でも特に都会的に洗練され、
              洋楽志向のメロディや歌詞を持ったポピュラー音楽</p>
              <li><a href="https://tb-220242.tech-base.net/anime.php">アニメソング</a></li>
              <p class="text-contents">アニメのテーマソング</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>

          <div class="lesson">
            <div class="hidden_box">
              <label for="label8">
              <a class="btn shopping">-1990s</a>
              </label>
              <input type="checkbox" id="label8">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
              <li><a href="https://tb-220242.tech-base.net/edm.php">EDM</a></li>
              <p class="text-contents">エレクトリック・ダンス・ミュージック。シンセサイザーやシーケンサーを用い、主にクラブないしは音楽を中心にとらえるダンスミュージック。</p>
              <li><a href="https://tb-220242.tech-base.net/vidual.php">ヴィジュアル系</a></li>
              <p class="text-contents">日本のロックバンド。化粧やファッション等の視覚的表現で世界観や様式美を構築。</p>
              <li><a href="https://tb-220242.tech-base.net/jpop.php">J-POP</a></li>
              <p class="text-contents">日本のポピュラーソング</p>
              <li><a href="https://tb-220242.tech-base.net/kpop.php">K-POP</a></li>
              <p class="text-contents">J-POPに影響を受け大韓民国発祥の「コリアンポップス」</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>

          <div class="lesson">
            <div class="hidden_box">
              <label for="label9">
              <a class="btn restaurant">-2000s</a>
              </label>
              <input type="checkbox" id="label9">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
              <li><a href="https://tb-220242.tech-base.net/shibuya.php">渋谷系</a></li>
              <p class="text-contents">東京都の渋谷を発信地として流行したポピュラー音楽</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>
          
          <div class="lesson">
            <div class="hidden_box">
              <label for="label10">
              <a class="btn comic">-2010s</a>
              </label>
              <input type="checkbox" id="label10">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
              <li><a href="https://tb-220242.tech-base.net/vocalo.php">ボーカロイド</a></li>
              <p class="text-contents">音声合成技術で人の声をもとに歌声を合成できることから、
              無名の作曲らが動画コンテンツを通して配信を行う。</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>
          <div class="lesson">
            <div class="hidden_box">
              <label for="label11">
              <a class="btn anime">-2020s</a>
              </label>
              <input type="checkbox" id="label11">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
              <li><a href="https://tb-220242.tech-base.net/neo.php">ネオシティポップ</a></li>
              <p class="text-contents">シティポップを新しく洗練したポップス</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>
          <div class="lesson">
            <div class="hidden_box">
              <label for="label12">
              <a class="btn gavament">now</a>
              </label>
              <input type="checkbox" id="label12">
            <div class="hidden_show">
              <!--非表示ここから-->     
              <ul>
              <li>？？</li>
              <p class="text-contents">研究中・・・</p>
              </ul>
              <!--ここまで-->
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="message-wrapper">
      <div class="container">
        <div class="message-form">
          <h4>お問い合わせフォーム</h4><br>
          <p>「ジャンルを増やしてほしい」「ここに修正が必要だ」等、ご意見を頂ければ幸いです。</p>
          <form action="" method="post">
          <label for="name">お名前： </label><input id="name" type="text" name="name" placeholder="お名前"><br>
          <label for="comment">コメント:</label><textarea id="comment" name="comment"　placeholder="「ジャンルを増やしてほしい」「ここに修正が必要だ」等ご自由にどうぞ。"></textarea><br>
          <input type="submit"  name="submit" value="送信する">
          </form>
        <?php  

$dsn = 'mysql:dbname=tb220242db;host=localhost';
$user = 'tb-220242';
$password = 'N95N7ba6UV';
$dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = "CREATE TABLE IF NOT EXISTS form"
." ("
. "name char(32),"
. "comment TEXT"
.");";
   $stmt = $dbh->query($sql);
    //新規投稿
   if(isset($_POST["submit"])
       &&!empty($_POST["name"])
       &&!empty($_POST["comment"])){
       $name=$_POST["name"];
       $comment=$_POST["comment"];
        $stmt = $dbh->query($sql);
   $sql = $dbh -> prepare("INSERT INTO form (name, comment) 
   VALUES (:name, :comment)");
   $sql -> bindParam(':name', $name, PDO::PARAM_STR);
   $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
   $sql -> execute();
   $message="送信されました！";
       }

        if(isset($message)){
          echo $message;
            }else{}
        ?>

        </div>
      </div>
    </div>
    <footer>
      <div class="container">
        <p>参考☞<a href="indoorlife.xxxxxxxx.jp">indoorlife.xxxxxxxx.jp</a></p>
      </div>
    </footer>
  </body>
</html>

<?php endif;?>
