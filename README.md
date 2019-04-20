# SymfonyBooking

## Installation 
### Installation wamp
wamp = Windows Apache MySQL PHP
### PHP helloworld

```php
<?php
echo 'Bonjour le monde !' ;
?>
```

### PHP DB 

```php
<?php
$db = new PDO('mysql:host=localhost;dbname=test;charset=utf8mb4', 'root', '');
foreach($db->query('SELECT * FROM user') as $row) {
echo $row['Name'].' '.$row['Id']; 
}
?> 
```


### Installation la base de symfony 
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar create-project symfony/skeleton booking
