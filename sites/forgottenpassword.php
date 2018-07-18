<?php
//Session Start
session_start();

//Database connection
include_once ("../config/Database.php");

//Statement für Abfrage nach Username / Mail / Neues PW
if (isset($_POST['loginname']) && ($_POST['mail']) && ($_POST['pwd']))
  {
  
  $stmt = Database::instance()->connection()->prepare("UPDATE benutzer SET Passwort = :Passwort WHERE Loginname = :Loginname and Mail = :Mail");

 $stmt->bindValue('Passwort', $_POST['pwd']);
 $stmt->bindValue('Loginname', $_POST['loginname']);
 $stmt->bindValue('Mail', $_POST['mail']);
 
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
      <li><a href="newuser.php">Registrieren</a></li>
      <li class="active"><a href="login.php">Login</a></li> 
      <li><a href="cart.php">Warenkorb</a></li>
    </ul>

  </div>
</nav>

<?php 
  }
?>
  
  
  <h2 class="header2">Passwort vergessen</h2>
		
        <form class="form-horizontal" action="forgottenpassword.php" method="post">
          <div class="form-group">
            <label class="control-label col-sm-2">Benutzername:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="loginname" placeholder="Benutzername">
              </div>
          </div>

      <div class="form-group">
              <label class="control-label col-sm-2">E-Mail:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="mail" placeholder="E-Mail">
              </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">Neues Passwort:</label>
              <div class="col-sm-6"> 
                  <input type="password" class="form-control" name="pwd" placeholder="Passwort">
              </div>
          </div>
        
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Passwort ändern</button>
            </div>
          </div>
     </form>

    <footer>
    	<p>Made by Karin Spring</p>
    	<p>Pictures by <a target="_blank" href="http://jedipedia.wikia.com/wiki/Jedipedia:Hauptseite">jedipedia.com</a> / Logo by <a target="_blank" href="http://www.flamingtext.com/">FlamingText.com</a></p>
    </footer>
  </body>
</html>