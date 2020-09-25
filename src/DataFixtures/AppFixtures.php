<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;

/*
What am I doing here ?
I am simply filling the fake data using DoctrineDixtureBundle
so it can be put as row inside the dabase table.

excute this commad to put the data inside the database: 
- php bin/console doctrine:fixtures:load

 */

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $article = new Article();
            $article
                ->setTitle("Titre de larticle $i")
                ->setContent("<p>Contenu de larticle $i</p>")
                ->setImage("http://placehold.it/350x100")
                ->setCreatedAt(new \DateTime());
            $manager->persist($article);
        }
        $manager->flush();
    }
}
