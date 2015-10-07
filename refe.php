<?php

try{
	$dbh=new PDO('mysql:host=localhost;dbname=db25','root','kaogadekai');
}catch(PDOExcepton $e){
	var_dump($e->getMessage());
	exit();
}

@$lang=$_GET['lang'];
?>
<!DOCUTYPE html>
<html jang="ja">
<head>
	<meta charset="utf-8">
	<title>i4word</title>
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
				<div id="crumbs">
					<div id="crumbs-inner">
						<a title="I4辞書トップへ" href="index.php">ホーム</a>
						<?php
						if($lang=="英語"||$lang=="日本語"){
							echo ">>".$lang."一覧";
						}else{
							echo ">>全一覧";
						}
						?>
					</div>
				</div>
				<div class="left-column column float-left">
					<h2>言葉の作成・観覧</h2>
					<div class="sec-menu keisen-white" style="padding-bottom: 150px;"></div>
				</div>
				<div class="left-column column float-left" style="height: 200px; width: 210px; left: 30px; margin-top: 30px;">
					<li style="text-align: left; width: 220px; margin-left: 20px; margin-right: 0px; border-top-width: 0px; margin-top: 5px;">
						<a title="言葉をつくっちゃう？" href="make.php">言葉の作成</a>
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

				<div>
					<?php
						if($lang=="英語"||$lang=="日本語"){
							if($lang=="英語"){
								$sql="select distinct word from i4T order by word";
								$stmt=$dbh->query($sql);
								foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $val){

										/*mb_regex_encoding — 現在のマルチバイト正規表現用のエンコーディングを取得または設定する*/
									    mb_regex_encoding("Shift_jis");
										/*mb_ereg — マルチバイト文字列に正規表現マッチを行う*/
									    if(mb_ereg("[0-9a-zA-Z]", $val['word']) == 1){
									    echo '<a href="word.php?name='.$val['word'].'">'.$val['word'].'</a>';
										echo "<br>";
									    }
								}
							}
							if($lang=="日本語"){
								$sql="select distinct word from i4T order by word";
								$stmt=$dbh->query($sql);
								foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $val){
									    //英数字が使われていたらエラーメッセージ
									    mb_regex_encoding("Shift_jis");
									    if(mb_ereg("[0-9a-zA-Z]", $val['word']) != 1){
									    echo '<a href="word.php?name='.$val['word'].'">'.$val['word'].'</a>';
										echo "<br>";
									    }
								}
							}
						}else{
							$sql="select distinct word from i4T order by word";
							$stmt=$dbh->query($sql);
							foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $val){
								echo '<a href="word.php?name='.$val['word'].'">'.$val['word'].'</a>';
								echo "<br>";
							}
						}
						$dbh = null;
						?>
				</div>

			</div>
		</div>
	</div>

</div>



</body>
</html>
