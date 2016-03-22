<?php
// src/SerieBundle/DataFixtures/ORM/LoadSerieData.php
namespace SerieBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SerieBundle\Entity\Serie;
use SerieBundle\Entity\Season;
use SerieBundle\Entity\Episode;

class LoadSerieData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //Amount of test data
        $amtseason = 3;
        $amtep = 3;
        $cover = ['http://i.imgur.com/Oy1luxk.jpg', 'http://i.imgur.com/AN3qVC1.jpg', 'http://i.imgur.com/AN6Ouxw.jpg', 'http://i.imgur.com/AN4Dd.jpg', 'http://i.imgur.com/CaaDGS0.jpg'];

        $serie1 = new Serie();
        $serie1->setName('Daredevil');
        $serie1->setCountry('US');
        $serie1->setCreationDate(new \DateTime());
        $serie1->setCover('http://thetvdb.com/banners/graphical/281662-g3.jpg');
        $serie1->setState(1);
        $serie1->setAdminApproved(true);
        $serie1->setDescription('Matt Murdock was blinded in a tragic accident as a boy, but imbued with extraordinary senses. Murdock sets up practice in his old neighborhood of Hell\'s Kitchen, New York, where he now fights against injustice as a respected lawyer by day and as the masked vigilante Daredevil by night.');

        //prepare some test seasons
        for ($jj = 1; $jj <= $amtseason; $jj++) {
            $season = new Season();
            $season->setNumber($jj);
            $season->setImage($cover[$jj]);
            $season->setYear(new \DateTime());
            $season->setSerie($serie1);

            //add episodes here
            for ($kk = 1; $kk <= $amtep; $kk++) {
                $episode = new Episode();
                $episode->setName('Episode ' + $kk);
                $episode->setLength(45);
                $episode->setSeason($season);

                $season->addEpisode($episode);
            }
            $serie1->addSeason($season);
        }

        $manager->persist($serie1);

        $serie2 = new Serie();
        $serie2->setName('Attack On Titan');
        $serie2->setCountry('JP');
        $serie2->setCreationDate(new \DateTime());
        $serie2->setCover('http://thetvdb.com/banners/graphical/267440-g.jpg');
        $serie2->setState(1);
        $serie2->setAdminApproved(true);
        $serie2->setDescription('Several hundred years ago, humans were nearly exterminated by the Titans. Titans are typically several stories tall, seem to have no intelligence, devour human beings, and worst of all, seem to do it for the pleasure rather than as a food source. A small percentage of humanity survived by building a city protected by extremely high walls, even taller than the largest of Titans. Flash forward to the present and the city has not seen a Titan in over a hundred years, until one day, a Colossal Titan appears out of thin air and destroys part of the city wall. As teenage boy, Eren Jaeger, and his foster sister, Mikasa Ackerman, witness the destruction of their town and death of their mother at the hands of the Titans, Eren vows to kill every single Titan and take revenge for all of mankind.');

        //prepare some test seasons
        for ($jj = 1; $jj <= $amtseason; $jj++) {
            $season = new Season();
            $season->setNumber($jj);
            $season->setImage($cover[$jj]);
            $season->setYear(new \DateTime());
            $season->setSerie($serie2);

            //add episodes here
            for ($kk = 1; $kk <= $amtep; $kk++) {
                $episode = new Episode();
                $episode->setName('Episode ' + $kk);
                $episode->setLength(45);
                $episode->setSeason($season);

                $season->addEpisode($episode);
            }
            $serie2->addSeason($season);
        }

        $manager->persist($serie2);



        //add the data to the database
        $manager->flush();
    }
}