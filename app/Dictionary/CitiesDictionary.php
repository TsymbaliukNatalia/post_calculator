<?php

namespace App\Dictionary;

use Daaner\NovaPoshta\Models\Address;

class CitiesDictionary
{
    /**
     *
     * @return array[]
     */
    public static function getCityNamesList(): array
    {
        return [
            'Вінниця',
            'Дніпро',
            'Житомир',
            'Запоріжжя',
            'Івано-Франківськ',
            'Київ',
            'Луцьк',
            'Львів',
            'Миколаїв',
            'Одеса',
            'Полтава',
            'Рівне',
            'Суми',
            'Тернопіль',
            'Ужгород',
            'Харків',
            'Херсон',
            'Хмельницький',
            'Черкаси',
            'Чернівці',
            'Чернігів',
        ];
    }

    /**
     *
     * @return array[]
     */
    public static function getCitiesList(): array
    {
        $cities = [];
        $cityNames = self::getCityNamesList();
        foreach ($cityNames as $cityName){
            $adr = new Address;
            $city = $adr->getCities($cityName);
            if(isset($city['result'][0])){
                array_push($cities, $city['result'][0]);
            }
        }
        return $cities;
    }
}
