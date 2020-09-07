

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
$dbname = 'olx';
$host = 'localhost';
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
//connection
$pdo = new PDO($dsn, $user, $pass);




// to fetch product list from selected table

function myquery($limits, $cat_id)
{
   global $pdo;
   $sql = "SELECT * FROM product WHERE category_id=:category_id LIMIT $limits";
   $stmt = $pdo->prepare($sql);
   $stmt->execute([':category_id' => $cat_id]);

   // $result = $pdo->query($sql);
   return $stmt;
}

?>