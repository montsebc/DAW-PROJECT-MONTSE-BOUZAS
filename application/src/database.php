<?php
function connect() {
  $conn = mysqli_connect("localhost", "root", "", "proyecto_fin_grado");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  return $conn;
}
?>



