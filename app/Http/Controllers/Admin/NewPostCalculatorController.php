<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NewPostService;
use Daaner\NovaPoshta\Models\Address;
use Daaner\NovaPoshta\Models\Common;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
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
        $cities = NewPostService::getCitiesList($this->perPage, $this->page);
        $serviceTypes =  NewPostService::getServiceTypesList();
        $cargoTypes =  NewPostService::getCargoTypesList();

//
//        dd($serviceTypes);
        return view('admin.new-post-calculator.index', [
            'cities' => json_encode($cities),
            'serviceTypes' => json_encode($serviceTypes),
            'cargoTypes' => json_encode($cargoTypes),
        ]);
    }
}
