<?php

try{
	$dbh=new PDO('mysql:host=localhost;dbname=db25','root','kaogadekai');
}catch(PDOExcepton $e){
	var_dump($e->getMessage());
	exit();
}
$name=$_REQUEST["name"];
/*
		POST形式、GET形式のどちらも使用する場合には$_REQUESTが便利で、
		$_REQUESTにはPOST形式のデータもGET形式のデータも両方格納されます。
		通常、データ送信の形式が決まっている場合にはその形式の連想配列
		（$_GETか$_POST）を、同じスクリプト内でどちらの形式も使用する場合には
		$_REQUESTを使用します。
		今回はゲットで受け取った値をテキストボックスに入れて、その後POST通信で
		submitするため、requestを利用します。
		※request通信は便利だが本来POSTで送るものも、get通信のように送るため
		セキュリティ上あまりよろしくない。
		*/
if(isset($_POST['update'])){
		@$oldword=$_POST['oldword'];
		$word=$_POST['word'];
		$expl=$_POST['expl'];
		$ipAddress = $_SERVER["REMOTE_ADDR"];
		$day=date('Y-m-d H:i:s');
}
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
		<h1 id="introduction"><?php echo $name;?>の編集</h1>
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
						>>
						<a title="全一覧へ" href="refe.php">全一覧</a>
						>>
						<a title="全一<?php echo $name;?>覧へ" href="word.php?name=<?php   echo $name;?>"><?php echo $name;?>とは</a>
						>><?php echo $name;?>の編集
					</div>
				</div>
				<div>


				</div>
				<div>
					<form action="" method="post">
					<br>
						<input type="hidden" name="oldword" value="<?php echo $name;?>">
						言葉：<input type="text" name="word" value="<?php echo $name; ?>">
						<?php
							/*＠マークによってエラーを無視する*/


							if(isset($_POST['update'])){
								if(strlen($word)){
								  	}else{
								  	 echo "<font color=#ff0000>※言葉が入力されていません</font>";
									}
							}
							?>

						<br><br>
						<p>
							説明(多数意味がある場合は意味分けする等して、見る人にわかりやすい形にしましょう。)
							<br>
							<?php
							if(isset($_POST['update'])){
								if(strlen($expl)){
								  	}else{
								  	 echo "<font color=#ff0000>※説明が入力されていません</font></p>";
									}
							}
							?>
							<textarea tabindex="4" rows="30" cols="80"  name="expl"><?php
							$cnt=1;
							$sql="select distinct expl from i4T where word='$name' ";
							$stmt=$dbh->query($sql);
							foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $val){
								echo $val['expl'];
								}
							?></textarea>
				    	</p>
						<input type="submit" name="update" style ="width:100px; height:50px;" id="up"value="更新">
					</form>
				</div>
				<div class="left-column column float-left">
					<h2>言葉の作成・観覧</h2>
					<div class="sec-menu keisen-white" style="padding-bottom: 150px;">
					</div>
				</div>



				<div class="left-column column float-left" style="height: 200px; width: 210px; left: 30px; margin-top: 30px;">
					<li style="text-align: left; width: 220px; margin-left: 20px; margin-right: 0px; border-top-width: 0px; margin-top: 5px;">
						<a title="こっちみんな" href="make.php">言葉の作成</a>
					<ul >
						<li style="text-align: left; height: 19px; padding-right: 0px; margin-left: 13px; margin-top: 5px;">
							<a title="はじめてのブログ" href="refe.php">全一覧</a>
						</li>
					</ul>

					</li>
					<div style="margin-left: 30px; border-right-width: 0px; margin-top: 20px;">
						・<a href="refe.php?lang=英語">英語の言葉</a>
						<br><br>
						・<a href="refe.php?lang=日本語">日本語の言葉</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
if(isset($_POST['update'])){

	//何も入力されていないときの処理
	//データベースで更新する処理、最初のif文でワード、もしくは説明が空でないかを確認

	if(strlen($word)&&strlen($expl)){

		//ワードが変更されていないかを確認し、ワードが変更されていなければ、そのまま更新
		if($oldword==$word){
			$sql="update i4T set word='$word',expl='$expl',ip='$ipAddress',day='$day' where word='$oldword'";
				$stmt=$dbh->query($sql);
				echo "<script type=\"text/javascript\">
					alert(\"更新完了しました\");
					location.assign('index.php');
					</script>";
				echo "作成完了＾ｑ＾";

		}

		//ワードが変更されている場合、そのワードが既に存在していないかを確認する
		if($oldword!=$word){

			//ワードが変更されているので、その変更先のワードを条件にデータベースを参照する
			$stmt=null;
			$sql="select word from i4T where word='$word'";
			$stmt=$dbh->query($sql);
			//foreachで入力した言葉を配列に格納
			foreach( $stmt->fetchAll(PDO::FETCH_ASSOC) as $val){
			}

			//存在していなければTURE＿存在すればFALSE。
			if(empty($val['word'])){
				$stmt=null;
				$sql="update i4T set word='$word',expl='$expl',ip='$ipAddress',day='$day' where word='$oldword'";
				$stmt=$dbh->query($sql);

				echo "<script type=\"text/javascript\">
					alert(\"更新完了しました\");
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
}
?>


</body>
</html>
