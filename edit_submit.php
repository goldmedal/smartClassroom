<?

	include("connect.php");
	$bid = $_POST['bid'];
	$cid = $_POST['cid'];
	$equipName = $_POST['equipName'];
	$openValue = $_POST['openValue'];

/*	$classSQL = "SELECT `englishName` FROM `classTable` WHERE `id` = '$cid'";
	$cquery = mysql_query($classSQL) or die(mysql_error());
	$cresult = mysql_fetch_assoc($cquery);

	$className = $cresult['englishName']; 
	$className = $className."Equip";
*/

	$className = "CIALlabEquip";
	$setSQL = "UPDATE `$className` SET `name` = '$equipName', `open` = '$openValue' WHERE `id` = '$bid'";
	$squery = mysql_query($setSQL) or die(mysql_error());


?>	