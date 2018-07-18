<?php
//Session Start
session_start();

if(isset($_SESSION['sessionObject'])){
    $user = $_SESSION['sessionObject'];
}
else{
  $user = null;
}


//Database connection
include_once ("../config/Database.php");

$stmt = Database::instance()->connection()->prepare("SELECT * FROM benutzer WHERE BenutzerId = :id");
  $stmt->bindParam("id", $user['BenutzerId']);
  $stmt->execute();

  $stmt2 = Database::instance()->connection()->prepare("SELECT * FROM rechnungsadresse WHERE RgAdresseId = :id");
  $stmt2->bindParam("id", $user['RgAdresseId']);
  $stmt2->execute(); 

  $stmt3 = Database::instance()->connection()->prepare("SELECT * FROM lieferadresse WHERE LiAdresseId = :id");
  $stmt3->bindParam("id", $user['LiAdresseId']);
  $stmt3->execute(); 
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
    <!--CSS Reset -->
        <link href="../grafical/css/reset.css" rel ="stylesheet" type="text/css">

        <!--bootstrap Source: https://getbootstrap.com/docs/3.3/getting-started/ -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <!--CSS Styles-->
    <link href = "../grafical/css/style.css" rel ="stylesheet" type="text/css"> 

        <title>StarWars Webshop</title>        
    </head>

    <body>

       <header>
            <div class="swimage">
                <img src="https://blog.flamingtext.com/blog/2017/12/28/flamingtext_com_1514468273_861567718.png" border="0" alt="Logo Design by FlamingText.com" title="Logo Design by FlamingText.com"></a>
            </div>
        </header>
 
<!--Source https://www.w3schools.com/bootstrap/bootstrap_navbar.asp-->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    </div>

<!--Für ALLE sichtbar, Session nicht benötigt-->
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="droids.php">Droiden</a></li>
      <li><a href="spaceships.php">Raumschiffe</a></li>
      <li><a href="weapons.php">Waffen</a></li>
    </ul>

<!--Für ADMIN sichtbar; Rolle 1-->
<?php
  if(isset($_SESSION['sessionObject'])){
    $user = $_SESSION['sessionObject'];

    if ($user['RolleId'] == 1) {
    ?>
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="profile.php">Mein Konto</a></li>
      <li><a href="logout.php">Ausloggen</a></li>
      <li><a href="newproduct.php">Produkt hinzufügen</a></li>
      <li><a href="changeproduct.php">Produkt ändern</a></li>
      <li><a href="deleteproduct.php">Produkt löschen</a></li>
    </ul>

<!--Für USER sichtbar; Rolle 2-->
<?php
}
elseif ($user['RolleId'] == 2) {
  ?>
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="profile.php">Mein Konto</a></li>
      <li><a href="logout.php">Ausloggen</a></li>
      <li><a href="cart.php">Warenkorb</a></li>
    </ul>
<?php
    }
  }

else {
?>

<!--Für GUEST sichtbar-->    
    <ul class="nav navbar-nav navbar-right">
      <li><a href="newuser.php">Registrieren</a></li>
      <li><a href="login.php">Login</a></li> 
      <li><a href="cart.php">Warenkorb</a></li>
    </ul>

  </div>
</nav>

<?php 
  }
?>
  
  
  <h2 class="header2">Dein Profil</h2>

<table border="1">
   <tr>
      <td><b>Anrede</b></td>
      <td><b>Name</b></td>
      <td><b>Vorname</b></td>
      <td><b>Geburtsdatum</b></td>
      <td><b>Mail</b></td>
      <td><b>Telefonnummer</b></td>
   </tr>
<?php 

 while($row=$stmt->fetch()) 
 {
      echo "<tr>".
          "<td>".$row["Anrede"]."</td>".
          "<td>".$row["Name"]."</td>".
          "<td>".$row["Vorname"]."</td>".
          "<td>".$row["Geburtsdatum"]."</td>".
          "<td>".$row["Mail"]."</td>".
          "<td>".$row["Telefon"]."</td>".
          "</tr>";
         }
 ?>
</table>

<h3 class="header3">Rechnungsadresse</h3>
<table border="1">
   <tr>
      <td><b>Strasse</b></td>
      <td><b>Strassennummer</b></td>
      <td><b>PLZ</b></td>
      <td><b>Land</b></td>
    </tr>
<?php 

 while($row=$stmt2->fetch()) 
 {
      echo "<tr>".
          "<td>".$row["RgStrasseName"]."</td>".
          "<td>".$row["RgStrasseNr"]."</td>".
          "<td>".$row["RgPLZ"]."</td>".
          "<td>".$row["RgLand"]."</td>".
          "</tr>";
         }
 ?>
</table>

<h3 class="header3">Lieferadresse</h3>
<table border="1">
   <tr>
      <td><b>Strasse</b></td>
      <td><b>Strassennummer</b></td>
      <td><b>PLZ</b></td>
      <td><b>Land</b></td>
    </tr>
<?php 

 while($row=$stmt3->fetch()) 
 {
      echo "<tr>".
          "<td>".$row["LiStrasseName"]."</td>".
          "<td>".$row["LiStrasseNr"]."</td>".
          "<td>".$row["LiPLZ"]."</td>".
          "<td>".$row["LiLand"]."</td>".
          "</tr>";
         }
 ?>
</table>


    <footer>
    	<p>Made by Karin Spring</p>
    	<p>Pictures by <a target="_blank" href="http://jedipedia.wikia.com/wiki/Jedipedia:Hauptseite">jedipedia.com</a> / Logo by <a target="_blank" href="http://www.flamingtext.com/">FlamingText.com</a></p>
    </footer>
  </body>
</html>