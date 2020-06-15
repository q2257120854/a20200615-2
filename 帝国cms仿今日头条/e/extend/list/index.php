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
		if(!empty($row["titlepic"])){
			$titlepic="<div class=\"lbox left\"><a href=\"" . $row["titleurl"] . "\" target=\"_blank\"><img class=\"feedimg\" src=\"" . $row["titlepic"]. "\" onload=\"this.style.opacity=1;\" style=\"opacity: 1;\"></a></div><div class=\"rbox\"><!--hold-->";
			$titlepic2="</div>";
		}else{
			$titlepic="";
			$titlepic2="";
		}
		echo "<li class=\"item clearfix\" data-node=\"item\" rel=\"loaded\">
	
			<div class=\"item-inner\">
				".$titlepic."
				
					<div class=\"rbox-inner\">
					
						<div class=\"title-box\">
							<a ga_event=\"click_feed_newstitle\" class=\"link title\" href=\"" . $row["titleurl"] . "\" target=\"_blank\" data-node=\"title\">
								" . $row["title"] . "
							</a>
						</div>
						<div class=\"abstract\">
							<a ga_event=\"click_feed_newsabstract\" class=\"link\" href=\"" . $row["titleurl"] . "\" target=\"_blank\">" . $row["smalltext"] . "</a>
						</div>
						<div class=\"footer clearfix\">
							<div class=\"left lfooter\">
								<a class=\"lbtn source\" href=\"javascript:;\">".$row[befrom]."&nbsp;</a>
								<span class=\"lbtn comment\"></span>
								<span class=\"lbtn time timeago\">" . date("Y-m-d H:i", $row["newstime"]) . ".0</span>
							</div>
							
					</div>
				</div>
			".$titlepic2."
		</li>";
		
	}

	$cha = NULL;


?>
