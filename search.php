<?php

try{
	$dbh=new PDO('mysql:host=localhost;dbname=db25','db25','db25pass');
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
				<div id="crumbs">
					<div id="crumbs-inner">
						<a title="I4辞書トップへ" href="index.php">ホーム</a>
					</div>
				</div>
				<div class="left-column column float-left">
					<h2>言葉の作成・観覧</h2>
					<div class="sec-menu keisen-white" style="padding-bottom: 150px;">
					</div>
				</div>
				<div class="left-column column float-left" style="height: 200px; width: 210px; left: 30px; margin-top: 30px;">
					<li style="text-align: left; width: 220px; margin-left: 20px; margin-right: 0px; border-top-width: 0px; margin-top: 5px;">
						<a title="言葉つくりましょーや" href="make.php">言葉の作成</a>
						<ul >
							<li style="text-align: left; height: 19px; padding-right: 0px; margin-left: 13px; margin-top: 5px;">
								<a title="全て一覧！" href="refe.php">全一覧</a>
							</li>
						</ul>
						
					</li>
					<div style="margin-left: 30px; border-right-width: 0px; margin-top: 20px;">
						・<a href="refe.php?lang=英語">英語の言葉</a>
						<br><br>
						・<a href="refe.php?lang=日本語">日本語の言葉</a>
					</div>
				</div>
				<br>
				<div>
					<?php
						if(isset($_POST['search'])){

							$cnt = 0;
							$word=$_POST['word'];
							if(empty($word)){
								echo "<script type=\"text/javascript\">
											location.assign('index.php');
											</script>";
							}
							$sql="select word from i4T where word like '%".$word."%'";
							$stmt=$dbh->query($sql);
							//一つも存在しない場合は$stmtは実行できない（空である）ためif文で分岐　空ならエラーメッセージ
							if(empty($stmt)){
								echo "<font size='5' color='#000000' face='Century,Verdana'>キーワード：".$word."に一致する言葉はありませんでした</font>";
							}else{
								foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $val){
								$cnt++;
								}



								if($cnt==0){
									echo"<font size='5' color='#000000' face='Century,Verdana'>キーワード：「".$word."」に一致する言葉はありませんでした</font>";
									}else{
										echo "<div id=\"word\"><font size='5' color='#000000' face='Century,Verdana'>キーワード：「".$word."」</font>";
											
										echo "<font   size='4' color='#000000' face='Century,Verdana'>".$cnt."件見つかりました！</font>";
										echo "</div>";

										
										//ここまではとおってきてる
										
										$stmt=null;
										$sql="select word from i4T where word like '%".$word."%'";
										$stmt=$dbh->query($sql);
										foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $val){
											echo '<a href="word.php?name='.$val['word'].'">'.$val['word'].'</a>';
											echo "<br>";	
										}																			
									}
							}
								//echo '<a href="word.php?name='.$val['word'] . '">' . $val['word'] . '</a>';
							/*	
							ファイル名の後の「？」がリクエストストリングスであることを示すお約束である。必ず 
							名前=値の書式をしていてこれを「URLパラメータ」や単に「パラメータ」と呼びます。
							「name="変数"」は、「 パラメータ名 name の値が "変数" である 」ということをあらわしています。パラメータがいくつもある時は「&」で区切ります。
							例：　<a href="http://xxxxxxx/index.php?user=Yuji&age=20">Click</a>
							*/
							$dbh = null;
							}
					?>
				</div>

			</div>			
		</div>
	</div>
</div>

</body>
</html>