<?php

/*
This file was created using the command: php bin/console make:controller

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
}
