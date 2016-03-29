<?php

namespace TVDBBundle\Model;
use SerieBundle\Entity\Serie;
use SerieBundle\Entity\Season;
use SerieBundle\Entity\Episode;

/**
 * TVDB class
 * Created for the FishBlock project
 */
class TVDB
{
    private $key = 'A2E38C5FFA8BAA1C';
    private $url = 'http://thetvdb.com/api/';

    /*
     * Get initial data from TVDB
     */
    public function requestSerie($name, $lang)
    {
        $urlbuilder = $this->url . 'GetSeries.php?seriesname=' . $name . '&language=' . $lang;
        $urlbuilder = str_replace(" ", "%20", $urlbuilder);

        $request = curl_init($urlbuilder);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_URL, $urlbuilder);

        $data = curl_exec($request);
        curl_close($request);

        $xml = simplexml_load_string($data);
        return $xml;
    }

    /*
     * Get detailed data from TVDB
     */
    public function requestDetailedSerie($id, $lang)
    {
        $urlbuilder = $this->url . $this->key . '/series/' . $id . '/all/' . $lang . '.xml';

        $request = curl_init($urlbuilder);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_URL, $urlbuilder);

        $data = curl_exec($request);
        curl_close($request);

        $xml = simplexml_load_string($data);

        return $xml;
    }

    /*
     * Process and rearrange the initial data provided by TVDB, we do this separately for readability
     */
    public function sortDetailedData($xml)
    {
        $sorted = [];

        //First iteration, we gather initial data to set up the necessary boundaries
        foreach ($xml->Episode as $episode)
        {
            $sorted[intval($episode->SeasonNumber)][intval($episode->EpisodeNumber)] = $episode;
        }

        for ($jj = 0; $jj < sizeof($sorted); $jj++) {
            $sorted[$jj] = array_values($sorted[$jj]);
        }

        //var_dump($sorted);
        //die;

        $serie = new Serie();
        $serie->setName($xml->Series->SeriesName);
        $serie->setDescription($xml->Series->Overview);
        $serie->setCreationDate(new \DateTime());
        $serie->setState(1);
        $serie->setAdminApproved(0);
        $serie->setTVDBid($xml->Series->id);
        $serie->setLastTVDBUpdate(new \DateTime());
        $serie->setCover('http://thetvdb.com/banners/' . $xml->Series->banner);

        //var_dump($xml);
        for ($ii = 0; $ii < sizeof($sorted); $ii++) {
            $season = new Season();
            $season->setNumber($sorted[$ii][0]->SeasonNumber);
            $season->setImage('http://thetvdb.com/banners/seasons/' . $xml->Series->id . '-' . $sorted[$ii][0]->SeasonNumber . '.jpg');
            $season->setSerie($serie);

            for ($kk = 0; $kk < sizeof($sorted[$ii]); $kk++) {
              $episode = new Episode();
                $episode->setName($sorted[$ii][$kk]->EpisodeName);
                $episode->setNumber($sorted[$ii][$kk]->EpisodeNumber);
                $episode->setSeason($season);

                $season->addEpisode($episode);
            }

            $serie->addSeason($season);
        }

        return $serie;
    }
}