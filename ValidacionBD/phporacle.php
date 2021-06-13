<?php

$db_username = "jmiranda";
$db_password = "reactmapa";
$ip = "201.218.0.67";

echo "3Conectando a: " . $ip . ":" . $puerto . "/" . $base;

$tns = " 
(DESCRIPTION =
(ADDRESS_LIST =
  (ADDRESS = (PROTOCOL = TCP)(HOST = 201.218.0.67)(PORT = 1521))
)
(CONNECT_DATA =
  (SERVICE_NAME = DBGYE)
)
)
       ";

try{
    $conn = new PDO("oci:dbname=".$tns,$db_username,$db_password);
}catch(PDOException $e){
    echo ($e->getMessage());
}


/*
    $usuario = "jmiranda";
    $clave = "reactmapa";
    $ip = "201.218.0.67";
    $puerto = "1521";
    $base = "dbgye";
    $tabla = "map_usuarios";

    echo "base 1 ";
    $conn = @oci_connect($usuario, $clave , $ip . ":" . $puerto . "/" . $base);
    if (!$conn) {
        print "Sorry! The connection to the database failed. Please try again later.";
        die();
      }
      else {
        print "Congrats! You've connected to an Oracle database!";
        oci_close($conn);
      }


    echo "base 2 ";
    $query = " select * from map_usuarios ";
    $stid = oci_parse($conn, $query);
    oci_execute($stid, OCI_DEFAULT);

    echo "<table>";
    while ($row = oci_fetch_array($stid, OCI_ASSOC)) { 
    echo "<tr>";
    foreach ($row as $item) { 
        echo "<td> " . $item . " </td>";
    } echo "</tr>"; }
    echo "</table>";

    oci_free_statement($stid);
    oci_close($conn);


   








// Conecta al servicio XE (esto es, una base de datos) en la máquina "localhost"
    $conn = oci_pconnect($usuario, $clave, '201.218.0.67:1521/dbgye');
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    $stid = oci_parse($conn, 'SELECT * FROM ' + $tabla);
    oci_execute($stid);

    echo "<table border='1'>\n";
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";

    */

?>