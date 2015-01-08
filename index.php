<html>
<head>
	<link href="index.css" rel="stylesheet" />
	<link href="spinner.css" rel="stylesheet" />
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
<? if($quip_row['type'] != 3){  ?>
							<div class='button check' id='check_<?echo $quip_row['id'];?>'>Check</div>\
							<div class='button' id='butten_<?echo $quip_row['id'];?>'><?echo ($quip_row['status'] == 1)?"Off":"On";?></div>\
<? }else{ ?>
							<div class='button check' id='send_<?echo $quip_row['id'];?>'>Send</div>\
<? } ?>
							<div class='idClass'>\
								<img src='<? echo $type_src; ?>' style='height:35px;width:35px;'>\
								<? echo $quip_row['name']; ?>\
							</div>\
						</div>\
					</div>\
				");
<?			
		if($quip_row['type'] != 3){
			echo "$('#butten_".$quip_row['id']."').click(function() { OnOff(".$quip_row['id']."); });";
			echo "$('#check_".$quip_row['id']."').click(function() { checkCurrent(".$quip_row['id']."); });";
		}else{

			echo "$('#send_".$quip_row['id']."').click(function() { irsend(".$quip_row['id']."); });";

		}

		}
		
?>

		}

		$(document).ready(function(){
			getQuipData();
			$('#manager').click(function() {
				location.href = "manager.php";
			});

		});	

	</script>

</head>
<body>
	<header>
		<div id="manager">Manager</div>
		<h1>Smart Classroom System</h1>
	</header>
	<div id="classTable">
	
	</div>

	
</body>

</html>
