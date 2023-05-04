<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Services\NasabahService;
use App\Http\Requests\Report\ReportRequest;

class ReportController extends Controller
{
    protected $route;
    protected $view;
    protected $reportService;
    protected $nasabahService;

    public function __construct()
    {
        $this->route = "dashboard.report.";
        $this->view = "dashboard.report.";
        $this->reportService = new ReportService();
        $this->nasabahService = new NasabahService();
    }

    public function index(Request $request)
    {
        $check = $request->all();

        $nasabah = $this->nasabahService->index($request,false);
        $nasabah = $nasabah->data;

        if(empty($check)){

            $data = [
                'table' => null,
                'nasabah' => $nasabah,
            ];
    
            return view($this->view . 'index', $data);
        }
        else{
            $request = new ReportRequest([
                'nasabah_id' => $request->nasabah_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
            $response = $this->reportService->index($request);            

            $data = [
                'table' => $response->data,
                'nasabah' => $nasabah,
            ];
    
            return view($this->view . 'index', $data);
        }
    }
}
