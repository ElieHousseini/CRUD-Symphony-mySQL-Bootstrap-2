<?php

/*
This file empty was created using the command: php bin/console make:controller

> THIS IS A CONTROLLER:
In Symfony, a controller is usually a class method which is 
used to accept requests, and return a Response object. 
When mapped with a URL, a controller becomes accessible and its response can be viewed.
To facilitate the development of controllers, Symfony provides an AbstractController.
More info here: https://bit.ly/364QYeQ

> What is @Route("/", name="home") ? 
It is simply a navigator that let symfony know that once you navigate to "/"
you should render for example the twig file: blog/home.html.twig
The name is used to refer to the route. So you can write path("home") instead of hard coding
the route again. This gives you the flexibility to change the actual route for example, from
"/" to "/whatever" without actually re-writting the paths again.

> What is happening in the function home() ?
We are passing an array that is key based. This array can be accessed from the route page
which is in this case: home.html.twig

> What is Doctrine ?
Doctrine is an ORM (Object relational Mapping).
It's main goal is to facilitate the manipulation of a relational DB
in a way that you do not need to write any SQL query what so ever.
It's formed from 3 main parts:
    - Entity: Represent a table in the Database.
    - Manager: allow the manipulation of a row in database table by doing CRUD operations.
    - Repository: Allow you do Selections.

> What is a migration file in Doctrine ?
it's a file that can express how my DB looks. 
You can run the commands in it on your DB and those commands are able to make
your DB very similar to the one I have here. 
It's useful when many developers are working on the same project. 
They can run it then they do not need to run any other sql commands to memic how your
DB looks.
You can do as much migrations as you want. But be careful from there order.
more info here: https://bit.ly/2G0hAmr

> What is a DoctrineFixturesBundle ?
It's a script that is role is to create fake data to fill some rows of a table in the dabase.
more info here: https://bit.ly/30b8478

> How do I create a database using Doctrine ?
Run the following command: php bin/console doctrine:database:create

> How do I create a table in database using Doctrine ?
Run the following command: php bin/console make:entity

> How do I migrate the entites to the database ?
Run the following commands: 
- php bin/console make:migration
- php bin/console make:migrate
checkout the VersionXXX file created under the migrations folder
for sql commands.

> How do I add DoctrineFixturesBundle ?
Run the following commands: 
- composer require orm-fixtures --dev
- php bin/console make:fixtures
checkout the ArticleFixtures file created under the DataFixtures folder
to load fake data to the dabase.

> How do I load the fake data to the database ?
Run the following command: php bin/console doctrine:fixtures:load

> What is a Repo ?
It's a tool that we can select data from a table in the database.
Why I commented out this line: $repo = $this->getDoctrine()->getRepository(Article::class) ?
First, we need to understand that index() is a dependant function, which means it only
works in case there an entity called Article and a table inside the DB also called Article.
Second, the line mentioned in the question above is responsible to tell Doctrine that 
I need a repository named Article.
However, if I just added this repo as prop inside that function, Symfony will 
understand that I need the Reposoitory Article in order for the function to work correctly.
Therefore, Symfony will import it automatically and I do not need that ligne.

> Why I commented the line $article = $repo->find($id) ?
Symfony knows that route ends with {id} so I am requesting for something with an id.
When I give Article as prop, that rings the bell for Symfony that I need an article 
with an {id} which is defined according to the route.
This concept is called @ParamConverter.
More info here: https://bit.ly/30aBfqV

> What does create() function do ?
Since the create form is of method 'post', it will be sending data to the server somehow.
This data will be enveloped in something called request.
In the function create(), I am requiring a request Object and a manage object.
the command: dump($request) means I want to analyse the request. It's optional in this code.
After that, the if statement is checking if the request contains actually more than 0 data.
Those data are actually the data that the user entered before submitting the form.
if the case is true, I am creating an article using the those data provided.
After that I am uploading the data to the DB using persist() and flush() functions.
Then I am redirecting the user to the show page according to the ID red from the data.
In other words, after submitting the info, the user will see the data that he filled in the 
form inside an article.

> Why I commented the code inside create() and decided to re-implement it ?
As we see the code is a long for a small task that the function is actually doing
which is creating a new Article. In fact, Symfony provided us a new syntax for replicating 
was I was doing with the previous code with less coding.
more info here: https://bit.ly/2GcEreg

> How does Symfony knows the type of elements I want in the function create() ?
Symfony gets field types from the database.
Therefore in this case, context field in the database was of type longtext,
that translates to textarea in html, same goes with title, it's varchar(255) 
in the database so in html it translates to normal input field.


> How do I add a class to a form field ?
just add the type you want as second prop of the field 
for example: ->add('content', TextareaType::class, 'attr' => ['placeholder' => 'write here'])
make sure you import it on top of the page before using it.
Note: You can always choose the type of input you want without being binded with
the type declared in the  database by adding a second prop with the type.
for example:  ->add('content', TextType:class)
more info here: https://bit.ly/2GcEreg seach for [Form types] section.

> How to add HTML to a form field ?
use the prop 'attr' and pass whatever HTML you want to the element.
for example: ->add('content', TextareaType::class, 'attr' => ['placeholder' => 'write here'])

> Why I commented the bootstrap classes inside form ?
it's because I added Bootrap as a general theme inside the bin/config/twig.yaml
it will be added to all corresponding elements. You can still put any class you want.
but in the case of bootstrap it's automatic.

> Why I added the button Submit inside the create.html.twig not here ?
When I add buttons here, there functionality will be locked to one task. 
however, when I put it in the create.html.twig it will be multi purpose. 
In this case, the button Submit will trigger adding or editing an article.

> What does  $form->handleRequest($request) do ?
it handles the request, and knows if eveything is alright with the request.

! NOTE: the create() function is now called form(), it is responsible to update and create
! articles. 

> Why am I defaulting the prop (Article $article = null) inside the function form mean to null ?
because when I create a new article, the article would not have any ID or Title or anything.
But in the code inside the function form, I am accessing it's attributes which in this case
can cause a no reference error crash. Therefore, defaulting the value of the $article
to null, will protect me from that crash and the app will run continue running normally.

> Creating a form using CLI:
use the command: php bin/console make:form
the form will be generated in the form folder inside src

> what does $form = $this->createForm(ArticleType::class, $article) do ?
it will create the form using the entity class that we generated using from CLI

> We created an entity called Catergory and we integrate it

*/

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\ArticleType;
use App\Form\CommentType;
use App\Entity\Comment;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ObjectManager;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
        // Getting Repo data from database using Entity "Article"
        // $repo = $this->getDoctrine()->getRepository(Article::class);

        // Getting all the data 
        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
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
     * @Route("/blog/new",name="blog_create")
     * @Route("/blog/{id}/edit", name="blog_edit")
     */

    public function form(Article $article = null, Request $request, EntityManagerInterface $manager)
    {

        // dump($request);

        // if ($request->request->count() > 0) {
        //     $article = new Article();
        //     $article->setTitle($request->request->get('title'))
        //         ->setContent($request->request->get('content'))
        //         ->setImage($request->request->get('image'))
        //         ->setCreatedAt(new \DateTime());

        //     $manager->persist($article);
        //     $manager->flush();

        //     return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        // }

        // $article = new Article();
        // -----------------------------------------------
        if (!$article) {
            $article = new Article();
        }
        // $form = $this->createFormBuilder($article)
        //     ->add('title', TextType::class, [
        //         // 'attr' => [
        //         //     'placeholder' => 'titre de larticle',
        //         // 'class' => 'form-control'
        //         // ]
        //     ])
        //     ->add('content', TextareaType::class, [
        //         // 'attr' => [
        //         //     'placeholder' => 'Contenu de larticle',
        //         // 'class' => 'form-control'
        //         // ]
        //     ])
        //     ->add('image', TextType::class, [
        //         // 'attr' => [
        //         //     'placeholder' => 'image de larticle',
        //         // 'class' => 'form-control'
        //         // ]
        //     ])
        //     ->getForm();
        //----------------------

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        // dump($article);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }
            $article->setCreatedAt(new \DateTime());

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }


        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() != null
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    // public function show(ArticleRepository $repo, $id)
    public function show(Article $article, Request $request, EntityManagerInterface $manager)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                ->setArticle($article);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        // $repo = $this->getDoctrine()->getRepository(Article::class);
        // $article = $repo->find($id);
        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }
}
