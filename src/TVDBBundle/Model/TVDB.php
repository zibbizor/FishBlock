<?php

namespace TVDBBundle\Model;

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

        $request = curl_init($urlbuilder);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_URL, $urlbuilder);

        $data = curl_exec($request);
        curl_close($request);

        $xml = simplexml_load_string($data);

        //ensure we only process one item
        return $xml->Series[0];
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
}