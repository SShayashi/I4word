<?php

try{
	$dbh=new PDO('mysql:host=localhost;dbname=db25','root','kaogadekai');
}catch(PDOExcepton $e){
	var_dump($e->getMessage());
	exit();
}


		$sql="select * from i4T order by day desc limit 1";
		$stmt=$dbh->query($sql);
		foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $val){
		}

?>
<!DOCUTYPE html>
<html>
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
				<div id="a756" class="section center">
					<h4  style="padding-top: 10px; padding-bottom: 10px;">I4専用辞書とは？</h4>
					<div class="entry-body keisen-white">
						<h3>情報工学科4年が作るweb辞書である。</h3>
						<p>私は、情報工学科4年（以下I4とする）で使われている言葉の中に、一般人には理解できない言葉が含まれていることに気が付いた。</p>
						<p>そこで、この林が作った辞書を活用してもらいたい。この辞書にはI4内で使われている言葉が登録されており、I4独自の意味を登録している。</p>
						<p>更に、この辞書は誰でも編集可能である。利用者の方には、I4で使われている言葉をどんどんと登録してもらいたい。</p>
						<p><b>※編集者のIPアドレスは保管しています。荒らし行為はご遠慮ください</b></p>

					</div>

				</div>
				<div class="left-column column float-left">
					<h2>言葉の作成・観覧</h2>
					<div class="sec-menu keisen-white" style="padding-bottom: 150px;">
					</div>
				</div>
				<div class="left-column column float-left" style="height: 200px; width: 210px; left: 30px; margin-top: 30px;">
					<li style="text-align: left; width: 220px; margin-left: 20px; margin-right: 0px; border-top-width: 0px; margin-top: 5px;">
						<a title="言葉をつくろう！" href="make.php">言葉の作成</a>
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
				<div class="right-column column float-right" style="top: -235px; width: 185px;">
					<h2>プロフィール</h2>
					<div class="sec-menu keisen-white" style="padding-bottom: 60px;">
						<div>
							<a title="我らがI4の担任">
								<img width="150 height="150" alt="ITO" src="ito.jpg">
							</a>
						</div>
							<p>林です。このページを訪れた方は、是非言葉を作成していってください。</p>
					</div>
				</div>


				<div class="right-column column float-bottom" style="top: px; width: 660px; height: 200px;">
					<h2>最近更新された言葉</h2>
					<div class="sec-menu keisen-white">

						<div>

						</div>
								<p><div id ="word"><font size=6 color =#000000><?php
								echo $val['word'];
								?></font><?php echo "<a href='edit.php?name=".$val['word']."'>[編集]</a></div>";//編集のハイパーリンク
								?>
								</p>
								<?php
								echo "<div id =\"word\">";
								echo nl2br($val['expl']);
								echo "<br></div>";

								echo "最終更新日時";
								echo $val['day'];

								echo "　　　IP ：";
								echo $val['ip'];
								$dbh = null;
								?>
						<div>

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php?>
</body>
</html>
