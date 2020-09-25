<?php

/*
This file empty was created using the command: php bin/console make:controller

THIS IS A CONTROLLER:
In Symfony, a controller is usually a class method which is 
used to accept requests, and return a Response object. 
When mapped with a URL, a controller becomes accessible and its response can be viewed.
To facilitate the development of controllers, Symfony provides an AbstractController.
More info here: https://symfony.com/doc/current/the-fast-track/en/6-controller.html

What is @Route("/", name="home") ? 
It is simply a navigator that let symfony know that once you navigate to "/"
you should render for example the twig file: blog/home.html.twig
The name is used to refer to the route. So you can write path("home") instead of hard coding
the route again. This gives you the flexibility to change the actual route for example, from
"/" to "/whatever" without actually re-writting the paths again.

What is happening in the function home() ?
We are passing an array that is key based. This array can be accessed from the route page
which is in this case: home.html.twig

What is Doctrine ?
Doctrine is an ORM (Object relational Mapping).
It's main goal is to facilitate the manipulation of a relational DB
in a way that you do not need to write any SQL query what so ever.
It's formed from 3 main parts:
    - Entity: Represent a table in the Database.
    - Manager: allow the manipulation of a row in database table by doing CRUD operations.
    - Repository: Allow you do Selections.

What is a migration file in Doctrine ?
it's a file that can express how my DB looks. 
You can run the commands in it on your DB and those commands are able to make
your DB very similar to the one I have here. 
It's useful when many developers are working on the same project. 
They can run it then they do not need to run any other sql commands to memic how your
DB looks.
You can do as much migrations as you want. But be careful from there order.
more info here: https://bit.ly/2G0hAmr

What is a DoctrineFixturesBundle ?
It's a script that is role is to create fake data to fill some rows of a table in the dabase.
more info here: https://bit.ly/30b8478

How do I create a dabase using Doctrine ?
Run the following command: php bin/console doctrine:database:create

How do I create a table in database using Doctrine ?
Run the following command: php bin/console make:entity

*/

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'title' => "Bienvenue ici les amis !",
            'age' => 21
        ]);
    }
    /**
     * @Route("/blog/12", name="blog_show")
     */
    public function show()
    {
        return $this->render('blog/show.html.twig');
    }
}
