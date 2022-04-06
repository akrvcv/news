<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $newsCount = rand(2, 12);
        for ($i = 1; $i < $newsCount; ++$i) {
            $news = new News();
            $news->setTitle("Новости из мира $i");
            $news->setAnnotation("Вы не поверите...но всего лишь $i мин кодинга в день...");
            $news->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus mollis, odio sit amet rutrum pharetra, mauris lacus ullamcorper ante.');
            $news->setViewCount(rand(1, 255));

            $commentCount = rand(3, 7);
            for ($j = 1; $j < $commentCount; ++$j) {
                $comment = new Comment();
                $comment->setBody("Неплохая новость $i, прочитал $j раз");
                $manager->persist($comment);
                $news->addComment($comment);
            }

            $manager->persist($news);
        }

        $manager->flush();
    }
}
