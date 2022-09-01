<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
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
        $this->guard = config('admin-auth.defaults.guard');
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.new-post-calculator.index');
    }
}
