<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="Steve Klicek" >
<meta name="description" content="Mein CRM">
<meta name="robots" content="index,follow">
<title>Firma: Mein CRM - Kontenrahmen</title>
<link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<?php
include("../include/menu.php");
require_once("../include/config.inc.php");

$action="";
if (isset($_GET['action'])){
    $action=$_GET['action'];
} elseif (isset($_POST['action'])){
    $action=$_POST['action'];
}

$id_konto=0;
if (isset($_GET['id'])){
    $id_konto=$_GET['id'];
} elseif (isset($_POST['id'])){
    $id_konto=$_POST['id'];
}

//daten speichern
$msg="";
if (isset($_POST['submit'])){
    $konto_nr=htmlspecialchars($_POST['konto_nr']);
    $bez=htmlspecialchars($_POST['bez']);
    $typ=htmlspecialchars($_POST['typ']);
    $zeile_nr=htmlspecialchars($_POST['zeile_nr']);
    
    if ($action=="n"){
        if ($stmt2 = $mysqli -> prepare("INSERT INTO kontenrahmen (konto_nr, bezeichnung, typ, zeile_nr) VALUES (?,?,?,?)")) {
            $stmt2 -> bind_param("sssi",$konto_nr,$bez,$typ,$zeile_nr);
            if ($stmt2 -> execute()){
                $msg="Daten erfolgreich gespeichert.";
            } else {
                $msg="Fehler bei der Speicherung der Daten.";
            }
            $stmt2 -> close();
        }
    } elseif ($action=="e"){
        if ($stmt2 = $mysqli -> prepare("UPDATE kontenrahmen SET konto_nr = ?, bezeichnung = ?, typ = ?, zeile_nr = ? WHERE id_konto = ?")) {
            $stmt2 -> bind_param("sssii",$konto_nr,$bez,$typ,$zeile_nr,$id_konto);
            if ($stmt2 -> execute()){
                $msg="Daten erfolgreich gespeichert.";
            } else {
                $msg="Fehler bei der Speicherung der Daten.";
            }
            $stmt2 -> close();
        }
    }
}

//daten auslesen
$konto_nr=$bez=$typ="";
$zeile_nr=0;
if ($action=="e" && $id_konto!=0){
    if ($stmt2 = $mysqli -> prepare("SELECT konto_nr, bezeichnung, typ, zeile_nr FROM kontenrahmen WHERE id_konto = ?")) {
        $stmt2 -> bind_param('i',$id_konto);
        $stmt2 -> execute();
        $stmt2 -> bind_result($konto_nr,$bez,$typ,$zeile_nr);
        $stmt2 -> fetch();
        $stmt2 -> close();
    }
}

//konto löschen
if ($action=="d" && $id_konto!=0){
	 //keine rechnungen mit konto_verbunden?
	 $anzahl_verbunden=0;
    if ($stmt2 = $mysqli -> prepare("SELECT COUNT(id_rechnung) FROM rechnungen_eingang WHERE id_konto = ?")) {
        $stmt2 -> bind_param('i',$id_konto);
        $stmt2 -> execute();
        $stmt2 -> bind_result($anzahl_verbunden);
        $stmt2 -> fetch();
        $stmt2 -> close();
    }
    
	 //keine rechnungen mit konto_verbunden: kann entfernt werden    
    if ($anzahl_verbunden==0){
    	if ($stmt2 = $mysqli -> prepare("DELETE FROM kontenrahmen WHERE id_konto = ?")) {
            $stmt2 -> bind_param("i",$id_konto);
            $stmt2 -> execute();
            $stmt2 -> fetch();
            $stmt2 -> close();
      }
   }
   ?>
   <script type="text/javascript" >
   window.location.href="kontenrahmen.php";
   </script>
   <?php
   exit;
}
?>
<div class="table">
<p class="header">Kontenrahmen bearbeiten</p>
<?=$msg;?>
<form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
    <input type="hidden" name="action" value="<?=$action;?>">
    <input type="hidden" name="id" value="<?=$id_konto;?>">
	<table>
	<tbody>
    <tr>
	<td><b for="konto_nr">Konto-Nr</b></td>
    <td><input type="text" name="konto_nr" maxlength="11" value="<?=$konto_nr;?>"></td>
	</tr>
	<tr>
    <td><b for="bez">Bezeichnung</b></td>
    <td><input type="text" name="bez" maxlength="250" value="<?=$bez;?>"></td>
	</tr>
	<tr>
    <td><b for="typ">Typ</b></td>
    <td><select name="typ">
        <option value="">---</option>
        <?php
        if($typ=="A") {
        	?>
        	<option value="A" selected>Ausgaben</option>
        	<?php
        } else {
        	?>
        	<option value="A">Ausgaben</option>
        	<?php
        }
        if($typ=="E") {
        	?>
        	<option value="E" selected>Einnahmen</option>
        	<?php
        } else {
        	?>
        	<option value="E">Einnahmen</option>
        	<?php
        }
        ?>
    </select></td>
	</tr>
	<tr>
    <td><b for="zeile_nr">Zeilennummer (EÜR-Formular)</b></td>
    <td><input type="number" step="1" name="zeile_nr" value="<?=$zeile_nr;?>"></td>
	</tr>
	</tbody>
	</table>
    <input class="btn" type="submit" name="submit" value="Speichern">
</form>
</div>
<?php
$mysqli -> close();
?>
</body>
</html>