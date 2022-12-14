<?php

namespace App\Http\Controllers\Admin;

use App\Dictionary\CitiesDictionary;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewPostCalculator\Calculate;
use App\Services\NewPostService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class NewPostCalculatorController extends Controller
{
    public $adminUser;

    /**
     * Guard used for admin user
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * NewPostCalculatorController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->guard = config('admin-auth.defaults.guard');
    }

    /**
     * Obtaining data to display a page with a calculator
     * for the cost of cargo delivery by Nova Poshta
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $cities = CitiesDictionary::getCitiesList();
        $serviceTypes = NewPostService::getServiceTypesList();
        $cargoTypes = NewPostService::getCargoTypesList();

        return view('admin.new-post-calculator.index', [
            'cities' => json_encode($cities),
            'serviceTypes' => json_encode($serviceTypes),
            'cargoTypes' => json_encode($cargoTypes),
        ]);
    }


    /**
     * Search for a city by the given term with the name or part of the city name
     * In the absence of the passed parameter, it returns the default list of cities
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchCities(Request $request): JsonResponse
    {
        if (!isset($request->name)) {
            $cities = CitiesDictionary::getCitiesList();
        } else {
            $cities = NewPostService::searchCitiesList($request->name) ?? [];
        }

        return Response::json($cities);
    }

    /**
     * Calculation of the cost of delivery based on the transmitted parameters
     *
     * @param Calculate $request
     * @return JsonResponse
     */
    public function calculate(Calculate $request): JsonResponse
    {
        $methodProperties = [
            "CitySender" => $request->CitySender['Ref'],
            "CityRecipient" => $request->CityRecipient['Ref'],
            "Weight" => $request->Weigth,
            "ServiceType" => $request->ServiceType['Ref'],
            "Cost" => $request->Cost,
            "CargoType" => $request->CargoType['Ref'],
            "SeatsAmount" => $request->NumberSeats,
        ];
        $data = NewPostService::calculationShippingCosts($methodProperties);
        return Response::json($data);
    }
}
