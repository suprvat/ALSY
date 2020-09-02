

<?php
/*
ini_set('display_errors', 1);
error_reporting(E_ALL|E_STRICT);

 $connect = mysqli_connect('localhost','root','root','products');

 if(! $connect)
 {
    die(mysqli_connect_error());
 } 


//    global $connect ;
//     $query= "INSERT INTO login (username,password) VALUES ('$userName','$password')";
// mysqli_query($connect,$query);


*/
$user = 'root';
$pass = 'root';
$dbname = 'products';
$host = 'localhost';
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
//connection
$pdo = new PDO($dsn, $user, $pass);



// to fetch product list from selected table

function myquery($limits)
{
   global $pdo;
   $sql = "SELECT * FROM product_list LIMIT $limits";
   $result = $pdo->query($sql);
   return $result;
}

?>