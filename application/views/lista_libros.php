<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lista de libros en la base de datos</title> 
<style>

  body {
    background-image: url("../assets/img/lista-socios1.jpg");
    background-size:auto;
    background-position: center;
    background-attachment: fixed;
  }
  
  #tabla-container {
    position: auto;
    z-index: 1;
    background-color: rgba(255, 255, 255, 0.8);
    margin:  auto;
    max-width: 100%;
  }
  
  table {
    width: 100%;
    border-collapse: auto;
  }
  
  th, td {
    padding: 10px;
    text-align: center;
  }
  
  th {
    background-color: #e6e6e6;
    font-weight: bold;
  }
  
  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
</style>

</style>
</head>
<body class="lista-libros">
    <div id="tabla-container">
        <table border="2">
            <tr>
                <th>ID</th>
                <th>ISBN</th>
                <th>TÍTULO</th>
                <th>AUTOR</th>
                <th>FECHA DE ALTA</th>
                <th>FECHA DE MODIFICACIÓN</th>
                <th>FECHA BAJA DE LIBRO</th>
                <th>CATEGORÍA</th>
            </tr>
            <?php
            require_once '../src/database.php';
            include "../views/dashboard.php";
            $conn = mysqli_connect($host, $usuario, $contraseña, $baseDatos);

            if (mysqli_connect_errno()) {
                die("Fallo la conexión: " . mysqli_connect_error());
            }

            $sql = "SELECT libro.ID, libro.ISBN, libro.TITULO, libro.AUTOR, libro.FECHA_ALTA, libro.FECHA_MODIFICACION, libro.FECHA_DESHABILITADO, categoria.NOMBRE AS CATEGORIA FROM libro INNER JOIN categoria ON libro.CATEGORIA_ID = categoria.ID";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $ID = $row['ID'];
                    $ISBN = $row['ISBN'];
                    $TITULO = $row['TITULO'];
                    $AUTOR = $row['AUTOR'];
                    $FECHA_ALTA = $row['FECHA_ALTA'];
                    $FECHA_MODIFICACION = isset($row['FECHA_MODIFICACION']) ? $row['FECHA_MODIFICACION'] : '';
                    $FECHA_DESHABILITADO = isset($row['FECHA_DESHABILITADO']) ? $row['FECHA_DESHABILITADO'] : '';
                    $CATEGORIA_NOMBRE = isset($row['CATEGORIA']) ? $row['CATEGORIA'] : '';

                    echo "<tr>";
                    echo "<td>$ID</td>";
                    echo "<td>$ISBN</td>";
                    echo "<td>$TITULO</td>";
                    echo "<td>$AUTOR</td>";
                    echo "<td>$FECHA_ALTA</td>";
                    echo "<td>$FECHA_MODIFICACION</td>";
                    echo "<td>$FECHA_DESHABILITADO</td>";
                    echo "<td>$CATEGORIA_NOMBRE</td>";
                    echo "</tr>";
                }
            } else {
                echo "0 results";
            }

            mysqli_close($conn);
            ?>

                  
                      ?>
                  </table>
              </div>
          </body>
          </html>