# SymfonyBooking


## Installation wamp
wamp = Windows Apache MySQL PHP

http://www.wampserver.com/

### phpmyadmin
http://localhost/phpmyadmin/index.php

user : "root" 
pwd : ""

database : test 


## HTML helloworld
lien : http://localhost/demophp/HelloWorld.html
## PHP helloworld

```php
<h1> Demo HelloWorld </h1>
<?php
echo 'Bonjour le monde !' ;
?>
```
lien : http://localhost/demophp/HelloWorld.php

## PHP DB 

```sql
CREATE DATABASE test
```

```sql
CREATE TABLE `test`.`userPhp` 
( 
	`Id` INT NOT NULL AUTO_INCREMENT ,
	`Name` VARCHAR(256) NOT NULL , PRIMARY KEY (`Id`)
) ENGINE = InnoDB; 
```

```sql
INSERT INTO `userPhp` (`Id`, `Name`) VALUES 
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

		<?php foreach($db->query('SELECT * FROM userPhp') as $row) : ?>
			<tr>
				<td> <?php echo $row['Name']?> </td>  <td>  <?php echo $row['Id'] ?></td>
			</tr>
		<?php endforeach ?>
</table>

?> 
```

lien : http://localhost/demophp/DBAcces.php


## Installation la base de symfony  

lien : https://symfony.com/

Symfony is a set of reusable PHP components

Symfony 4 vs Symfony 3. Petit module vs Mono block


Doc : https://symfony.com/doc/current/index.html#gsc.tab=0


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

### Setting 

``` 
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require symfony/apache-pack
``` 

la commande ajoute le fichier .htaccess

### MVC 

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

lien : http://localhost/demobooking/public/hello-world

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
lien : http://localhost/demobooking/public/hello-world2
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

Dans le fichier /.env

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

client : http://localhost/demobooking/public/admin/?action=list&entity=Client
user : hofbauer92@gmail.com
pwd :  hofbauer92@gmail.com

## Symfony CRUD

```
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require annotations
```

```
C:\wamp\bin\php\php7.3.1\php ./bin/console make:crud Client
```

```php
<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="client_index", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="client_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/new.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="client_show", methods={"GET"})
     */
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            'client' => $client,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Client $client): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_index', [
                'id' => $client->getId(),
            ]);
        }

        return $this->render('client/edit.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="client_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Client $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('client_index');
    }
}
```

```php
<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FirstName')
            ->add('LastName')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
```

```php
{% extends 'base.html.twig' %}

{% block title %}Client index{% endblock %}

{% block body %}
    <h1>Client index</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        {% for client in clients %}
            <tr>
                <td>{{ client.id }}</td>
                <td>{{ client.FirstName }}</td>
                <td>{{ client.LastName }}</td>
                <td>
                    <a href="{{ path('client_show', {'id': client.id}) }}">show</a>
                    <a href="{{ path('client_edit', {'id': client.id}) }}">edit</a>
                </td>
            </tr>
        {% else %}
            <tr>
                <td colspan="4">no records found</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>

    <a href="{{ path('client_new') }}">Create new</a>
{% endblock %}
```

lien : http://localhost/demobooking/public/client/

## Symfony bootstrap

```yaml
twig:
    default_path: '%kernel.project_dir%/templates'
    debug: '%kernel.debug%'
    strict_variables: '%kernel.debug%'
    form_themes: ['bootstrap_4_layout.html.twig']

```

```twig
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		{% endblock %}
    </head>
    <body>
		<div class="container">
			{% block body %}{% endblock %}
		 </div>
        {% block javascripts %}
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		{% endblock %}
    </body>
</html>

```

## Symfony OneToMany

```
C:\wamp\bin\php\php7.3.1\php ./bin/console make:entity Categorie --api-resource
```

```
C:\wamp\bin\php\php7.3.1\php ./bin/console make:migration
```
```
C:\wamp\bin\php\php7.3.1\php ./bin/console doctrine:migrations:migrate
```

http://localhost/demobooking/public/api

http://localhost/demobooking/public/api/graphql

```json
{
  clients {
    
    edges{
      
      node{
        FirstName,
        LastName,
        categorie{
          Description
        }
      }
    }
  }
}
```

```json 
{
  "data": {
    "clients": {
      "edges": [
        {
          "node": {
            "FirstName": "benoit",
            "LastName": "hofbauer",
            "categorie": {
              "Description": "Particulier"
            }
          }
        }
      ]
    }
  }
}
```

```yaml
easy_admin:
    entities:
        - App\Entity\Client
        - App\Entity\Categorie
```
http://localhost/demobooking/public/admin


```PHP
	public function __toString(){
		return $this->getFirstName();
	}
```

## Symfony security
```
C:\wamp\bin\php\php7.3.1\php C:\ProgramData\ComposerSetup\bin\composer.phar require symfony/security-bundle
```


```
C:\wamp\bin\php\php7.3.1\php ./bin/console make:user
```
```
C:\wamp\bin\php\php7.3.1\php ./bin/console make:migration
```
```
C:\wamp\bin\php\php7.3.1\php ./bin/console doctrine:migrations:migrate
```

https://symfony.com/doc/current/security/form_login_setup.html

```
C:\wamp\bin\php\php7.3.1\php ./bin/console make:auth
```

```
C:\wamp\bin\php\php7.3.1\php ./bin/console make:registration-form
```


```YAML
# config/packages/security.yaml
security:
    # ...

    firewalls:
        main:
            # ...
            logout:
                path:   app_logout

                # where to redirect after logout
                # target: app_any_route

```

```YAML
# config/routes.yaml
app_logout:
    path: /logout
    methods: GET
```