<html>
<head>
	<link href="index.css" rel="stylesheet" />
	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
	<script src="func.js"></script>
	<script>

		function getQuipData() {

<?
		require_once("connect.php");
		$quip_query = mysql_query("SELECT * FROM `CIAlabEquip`WHERE `open` = '1' ORDER BY `group` ASC") or die(mysql_error());
		while( ($quip_row = mysql_fetch_assoc($quip_query) )  != FALSE ){
		
			switch($quip_row['type']){
				case 2: $type_src = "light.jpg";break;	
				case 1: $type_src = "ele.jpg";break;	
				case 3: $type_src = "air.jpg";break;	
			}
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
							<div class='button check' id='check_<?echo $quip_row['id'];?>'>Check</div>\
							<div class='button' id='butten_<?echo $quip_row['id'];?>'><?echo ($quip_row['status'] == 1)?"Off":"On";?></div>\
							<div class='idClass'>\
								<img src='<? echo $type_src; ?>' style='height:35px;width:35px;'>\
								<? echo $quip_row['name']; ?>\
							</div>\
						</div>\
					</div>\
				");
<?			

			echo "$('#butten_".$quip_row['id']."').click(function() { OnOff(".$quip_row['id']."); });";
			echo "$('#check_".$quip_row['id']."').click(function() { checkCurrent(".$quip_row['id']."); });";
	
		}
		
?>

		}

		$(document).ready(function(){
			getQuipData();
			$('#manager').click(function() {
				location.href = "manager.php";
			});

			$('#Send').click(function() { irsend(); });
		});	

	</script>

</head>
<body>
	<header>
		<div id="manager">Manager</div>
		<h1>Smart Classroom System</h1>
	</header>
	<div id="classTable">
		<div class='classTable' id='projector'>
			<div class='title'><b>Projector</b></div>
			<div class='Table'>
				<div class='item'>
				<div class='button check' id='Send'>Send</div>
				<div class='idClass'>Power</div>
				</div>
			</div>

		</div>
	
	
	</div>

	
</body>

</html>
