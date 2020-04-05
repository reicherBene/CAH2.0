<?php
// Zum Aufbau der Verbindung zur Datenbank
define ( 'MYSQL_HOST',      'localhost' );
define ( 'MYSQL_BENUTZER',  'root' );
define ( 'MYSQL_KENNWORT',  '' );
define ( 'MYSQL_DATENBANK', 'adressverwaltung' );
 
$db_link = mysqli_connect (MYSQL_HOST, 
                           MYSQL_BENUTZER, 
                           MYSQL_KENNWORT, 
                           MYSQL_DATENBANK);
$db_link->set_charset("utf-8");

$entry1 = mysqli_query($db_link, "INSERT INTO hallo VALUES (1,2343,456,234532);");
$entry2 = mysqli_query($db_link, "INSERT INTO hallo VALUES (435526, 528575, 73456, 874683);");


$query = mysqli_query($db_link, "SELECT * FROM hallo");
 
if ( $db_link )
{
    echo 'Verbindung erfolgreich';
}
else
{
    // hier sollte dann später dem Programmierer eine
    // E-Mail mit dem Problem zukommen gelassen werden
    die('keine Verbindung möglich: ' . mysqli_error());
}

$data = $query->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>verbindung aufgebaut</title>
		<style type="text/css">
			
			h1{
				font-family: sans-serif;
				color: navy;
			}
			
			table{
				border: 1px solid navy;
			}
			
		</style>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<h1>Herzlich wilkommen auf der Verbindungsaufbauwebseite</h1>

<?php
$tableHead = [];
$tableData = [];
$headCount = 0;
$dataCount = 0;


?>

<table cellspacing="0">
			
			<tr class="header"> 
				<?php foreach($data[0] as $key=>$value): ?>
					<th><?= $key ?></th>
				<?php endforeach; ?>
			</tr>
			
			<?php foreach($data as $row): ?>
				<tr>
					<?php foreach($row as $value): ?>
						<td><?= $value ?></td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
			
			<?php 
				$query2 = mysqli_query($db_link, "SELECT SUM(*) FROM hallo");
				try{
					$content = $query2->fetch_all(MYSQLI_ASSOC);
				}catch(Exception $e){
					//do nothing
				}
				
				foreach($content as $row): ?>
				<tr>
					<?php foreach($row as $value): ?>
						<td><?= $value ?></td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</table>

</body>
</html>