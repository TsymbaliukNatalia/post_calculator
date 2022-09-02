<?php

namespace App\Services;

use Daaner\NovaPoshta\Models\Address;
use Daaner\NovaPoshta\Models\Common;
use Daaner\NovaPoshta\NovaPoshta;

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


    /**
     * @param array $methodProperties
     * @return array
     */
    public static function calculationShippingCosts(array $methodProperties) : array
    {
        $model = 'InternetDocument';
        $calledMethod = 'getDocumentPrice';
        $np = new NovaPoshta;
        $data = $np->getResponse($model, $calledMethod, $methodProperties, $auth = true);
        return $data;
    }
}
