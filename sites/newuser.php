<?php
//Session Start
session_start();

function getLastInsertId(){
	$stmt = Database::instance()->connection()->prepare("select last_insert_id() as id;");

    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['id'];
}


//Database connection
include_once ("../config/Database.php");

  
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
 
  
  //Tabelle Rechnungsadresse
  $stmt = Database::instance()->connection()->prepare("INSERT INTO rechnungsadresse(RgStrasseName, RgStrasseNR, RgPLZ, RgLand) VALUES (:RgStrasseName, :RgStrasseNr, :RgPLZ, :RgLand)");

    $stmt->bindValue('RgStrasseName', $_POST['rgStrasseName']);
    $stmt->bindValue('RgStrasseNr', $_POST['rgStrasseNr']);
    $stmt->bindValue('RgPLZ', $_POST['rgPLZ']);
    $stmt->bindValue('RgLand', $_POST['rgLand']);


    $stmt->execute();

   
    $rechnungsadresseid = getLastInsertId();

  //Tabelle Lieferadresse
    $stmt = Database::instance()->connection()->prepare("INSERT INTO lieferadresse(LiStrasseName, LiStrasseNR, LiPLZ, LiLand) VALUES (:LiStrasseName, :LiStrasseNr, :LiPLZ, :LiLand)");

    $stmt->bindValue('LiStrasseName', $_POST['liStrasseName']);
    $stmt->bindValue('LiStrasseNr', $_POST['liStrasseNr']);
    $stmt->bindValue('LiPLZ', $_POST['liPLZ']);
    $stmt->bindValue('LiLand', $_POST['liLand']);

    $stmt->execute();

    $lieferadresseid = getLastInsertId();


//Tabelle Benutzer
  $stmt = Database::instance()->connection()->prepare("INSERT INTO benutzer(
    Anrede, Loginname, Name, Vorname, Geburtsdatum, Mail, Telefon, Passwort, RgAdresseId, LiAdresseId, RolleId)
    VALUES (:Anrede, :Loginname, :Name, :Vorname, :Geburtsdatum, :Mail, :Telefon, :Passwort, :RgAdressId, :RgAdressId, :RolleId)");

    $stmt->bindValue('Anrede', $_POST['anrede']);
    $stmt->bindValue('RolleId', $_POST['rollenId']);
    $stmt->bindValue('Loginname', $_POST['loginname']);
    $stmt->bindValue('Name', $_POST['name']);
    $stmt->bindValue('Vorname', $_POST['vorname']);
    $stmt->bindValue('Geburtsdatum', $_POST['geburtsdatum']);
    $stmt->bindValue('Mail', $_POST['mail']);
    $stmt->bindValue('Telefon', $_POST['telefon']);
    $stmt->bindValue('Passwort', $_POST['pwd']);
    $stmt->bindValue('RgAdressId', $rechnungsadresseid);
    $stmt->bindValue('LiAdresseId', $lieferadresseid);


  $stmt->execute(); 


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



<!--JS PW Validate; https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_password_val-->
  
<script src="../grafical/js/pwvalidator.js"></script>


  <title>StarWars Webshop - Anmeldung</title>        
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
      <li><a href="changeproduct.php">Produkt ändern</a></li>
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
      <li class="active"><a href="newuser.php">Registrieren</a></li>
      <li><a href="login.php">Login</a></li> 
      <li><a href="cart.php">Warenkorb</a></li>
    </ul>
<?php
}
?>

  </div>
</nav>

  <h2 class="header2">Anmeldung</h2>

<!--Anmelde Form-->

        <form class="form-horizontal" action="newuser.php" method="post" name="Anmeldeform">
        <div class="container">
         <label for="anrede">Anrede *</label>
          <div class="radio">
            <label><input type="radio" name="anrede" value="Herr">Herr</label>
          </div>
          <div class="radio">
            <label><input type="radio" name="anrede" value="Frau">Frau</label>
          </div>
        
        <!--Rollenvergabe auf 2 = User-->
 			<label for="rollenId">AGB gelesen</label>
          <div class="radio">
            <label><input type="radio" name="rollenId" value="2">AGB gelesen</label>
          </div>


        <div class="form-group">
            <label class="control-label col-sm-2">Loginname: *</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="loginname" placeholder="Loginname" required="required">
              </div>
          </div>
        
        <div class="form-group">
            <label class="control-label col-sm-2">Name: *</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="name" placeholder="Nachname" required="required">
              </div>
          </div>
          
        <div class="form-group">
            <label class="control-label col-sm-2">Vorname: *</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="vorname" placeholder="Vorname" required="required">
              </div>
          </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Geburtsdatum: *</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control" name="geburtsdatum" placeholder="Geburtsdatum" required="required">
              </div>
          </div>
       
        <div class="form-group">
            <label class="control-label col-sm-2">E-Mail: *</label>
                <div class="col-sm-6">
                  <input type="email" class="form-control" name="mail" placeholder="E-Mail" required="required">
              </div>
          </div>
      
        <div class="form-group">
            <label class="control-label col-sm-2">Telefonnummer: </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="telefon" placeholder="Telefonnummer">
              </div>
          </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Passwort: *</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" name="pwd" required="required">
              </div>
          </div>


      <h3 class="header3">Rechnungsadresse</h3>
                
        <div class="form-group">
            <label class="control-label col-sm-2">Strasse: * </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="rgStrasseName" placeholder="Strassenname" required="required">
              </div>
          </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Strassennummer: * </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="rgStrasseNr" placeholder="Strassennummer" required="required">
              </div>
          </div>

        <div class="form-group">
            <label class="control-label col-sm-2">PLZ: * </label>
                <div class="col-sm-6">
                  <input type="number" class="form-control" name="rgPLZ" placeholder="PLZ" required="required">
              </div>
          </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Land: * </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="rgLand" placeholder="Land" required="required">
              </div>
          </div>


      <h3 class="header3">Lieferadresse</h3>

        <div class="form-group">
            <label class="control-label col-sm-2">Strasse: * </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="liStrasseName" placeholder="Strassenname" required="required">
              </div>
          </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Strassennummer: * </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="liStrasseNr" placeholder="Strassennummer" required="required">
              </div>
          </div>

        <div class="form-group">
            <label class="control-label col-sm-2">PLZ: * </label>
                <div class="col-sm-6">
                  <input type="number" class="form-control" name="liPLZ" placeholder="PLZ" required="required">
              </div>
          </div>

        <div class="form-group">
            <label class="control-label col-sm-2">Land: * </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="liLand" placeholder="Land" required="required">
              </div>
          </div>

          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Registrieren</button>
            </div>
          </div>
</form>

<h3 class="header3">Alle mit * gekennzeichneten Felder sind <u>Pflichtfelder</u></h3>

    <footer>
      <p>Made by Karin Spring</p>
      <p>Pictures by <a target="_blank" href="http://jedipedia.wikia.com/wiki/Jedipedia:Hauptseite">jedipedia.com</a> / Logo by <a target="_blank" href="http://www.flamingtext.com/">FlamingText.com</a></p>
    </footer>
  </body>
</html>