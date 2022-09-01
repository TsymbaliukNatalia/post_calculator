<?php

namespace App\Services;

use Daaner\NovaPoshta\Models\Address;

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

        return $adr->getCities();
    }
}
