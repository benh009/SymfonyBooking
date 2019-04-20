
<?php
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8mb4', 'root', '');
foreach($db->query('SELECT * FROM user') as $row) {
echo $row['Name'].' '.$row['Id']; 
}
?> 