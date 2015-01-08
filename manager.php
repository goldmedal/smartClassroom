<html>
<head>
	<link href="manager.css" rel="stylesheet" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
  <link rel="stylesheet" href="jquery-ui.css">
  <link rel="stylesheet" href="spinner.css">
  <script src="jquery-ui.min.js"></script>
  <script src="jquery-ui.js"></script>
	<script type="text/javascript" src="jquery.ddslick.js"></script>
	<script src="manager.js"></script>
  <script src="manager_new_device.js"></script>
  <script>
  $(document).ready(function() {

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

<!--  new Device Dialog  -->

<div id="dialog-form" title="Create new equipment">
	<form name="table">
		<fieldset>
			<div class='dia_item'>
				<label for="equip_name">Equip Name: </label>
				<input type="text" name="equip_name" id="equip_name" placeholder="Input equip name" class="text ui-widget-content ui-corner-all">
			</div>
			<div class='dia_item'>
				<label for="equip_type">Equip Type: </label>
				電器<input type="radio" name="equip_type" id="equip_type" value="1" class="kk" checked>
				開關<input type="radio" name="equip_type" id="equip_type" value="2" class="kk">
				紅外線<input type="radio" name="equip_type" id="equip_type" value="3" class="kk">
			</div>
			<div class='dia_item'>
				<label for="bluetooth_num">Bluetooth Number: </label>
				<input type="text" name="bluetooth_num" id="bluetooth_num" placeholder="Input bluetooth Number" class="text ui-widget-content ui-corner-all">
			</div>
			<div class='dia_item'>
				 <label for="socket_num">Socket Number: </label>
				<input type="text" name="socket_num" id="socket_num" placeholder="Input the number of socket" class="text ui-widget-content ui-corner-all">
			</div>
			<div class='dia_item'>
			  <label for="show">Show: </label>
		      Yes<input type="radio" name="show" id="show" value="1" class="kk" >
			 No<input type="radio" name="show" id="show"  value="0" class="kk" checked>
			</div>
			<!-- Allow form submission with keyboard without duplicating the dialog button -->
			<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" >
		</fieldset>
	</form>
</div>



<div id="equipTable">
  <div id="users-contain" class="ui-widget">
    <h2>Existing Devices:</h2>
    <table id="users" class="ui-widget ui-widget-content">
      <thead>
        <tr class="ui-widget-header ">
          <th>Equip Name</th>
          <th>Equip Type</th>
          <th>Bluetooth Number</th>
          <th>Socket Number</th>
          <th>Open</th>
		  <th></th>
		  <th></th>
        </tr>
      </thead>
      <tbody>
        <tr></tr>
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
    $type = $equipResult['type'];

?>          
        <tr class='row' id='row'>
          <td><?echo $name; ?></td>
          <td>
<?
            switch ($type) {
              case 1:
                echo "電器";
                break;

              case 2:
                echo "開關";
                break;

              case 3:
                echo "紅外線";
                break;

              default:
                # code...
                break;
            }
?>
          </td>
          <td><? echo $group; ?></td>
          <td><? echo $gNum; ?></td>
          <td><? if($open) echo "Yes";
				 else echo "No";
		   ?></td>   
	    <td><button class='dele_dev' id='dev_dele_<?echo $equipId;?>'>delete</button></td>
<script>
	$(document).ready(function() {
		$('#dev_dele_<? echo $equipId;?>').click( function() {
			delete_dev(<? echo $equipId; ?>);
		}); 
	});
</script>
		<td><button class='edit_dev' id='dev_edit_<?echo $equipId;?>'>Edit</button></td>
<script>
	$(document).ready(function() {
		$('#dev_edit_<? echo $equipId;?>').click( function() {
			edit_dialog(<? echo $equipId.",".$group.",".$gNum.",'".$name."',".$open.",".$type; ?>);
		}); 
	});
</script>

        </tr>  

<?
   }
?>              
      </tbody>
    </table>
  </div>
  <button id="create-user">Create new equipment</button>

</div>


 <!-- Bluetooth Device Table    -->


<div id="bluetooth_table">
  <b>Bluetooth Number:</b><br>
  <input type="text" id="bluetext" placeholder="input bluetooth number">
  <button id="add_blue" >add</button>
  <br><br><br><br>
  <ul>
<?

  $equipSQL = "SELECT * FROM `btDevice`";
  $equipQuery = mysql_query($equipSQL) or die(mysql_error());
  while( ($equipResult = mysql_fetch_assoc($equipQuery)) != FALSE ) {

    $btId = $equipResult['id'];
    $MacAddress = $equipResult['MacAddress'];
    echo "<div class='bt_item'>".$btId.". ".$MacAddress."<button class='dele_blue' id='dele_".$btId."'>delete</button></div>";

?>    
<script>
	$(document).ready(function() {
		$('#dele_<? echo $btId;?>').click( function() {
			delete_bluetooth(<? echo $btId; ?>, "<? echo $MacAddress; ?>");
		}); 
	});
</script>
<?
	}
?>
  </ul>
</div>


</body>

</html>
