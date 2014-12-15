<html>
<head>
	<link href="manager.css" rel="stylesheet" />

	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
	<script type="text/javascript" src="jquery.ddslick.js"></script>
	<script src="manager.js"></script>
	<script type="text/javascript">
	$(function(){
		// 下拉選單的資料來源
		var ddData = [
			{
				text: '冷氣',
				value: 1,
				description: '',
				imageSrc: 'air.jpg'
			},
			{
				text: '插頭',
				value: 2,
				description: '',
				imageSrc: 'ele.jpg'
			},
			{
				text: '開關',
				value: 3,
				description: '',
				imageSrc: 'light.jpg'
			},
		];
 
		// 把 #myDropdown 轉換成 ddslick 下拉選單
		$('.myDropdown').ddslick({
			data: ddData,
			width: 100,
2
			selectText: '請選擇'
		});
	});
</script>
	<script>
		$(document).ready(function () {
			$("#mask").click(hide_panel);
			$('#back').click(function() {
				location.href = "index.php";
			});			
		});

	</script>
</head>
<body>

<header>
	<div id="back">Back To List</div>	
	<h1>Manager UI</h1>
</header>

<div id="equipTable">
	<div class="item">
		<span class="btNum  tb_cell">Bluetooth Group</span>
		<span class="sockNum  tb_cell">Socket Number</span>
		<span class="name  tb_cell">Equip Name</span>
		<span class="type  tb_cell">Equip Type</span>
		<span class="open  tb_cell">Open</span>
		<span class="  tb_cell"></span>
	</div>

<?
	require_once("connect.php");

	$equipSQL = "SELECT * FROM `CIAlabEquip`";
	$equipQuery = mysql_query($equipSQL) or die(mysql_error());
	while( ($equipResult = mysql_fetch_assoc($equipQuery)) != FALSE ) {

		$equipId = $equipResult['id'];
		$group = $equipResult['group'];
		$gNum = $equipResult['g_num'];
		$name = $equipResult['name'];
		$open = $equipResult['open'];

?>	


	<div class="item">
		<span class="btNum tb_cell"><?echo $group;?></span>
		<span class="sockNum tb_cell"><?echo $gNum;?></span>
		<span class="name tb_cell"><? echo $name;?></span>
		<span class="type  tb_cell"><div class="myDropdown" id="num1"></div></span>
		<span class="open tb_cell">
		<? 
			if ($open == 0) echo "Close";
			else echo "Open";
		?>
		</span>
		<span class="edit tb_cell">Edit</span>
	</div>		
<?
	}
?>
</div>

<div id="btTable">
	<div class="item">
		<span class="btNum  tb_cell">Bluetooth Number</span>
		<span class="macAddress  tb_cell">Mac Address</span>
	</div>

<?

	$equipSQL = "SELECT * FROM `btDevice`";
	$equipQuery = mysql_query($equipSQL) or die(mysql_error());
	while( ($equipResult = mysql_fetch_assoc($equipQuery)) != FALSE ) {

		$btId = $equipResult['id'];
		$MacAddress = $equipResult['MacAddress'];

?>	


	<div class="item">
		<span class="btNum tb_cell"><?echo $btId;?></span>
		<span class="macAddress tb_cell"><?echo $MacAddress;?></span>
	</div>		
<?
	}
?>
</div>


<div id="mask">	
</div>

<div id="editPanel">
</div>


</body>

</html>
