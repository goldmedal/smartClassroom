<? echo "haha"; ?>

<html>

<head>
	<link href="index.css" rel="stylesheet" />
	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
	<script src="func.js"></script>
	<script>
		$(document).ready(function(){
			var socket_1 = checkSet(1);
			var socket_2 = checkSet(2);
			var socket_3 = checkSet(3);
			$("#butten_1").click(function(){turnOnOff(1);});
			$("#butten_2").click(function(){turnOnOff(2);});
			$("#butten_3").click(function(){turnOnOff(3);});
		});	
	</script>
</head>

<body>
	<header>
		<h1>Smart Classroom System</h1>
	</header>
	<div id="main">
		<div class="title">Lab-1</div>
		<div class="item">
			<div class="butten" id="butten_1">On</div>		
			<div class="idClass">Socket 1</div>
		</div>
		<div class="item">
			<div class="butten" id="butten_2">On</div>
			<div class="idClass">Socket 2</div>
		</div>
		<div class="item">
			<div class="butten" id="butten_3">On</div>
			<div class="idClass">Socket 3</div>
		</div>				
	</div>
</body>

</html>
