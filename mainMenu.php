<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>

<?php


  echo'<fieldset class="w3-auto w3-card-4 w3-auto w3-center w3-padding w3-margin">';
      echo'<img class="w3-center" src="img/gulaMomoSignboard.png" alt=""><br><br><br>';
      echo'<h1 class="w3-purple w3-text-white w3-animated-top">Welcome to GULAMOMO </h1><br>';
      echo '<h1>'.'User ID : '.$_SESSION['userID'].'</h1><br><br>';
      echo'<button class="w3-button w3-hoverblue w3-light-blue">';
        echo'<a href="ORDER/carList.php">List Of Order</a>';
      echo'</button>';
      echo'<button class="w3-button w3-hoverblue w3-light-blue w3-margin-left">';
        echo'<a href="ORDER/carInfoForm.php">Take Order</a>';
      echo'</button>';
  echo'</fieldset>';
?>

