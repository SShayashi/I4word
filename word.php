<?php

try{
	$dbh=new PDO('mysql:host=localhost;dbname=db25','root','kaogadekai');
}catch(PDOExcepton $e){
	var_dump($e->getMessage());
	exit();
}
$name=$_GET["name"];
?>
<!DOCUTYPE html>
<html jang="ja">
<head>
	<meta charset="utf-8">
	<title>i4word</title>
	<link rel="stylesheet" type="text/css" href="i10023_6.css" media="all">
	<script type="text/javascript" src="i10023_6.js"></script>
	<script type="text/javascript" src="prototype.js"></script>
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
						<a title="言葉作っちゃいなよ" href="make.php">言葉の作成</a>
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
				<div id="crumbs">
					<div id="crumbs-inner">
						<a title="I4辞書トップへ" href="index.php">ホーム</a>
						>>
						<a title="全一覧へ" href="index.php">全一覧</a>
						>>
						<?php echo $name;?>とは
					</div>
				</div>
				<div>
					<?php
						echo "<div id=\"word\"><font size='6' color='#000000' face='Century,Verdana'>".$name."</font>とは";
						echo "<a href='edit.php?name=".$name."'>[編集]</a></div>";//編集のハイパーリンク
						echo "<br/>";
						$sql="select expl from i4T where word='$name' ";
						$stmt = null;
						$stmt=$dbh->query($sql);
						foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $val)
						{
							if(empty($val['expl']))
							{
								echo "<div id=\"word\"><p><font color='#7c7c7c'>説明がありません</font></p><div>";

							}else{
							echo "<div id =\"word\">";
							echo nl2br($val['expl']);
							echo "<br><br></div>";
								}
						}
						$stmt = null;
						$sql="select day from i4T where word='$name' order by day desc limit 1";
						$stmt=$dbh->query($sql);
						foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $val){
							echo "最終更新日時";
							echo $val['day'];
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
