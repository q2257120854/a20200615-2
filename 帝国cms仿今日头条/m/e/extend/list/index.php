<?php



	require ("../../class/connect.php");
	require ("../../class/db_sql.php");
	$link = db_connect();
	$cha = new mysqlquery();
	$add = $_GET;
	$classid = trim($add[classid],',');
	$orderby = $_GET["orderby"];
	$perNumber = 10;
	$page = $_GET["page"];
	$count = mysql_query("select count(id) as total from phome_ecms_news where classid in($classid)");
	//echo "select count(id) as total from phome_ecms_news where classid in($classid)";
	$rs = mysql_fetch_array($count);
	$totalNumber = $rs[0];
	$totalPage = ceil($totalNumber / $perNumber);

	if (!isset($page)) {
		$page = 1;
	}

	$startCount = ($page - 1) * $perNumber;
	$query = mysql_query("select title,newstime,befrom,id,titlepic,titleurl,diggtop,smalltext from phome_ecms_news where classid in($classid) order by $orderby desc limit $startCount,$perNumber");
	
	while ($row = $cha->fetch($query)) {
		$titlepic=$row['titlepic']?"<dt><img src=\"".$row['titlepic']."\"></dt>":"";
		echo "<li class=\"clear\" rel=\"loaded\">
			<a href=\"" . $row["titleurl"] . "\" title=\"" . $row["title"] . "\">
				<dl>
					<dd>
						<h3>" . $row["title"] . "</h3>
						<i>".$row[befrom]."</i>
					</dd>
					".$titlepic."
				</dl>
			</a>
		</li>";
		
		
	}

	$cha = NULL;


?>
