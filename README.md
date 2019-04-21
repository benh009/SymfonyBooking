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



## Symfony twig 

```
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require twig
```

```php
<?php
// src/Controller/HelloWorldController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HelloWorldController
{

    public function index()
    {
        return new Response(
            'Hello, World!'
        );
    }
	
  public function index2(Environment $twig)
  {
    $content = $twig->render('HelloWorld/index.html.twig',['name' => 'winzou']);

    return new Response($content);
  }
}
```

```yaml
# config/routes.yaml

hello_the_world:
    path:       /hello-world
    controller: App\Controller\HelloWorldController::index
    
hello_the_world2:
    path:       /hello-world2
    controller: App\Controller\HelloWorldController::index2
```

```twig
<h1>Hello {{ name }} !</h1>
```

## Symfony ORM/API/ADMIN

```
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require orm
```

```
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require admin
```


```
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require api
```

## Symfony maker 

```
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require maker
```

```
C:\wamp\bin\php\php7.3.1\php ./bin/console make:entity Client --api-resource
FirstName
LastName
```


```php
<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LastName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }
}
```


```php
<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Client::class);
    }

    // /**
    //  * @return Client[] Returns an array of Client objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Client
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

```



```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```

```
DATABASE_URL=mysql://root:@127.0.0.1:3306/test
```

```
C:\wamp\bin\php\php7.3.1\php ./bin/console make:migration
```

```php
<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190421083952 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE user');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (Id INT AUTO_INCREMENT NOT NULL, Name VARCHAR(256) NOT NULL COLLATE latin1_swedish_ci, PRIMARY KEY(Id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE client');
    }
}
```

```
C:\wamp\bin\php\php7.3.1\php ./bin/console doctrine:migrations:migrate
```

## Symfony API


```
C:\wamp\bin\php\php7.3.1\php ./bin/console make:entity Client --api-resource
FirstName
LastName
```

http://localhost/demobooking/public/api


## symfony graphql 
```
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require webonyx/graphql-php
```

http://localhost/demobooking/public/api/graphql

add entity + requete


## Symfony debug

```
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require symfony/debug ???

C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require profiler --dev

```


## Symfony Admin
```yaml
easy_admin:
    entities:
        - App\Entity\Client

```

