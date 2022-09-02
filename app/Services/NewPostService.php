<?php

namespace App\Services;

use Daaner\NovaPoshta\Models\Address;
use Daaner\NovaPoshta\Models\Common;

class NewPostService
{
    /**
     * @param string $cityName
     * @return array
     */
    public static function searchCitiesList(string $cityName) : ?array
    {
        $adr = new Address;
        $cities = $adr->getCities($cityName);

        return $cities['result'];
    }

    /**
     * @return array
     */
    public static function getServiceTypesList() : array
    {
        $c = new Common;
        $list = $c->getServiceTypes();

        return $list['result'];
    }

    /**
     * @return array
     */
    public static function getCargoTypesList() : array
    {
        $c = new Common;
        $list = $c->getCargoTypes();

        return $list['result'];
    }
}
