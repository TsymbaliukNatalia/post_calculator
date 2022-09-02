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

    public function __construct()
    {
        parent::__construct();
        $this->guard = config('admin-auth.defaults.guard');
    }

    /**
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
     * @param Calculate $request
     * @return JsonResponse
     */
    public function calculate(Calculate $request): JsonResponse
    {
//        dd($request->ServiceType);
        $methodProperties = [
            "CitySender" => $request->CitySender['Ref'],
            "CityRecipient" => $request->CityRecipient['Ref'],
            "Weight" => "10",
            "ServiceType" => $request->ServiceType['Ref'],
            "Cost" => "300",
            "CargoType" => $request->CargoType['Ref'],
            "SeatsAmount" => "2",
        ];
        $data = NewPostService::calculationShippingCosts($methodProperties);
        return Response::json($data);
    }
}
