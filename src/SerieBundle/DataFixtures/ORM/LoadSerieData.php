<?php
// src/SerieBundle/DataFixtures/ORM/LoadSerieData.php
namespace AppBundle\DataFixtures\ORM;

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
        $amtserie = 5;
        $amtseason = 3;
        $amtep = 3;
        $cover = ['http://i.imgur.com/Oy1luxk.jpg', 'http://i.imgur.com/AN3qVC1.jpg', 'http://i.imgur.com/AN6Ouxw.jpg', 'http://i.imgur.com/AN4Dd.jpg', 'http://i.imgur.com/CaaDGS0.jpg'];

        //prepare the serie
        for ($ii = 0; $ii < $amtserie; $ii++) {
          $serie = new Serie();
            $serie->setName('Serie ' + $ii);
            $serie->setCountry('FR');
            $serie->setCreationDate(new \DateTime());
            $serie->setCover($cover[$ii]);
            $serie->setState(1);
            $serie->setAdminApproved(true);

            //prepare some test seasons
            for ($jj = 1; $jj <= $amtseason; $jj++) {
                $season = new Season();
                $season->setNumber($jj);
                $season->setImage($cover[$jj]);
                $season->setYear(new \DateTime());
                $season->setSerie($serie);

                //add episodes here
                for ($kk = 1; $kk <= $amtep; $kk++) {
                  $episode = new Episode();
                    $episode->setName('Episode ' + $kk);
                    $episode->setLength(45);
                    $episode->setSeason($season);

                    $season->addEpisode($episode);
                }
                $serie->addSeason($season);
            }

            //finally, add the serie
            $manager->persist($serie);

        }

        //add the data to the database
        $manager->flush();
    }
}