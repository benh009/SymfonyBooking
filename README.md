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

commit : 2eed2744213bc9dde1af48dbe678ada0d3c8e313



``` 
cd C:\Users\benoithofbauer\Desktop\perso\symfony\Presentation\SymfonyBooking
``` 

Composer permet d'installer des libs.

``` 
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar create-project symfony/skeleton booking
```

http://localhost/demobooking/public/

## Symfony HelloWorld

``` 
cd C:\Users\benoithofbauer\Desktop\perso\symfony\Presentation\SymfonyBooking\booking
``` 

``` 
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require symfony/apache-pack
``` 

ajoute le fichier .htaccess

```php
<?php
// src/Controller/HelloWorldController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloWorldController
{

    public function index()
    {
        return new Response(
            'Hello, World!'
        );
    }
}
``` 

```yaml
# config/routes.yaml

hello_the_world:
    path:       /hello-world
    controller: App\Controller\HelloWorldController::index
``` 