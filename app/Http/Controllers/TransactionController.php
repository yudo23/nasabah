<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Transaction\StoreRequest;
use App\Http\Requests\Transaction\UpdateRequest;
use App\Services\TransactionService;
use App\Services\NasabahService;
use App\Models\Transaction;
use Log;
use Auth;

class TransactionController extends Controller
{
    protected $route;
    protected $view;
    protected $transactionService;
    protected $nasabahService;

    public function __construct()
    {
        $this->route = "dashboard.transaction.";
        $this->view = "dashboard.transaction.";
        $this->transactionService = new TransactionService();
        $this->nasabahService = new NasabahService();
    }

    public function index(Request $request)
    {
        $response = $this->transactionService->index($request);

        $data = [
            'table' => $response->data,
        ];

        return view($this->view . 'index', $data);
    }

    public function create()
    {
        $description = [
            Transaction::DESCRIPTION_BAYAR_LISTRIK,
            Transaction::DESCRIPTION_BELI_PULSA,
            Transaction::DESCRIPTION_SETOR_TUNAI,
            Transaction::DESCRIPTION_TARIK_TUNAI,
        ];

        $types = [
            Transaction::DEBIT => 'Debit',
            Transaction::CREDIT => 'Credit'
        ];

        $nasabah = $this->nasabahService->index(new Request([]),false);
        $nasabah = $nasabah->data;

        $data = [
            'description' => $description,
            'types' => $types,
            'nasabah' => $nasabah
        ];

        return view($this->view . "create", $data);
    }

    public function show($id)
    {
        $result = $this->transactionService->show($id);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route($this->route . 'index')->withInput();
        }
        $result = $result->data;

        $data = [
            'result' => $result
        ];

        return view($this->view . "show", $data);
    }

    public function edit($id)
    {
        $result = $this->transactionService->show($id);
        if (!$result->success) {
            alert()->error('Gagal', $result->message);
            return redirect()->route($this->route . 'index')->withInput();
        }
        $result = $result->data;

        $description = [
            Transaction::DESCRIPTION_BAYAR_LISTRIK,
            Transaction::DESCRIPTION_BELI_PULSA,
            Transaction::DESCRIPTION_SETOR_TUNAI,
            Transaction::DESCRIPTION_TARIK_TUNAI,
        ];

        $types = [
            Transaction::DEBIT => 'Debit',
            Transaction::CREDIT => 'Credit'
        ];

        $nasabah = $this->nasabahService->index(new Request([]),false);
        $nasabah = $nasabah->data;

        $data = [
            'description' => $description,
            'types' => $types,
            'nasabah' => $nasabah,
            'result' => $result
        ];

        return view($this->view . "edit", $data);
    }

    public function store(StoreRequest $request)
    {
        try {
            $response = $this->transactionService->store($request);
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
            $response = $this->transactionService->update($request, $id);
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
            $response = $this->transactionService->delete($id);
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
