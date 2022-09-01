<?php

namespace App\Services;

use Daaner\NovaPoshta\Models\Address;
use Daaner\NovaPoshta\Models\Common;

class NewPostService
{
    /**
     * @param int $limit
     * @param int $page
     * @return array
     */
    public static function getCitiesList(int $limit, int $page) : array
    {
        $adr = new Address;
        $adr->setLimit($limit);
        $adr->setPage($page);
        $cities = $adr->getCities();

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
