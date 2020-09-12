<?php
require_once "pdo.php";
session_start();
if(isset($_GET['search']))
{
	$a = trim(stripslashes(htmlspecialchars($_GET['user_query'])));
	
	if (strlen($_GET['$a']) < 1)
	{
        $_SESSION['error'] = 'Missing data';
        header("Location: search.php");
        return;
    }
    $a = trim(stripslashes(htmlspecialchars($_GET['$a'])));
    if (!preg_match("/^[a-zA-Z-' ]*$/",$a))
    {
        header("Location: search.php");
        return;
    }
	$sql = "SELECT * FROM product WHERE product_name like '%$a%"';
	$stmt = $pdo->prepare($sql);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt->execute();
	echo<ul>
	while($r = $stmt->fetch()):
		echo"<li>
			<a href = 'pro_detail.php?product_id=".$r['product_id']."'>
			<h4>".$r['product_name']."</h4>
			<center>
					<button id = 'pro_btn'><a href = 'pro_deatail.php?product_id=".$r['product_id']."'>
			</center>
			</a>
			</li>";
	endwhile;
	echo"</ul>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ln.html" method="get"></form>
    <input type="text"name  = 'user_query' placeholder="serach from Here...." style="width: 30%;">
    <button name = 'search' id = "search btn ">Search</button>
</body>
</html>
