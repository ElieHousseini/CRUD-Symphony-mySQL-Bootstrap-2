<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;

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
        $faker = \Faker\Factory::create('fr_FR');

        // Creating 3 fake categories
        for ($i = 1; $i <= 3; $i++) {
            $category = new Category();
            $category->setTitle($faker->sentence())
                ->setDescription($faker->paragraph());

            $manager->persist($category);

            // Creating between 4 et 6 articles
            for ($j = 1; $j <= mt_rand(4, 6); $j++) {
                $article = new Article();

                $content = '<p>';
                $content .= '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>';
                $content .= '</p>';

                $article
                    ->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setCategory($category);

                $manager->persist($article);

                // giving comments for articles
                for ($k = 1; $k <= mt_rand(4, 10); $k++) {
                    $comment = new Comment();

                    $content = '<p>' . join($faker->paragraphs(2), '</p><p>') . '</p>';

                    $now = new \DateTime();
                    $days = $now->diff($article->getCreatedAt())->days;
                    $minimum = '-' . $days . ' days'; // -100 days

                    $comment->setAuthor($faker->name)
                        ->setContent($content)
                        ->setCreatedAt($faker->dateTimeBetween($minimum))
                        ->setArticle($article);

                    $manager->persist($comment);
                }
            }
        }


        $manager->flush();
    }
}
