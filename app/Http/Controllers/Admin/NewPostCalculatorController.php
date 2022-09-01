<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NewPostService;
use Daaner\NovaPoshta\Models\Address;
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

        dd($cities);
        return view('admin.new-post-calculator.index');
    }
}
