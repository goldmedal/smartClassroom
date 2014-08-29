<?

	include("connect.php");

?>

<html>
<head>
	<link href="manager.css" rel="stylesheet" />

	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
	<script src="manager.js"></script>
	<script>
		$(document).ready(function () {

			$("#mask").click(hide_panel);

		});
	</script>
</head>
<body>

<header>
	<h1>Manager UI</h1>
</header>

<div id="equipTable">
	<div class="item">
		<span class="btNum  tb_cell">Bluetooth Number</span>
		<span class="sockNum  tb_cell">Socket Number</span>
		<span class="name  tb_cell">Equip Name</span>
		<span class="open  tb_cell">Open</span>
		<span class="tb_cell"></span>
	</div>
<?

	$equipSQL = "SELECT * FROM `CIALlabEquip`";
	$equipQuery = mysql_query($equipSQL);
	while( ($equipResult = mysql_fetch_assoc($equipQuery)) != FALSE ) {

		$bid = $equipResult['id'];
		$btNum = $equipResult['btNum'];
		$sockNum = $equipResult['sockNum'];
		$name = $equipResult['name'];
		$open = $equipResult['open'];

?>	

	<div class="item">
		<span class="btNum tb_cell"><? echo $btNum; ?></span>
		<span class="sockNum tb_cell"><? echo $sockNum; ?></span>
		<span class="name tb_cell"><? echo $name; ?></span>
		<span class="open tb_cell">
		<? 
			if ($open == 0) echo "Close";
			else echo "Open";
		?>
		</span>
		<span class="edit tb_cell" onclick='<? echo "open_edit($bid, $btNum, $sockNum, $name, $open)"; ?>'>Edit</span>
	</div>

<? } ?>
</div>

<div id="mask">	
</div>

<div id="editPanel">
</div>


</body>

</html>
