<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Nasabah\StoreRequest;
use App\Http\Requests\Nasabah\UpdateRequest;
use App\Services\NasabahService;
use Log;

class NasabahController extends Controller
{
    protected $route;
    protected $view;
    protected $nasabahService;

    public function __construct()
    {
        $this->route = "dashboard.nasabah.";
        $this->view = "dashboard.nasabah.";
        $this->nasabahService = new NasabahService();
    }

    public function index(Request $request)
    {
        $response = $this->nasabahService->index($request);

        $data = [
            'table' => $response->data,
        ];

        return view($this->view . 'index', $data);
    }

    public function store(StoreRequest $request)
    {
        try {
            $response = $this->nasabahService->store($request);
            if (!$response->success) {
                alert()->error('Gagal', $response->message);
                return redirect()->route($this->route . 'index')->withInput();
            }

            alert()->html('Berhasil', $response->message, 'success');
            return redirect()->route($this->route . 'index');
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            alert()->error('Gagal', $th->getMessage());
            return redirect()->route($this->route . 'index')->withInput();
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $response = $this->nasabahService->update($request, $id);
            if (!$response->success) {
                alert()->error('Gagal', $response->message);
                return redirect()->route($this->route . 'index')->withInput();
            }

            alert()->html('Berhasil', $response->message, 'success');
            return redirect()->route($this->route . 'index');
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            alert()->error('Gagal', $th->getMessage());
            return redirect()->route($this->route . 'index')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $response = $this->nasabahService->delete($id);
            if (!$response->success) {
                alert()->error('Gagal', $response->message);
                return redirect()->route($this->route . 'index')->withInput();
            }

            alert()->html('Berhasil', $response->message, 'success');
            return redirect()->route($this->route . 'index');
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            alert()->error('Gagal', $th->getMessage());
            return redirect()->route($this->route . 'index')->withInput();
        }
    }
}
