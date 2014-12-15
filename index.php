<html>
<head>
	<link href="index.css" rel="stylesheet" />
	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
	<script src="func.js"></script>
	<script>

		function getQuipData() {
<?
		require_once("../connect.php");
		$quip_row = mysql_query("SELECT * FROM `CIAlabEquip` ORDER BY `group` ASC");
		while( ($quip_row = mysql_fetch_assoc($quip_query) ) ) != FALSE ){

			if($now_group != $quip_row['group']){
				$now_group = $quip_row['group'];
?>

			$("#classTable").append("  \
				<div class='classTable' id='group<? echo $now_group; ?>'>\
					<div class='title'><b>Group <? echo $now_group; ?></b></div>\
				</div>\
				");

<?
			}
?>
			$("#group<? echo $now_group;?>").append("\
					<div class='Table'>\
						<div class='item'>\
							<div class='butten' id='butten_<?echo $quip_row['id'];?>'></div>\
							<div class='idClass'>\
								<img src='light.jpg' style='height:35px;width:35px;>\
								<? echo $quip_row['name']; ?>\
							</div>\
						</div>\
					</div>\
				");
<?			

			echo "$('#butten_".$quip_row['id'].").click(function() { OnOff(".$quip_row['id']."); });";

			echo "$('#check_".$quip_row['id'].").click(function() { checkCurrent(".$quip_row['id']."); });";

		}
?>

		}

		$(document).ready(function(){
			getQuipData();
		});	

	</script>
</head>
<body>
	<header>
		<div id="manager">Manager</div>
		<h1>Smart Classroom System</h1>
	</header>
	<div id="classTable"></div>

	
</body>

</html>
