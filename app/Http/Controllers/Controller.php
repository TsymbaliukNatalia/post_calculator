<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Illuminate\Http\Request instance.
     *
     * @var Request
     */
    protected $request;

    /**
     * Number of items displayed at once if not specified.
     * There is no per_page if it is 1 or 0.
     *
     * @var int
     */
    protected int $defaultPerPage = 100;

    /**
     * Maximum per_page that can be set via $_GET['per_page'].
     *
     * @var int
     */
    protected int $maximumPerPage = 200;

    /**
     * Default per_page that can be set via $_GET['per_page'].
     *
     * @var int
     */
    protected int $perPage;

    /**
     * Default page that can be set via $_GET['page'].
     *
     * @var int
     */
    protected int $page;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->request = request();
        $this->perPage = $this->calculatePerPage();
        $this->page = $this->calculatePage();
    }

    /**
     * Calculates per_page for a number of items displayed in list.
     *
     * @return int
     */
    protected function calculatePerPage(): int
    {
        $per_page = (int)$this->request->input('per_page', $this->defaultPerPage);
        $per_page = ($this->maximumPerPage && $this->maximumPerPage < $per_page) ? $this->maximumPerPage : $per_page;

        return $per_page ?: $this->defaultPerPage;
    }

    /**
     * Calculates page number for displayed in list.
     *
     * @return int
     */
    protected function calculatePage(): int
    {
        return (int)$this->request->input('page', 1);
    }

}
