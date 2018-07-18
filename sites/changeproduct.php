<?php
//Session Start
session_start();

//Database connection
include_once ("../config/Database.php");

$stmt = Database::instance()->connection()->prepare("SELECT * FROM produkt");
  $stmt->execute(); 
 if($_SERVER['REQUEST_METHOD'] === 'POST'){

//Tabelle Produkt
if (isset($_POST['newproductname']))
  $stmt = Database::instance()->connection()->prepare("UPDATE produkt SET newProduktname = :newProduktname WHERE Produktname = :Produktname");
 
  $stmt->bindValue('newProduktname', $_POST['newproductname']);

 $stmt->execute();

 if(isset($_POST['newpreis'])) {
  $stmt = Database::instance()->connection()->prepare("UPDATE produkt SET newPreis = :newPreis WHERE Preis = :Preis");

 $stmt->bindValue('newPreis', $_POST['newpreis']);
 
 $stmt->execute();
  }

 if(isset($_POST['newbeschrieb'])) {
  $stmt = Database::instance()->connection()->prepare("UPDATE produkt SET newbeschrieb = :newbeschrieb WHERE Beschrieb = :Beschrieb");

 $stmt->bindValue('newBeschrieb', $_POST['newBeschrieb']);
 
 $stmt->execute();  
  }
}
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
      <li><a href="profile.php">Mein Konto</a></li>
      <li><a href="logout.php">Ausloggen</a></li>
      <li><a href="newproduct.php">Produkt hinzufügen</a></li>
      <li class="active"><a href="changeproduct.php">Produkt ändern</a></li>
      <li><a href="deleteproduct.php">Produkt löschen</a></li>
    </ul>

<!--Für USER sichtbar; Rolle 2-->
<?php
}
elseif ($user['RolleId'] == 2) {
  ?>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="profile.php">Mein Konto</a></li>
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
      <li><a href="newuser.php">Anmelden</a></li>
      <li><a href="login.php">Login</a></li> 
      <li><a href="cart.php">Warenkorb</a></li>
    </ul>

  </div>
</nav>
<?php     
  }
?>

  <h2 class="header2">Produkt ändern</h2>

<table border="1">
   <tr>
      <td><b>Produktname</b></td>
      <td><b>Preis</b></td>
      <td><b>Beschrieb</b></td>
   </tr>
<?php 


 while($row=$stmt->fetch()) 
 {
      echo "<tr>".
           "<td>".$row["Produktname"]."</td>".
           "<td>".$row["Preis"]."</td>".
           "<td>".$row["Beschrieb"]."</td>".
           "</tr>";
         }
 ?>
</table>

<h2>Produkt ändern</h2>

    <form class="form-horizontal" action="changeproduct.php" method="post">
          <div class="form-group">
            <label class="control-label col-sm-2">Produktname:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="newproduktname" placeholder="Produktname">
              </div>
          </div>

      <div class="form-group">
              <label class="control-label col-sm-2">Preis:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="newpreis" placeholder="Preis">
              </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Beschrieb:</label>
              <div class="col-sm-6"> 
                  <input type="text" class="form-control" name="newbeschrieb" placeholder="Beschrieb">
              </div>
          </div>
        
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
            	<div class="col-sm-6"> 
              	<button type="submit" class="btn btn-default">Änderungen durchführen</button>
            </div>
          </div>
      </div>
     </form>


    <section>
    	<p>Made by Karin Spring</p>
    	<p>Pictures by <a target="_blank" href="http://jedipedia.wikia.com/wiki/Jedipedia:Hauptseite">jedipedia.com</a> / Logo by <a target="_blank" href="http://www.flamingtext.com/">FlamingText.com</a></p>
    </section>
  </body>
</html>