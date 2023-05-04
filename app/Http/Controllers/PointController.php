<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PointService;

class PointController extends Controller
{
    protected $route;
    protected $view;
    protected $pointService;

    public function __construct()
    {
        $this->route = "dashboard.point.";
        $this->view = "dashboard.point.";
        $this->pointService = new PointService();
    }

    public function index(Request $request)
    {
        $response = $this->pointService->index($request);

        $data = [
            'table' => $response->data,
        ];

        return view($this->view . 'index', $data);
    }
}
