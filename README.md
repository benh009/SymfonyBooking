# SymfonyBooking


## Installation wamp
wamp = Windows Apache MySQL PHP
## PHP helloworld

```php
<h1> Demo HelloWorld </h1>
<?php
echo 'Bonjour le monde !' ;
?>
```
lien : http://localhost/demophp/

## PHP DB 

```sql
CREATE DATABASE test
```

```sql
CREATE TABLE `test`.`user` 
( 
	`Id` INT NOT NULL AUTO_INCREMENT ,
	`Name` VARCHAR(256) NOT NULL , PRIMARY KEY (`Id`)
) ENGINE = InnoDB; 
```

```sql
INSERT INTO `user` (`Id`, `Name`) VALUES 
	(NULL, 'Jonathan'),
	(NULL, 'Franklin'),
	(NULL, 'Benoit'),
	(NULL, 'Maxime');
```


```php

<?php $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8mb4', 'root', '') ?>
	<h1> Demo Db </h1>
	<table>
		<tr>
			<th>
				Name 
			</th>
			<th>
				id
			</th>
		</tr>

		<?php foreach($db->query('SELECT * FROM user') as $row) : ?>
			<tr>
				<td> <?php echo $row['Name']?> </td>  <td>  <?php echo $row['Id'] ?></td>
			</tr>
		<?php endforeach ?>
</table>

?> 
```


## Installation la base de symfony 
``` 
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar create-project symfony/skeleton booking
```
