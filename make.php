<?php

try{
	$dbh=new PDO('mysql:host=localhost;dbname=db25','root','kaogadekai');
}catch(PDOExcepton $e){
	var_dump($e->getMessage());
	exit();
}
?>
<!DOCUTYPE html>
<html jang="ja">
<head>
	<meta charset="utf-8">
	<title>DB接続</title>
	<link rel="stylesheet" type="text/css" href="i10023_6.css" media="all">
	<script type="text/javascript" src="i10023_6.js"></script>
	<script type="text/javascript" src="lib.js"></script>
</head>
<body>
<div id="container">
	<div id="pagetop" class="clearfix">
		<h1 id="introduction">I4辞書へようこそ！</h1>
		<div id="srchBox">
			<form action="search.php" method="post" id="srch">
			<input type="text" name="word" placeholder="言葉を検索">
			<input type="submit" name="search" value="検索">
			</form>
		</div>
	</div>

	<div id="header" class="clearfix">

		<div id="title">
			<a href="index.php"><img border="0"  src="web_1.jpg" width="250" height="50"></a>
			<div id="description">
				<p style="margin-left: 90px;">「I4の人たちが何を言っているのかがわからない・・・」そんな人たちのために、I4で日々使われている言葉の意味をまとめています。</p>
			</div>
		</div>

	</div>
	<div id="contents" class="clearfix">
		<div id="wrapper">
			<div id="primary-column" class="column">
				<div class="left-column column float-left">
					<h2>言葉の作成・観覧</h2>
					<div class="sec-menu keisen-white" style="padding-bottom: 150px;"></div>
				</div>
				<div class="left-column column float-left" style="height: 200px; width: 210px; left: 30px; margin-top: 30px;">
					<li style="text-align: left; width: 220px; margin-left: 20px; margin-right: 0px; border-top-width: 0px; margin-top: 5px;">
						<a title="言葉を作成する" href="make.php">言葉の作成</a>
						<ul >
							<li style="text-align: left; height: 19px; padding-right: 0px; margin-left: 13px; margin-top: 5px;">
							<a title="全一覧" href="refe.php">全一覧</a>
						</li>
						</ul>
					</li>
					<div style="margin-left: 30px; border-right-width: 0px; margin-top: 20px;">
						・<a href="refe.php?lang=英語">英語の言葉</a>
						<br><br>
						・<a href="refe.php?lang=日本語">日本語の言葉</a>
					</div>
				</div>

				<div id="contents" class="clearfix">
					<div id="wrapper">
						<div id="primary-column" class="column">
							<div id="crumbs">
								<div id="crumbs-inner">
									<a title="I4辞書トップへ" href="index.php">ホーム</a>
									>>言葉作成
								</div>
							</div>
						</div>
					</div>
				</div>
				<div>
					<form action="" method="post">
					<br>
					言葉：
					<input type="text" style="width:300px;" name="word" placeholder="作成する言葉を入力してください">
					<?php

					if(isset($_POST['make'])){

						$word=$_POST['word'];
						$expl=$_POST['expl'];
						$ipAddress = $_SERVER["REMOTE_ADDR"];
						$day=date('Y-m-d H:i:s');
						if(strlen($word)){
							  	}else{
							  	echo "<font color=#ff0000>※言葉が入力されていません</font>";
						}
					}
					?>

					<br>

					<br/>
					説明(多数意味がある場合は意味分けする等して、見る人にわかりやすい形にしましょう。)


					<?php
					if(isset($_POST['make'])){
						if(strlen($expl)){
					  	}else{
						  echo "<font color=#ff0000>※説明が入力されていません</font></p>\n";
						}
					}
					?>
					 <p>
			   		<textarea tabindex="4" rows="20" cols="80"  name="expl" placeholder="説明文を入力してください"></textarea>
			    	</p>
					<input type="submit" name="make" style ="width:100px; height:50px;" id="myButton"value="作成"><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
if(isset($_POST['make'])){

	//何も入力されていないときの処理


	//データベースに入れる処理

	if(strlen($word)&&strlen($expl)){

		//最初に,既にそのワードが登録されていないかを確認
		//wordだけのカラムを全表示
		$sql="select word from i4T where word='$word'";
		$stmt=$dbh->query($sql);

		//foreachで入力した言葉を配列に格納
		foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $val){
		}
		//wordの中に値が入っているか確認する。入っていなければ新しく作る言葉でありTURE入っていれば既にある言葉でありFALSE。
			if(empty($val['word'])){
				$sql="insert into i4T values('','$word','$ipAddress','$day','$expl');";
				$stmt=$dbh->query($sql);
				echo "<script type=\"text/javascript\">
					alert(\"作成完了しました\");
					location.assign('index.php');
					</script>";
				echo "作成完了＾ｑ＾";

			}else{
				echo '<font size =10>※</font><font size=10><a href="word.php?name='.$val['word'] . '">' . $val['word'] . '</a>';
				echo "</font><font size=5>は既に作成されています</font>";
			}

		}
}
$dbh = null;
?>
</body>
</html>
