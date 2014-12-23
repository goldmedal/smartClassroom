<html>
<head>
	<link href="manager.css" rel="stylesheet" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
  <link rel="stylesheet" href="jquery-ui.css">
  <script src="jquery-ui.min.js"></script>
  <script src="jquery-ui.js"></script>
	<script type="text/javascript" src="jquery.ddslick.js"></script>
	<script src="manager.js"></script>
  <script src="manager_new_device.js"></script>
</head>
<body>

<header>
  <div id="back">Back To List</div> 
	<h1>Manager UI</h1>
</header>

<!--  new Device Dialog  -->

<div id="dialog-form" title="Create new equipment">
	<p class="validateTips">All form fields are required.</p>
	<form name="table">
		<fieldset>
			<label for="equip_name">Equip Name</label>
			<input type="text" name="equip_name" id="equip_name" value="light" class="text ui-widget-content ui-corner-all">
			<label for="equip_type">Equip Type</label>
			<input type="text" name="equip_type" id="equip_type" value="1" class="text ui-widget-content ui-corner-all">
			<label for="bluetooth_num">Bluetooth Number</label>
			<input type="text" name="bluetooth_num" id="bluetooth_num" value="1" class="text ui-widget-content ui-corner-all">
      <label for="socket_num">Socket Number</label>
      <input type="text" name="socket_num" id="socket_num" value="1" class="text ui-widget-content ui-corner-all">
      <label for="show">show</label>
      yes<input type="radio" name="show" id="yes" value="Yes" class="kk" >
      no<input type="radio" name="show" id="no"  value="No" class="kk" >

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
          <th><input type="button" id="dele" name="delete" value="delete" /></th>
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
                echo "插座";
                break;

              case 2:
                echo "電器";
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
          <td><? echo $open; ?></td>
          <td> <input type='checkbox' name='del' /></td>
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
  <input type="text" id="bluetext" value="input bluetooth number">
  <button id="add_blue" >add</button>
  <button id="dele_blue" >delete selected bluetooth</button>
  <br><br>
  <ol>
<?

  $equipSQL = "SELECT * FROM `btDevice`";
  $equipQuery = mysql_query($equipSQL) or die(mysql_error());
  while( ($equipResult = mysql_fetch_assoc($equipQuery)) != FALSE ) {

    $btId = $equipResult['id'];
    $MacAddress = $equipResult['MacAddress'];
    echo "<li>".$MacAddress."<input type='checkbox' name='del' /></li>";

  }
?>    
  </ol>
</div>


</body>

</html>