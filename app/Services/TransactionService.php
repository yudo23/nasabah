<?php

namespace App\Services;

use App\Services\BaseService;
use App\Http\Requests\Transaction\StoreRequest;
use App\Http\Requests\Transaction\UpdateRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;
use Throwable;

class TransactionService extends BaseService
{
    protected Transaction $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $search = $request->search;

        $table = $this->transaction;
        if (!empty($search)) {
            $table = $this->transaction->where(function ($query2) use ($search) {
                $query2->whereHas('nasabah', function($query3) use($search){
                    $query3->where("name","like","%".$search."%");
                });
                $query2->orWhere("date","like","%".$search."%");
                $query2->orWhere("debit_credit_status","like","%".$search."%");
                $query2->orWhere("description","like","%".$search."%");
            });
        }
        $table = $table->orderBy('created_at', 'DESC');

        if ($paginate) {
            $table = $table->paginate(10);
            $table = $table->withQueryString();
        } else {
            $table = $table->get();
        }

        return $this->response(true, 'Berhasil mendapatkan data', $table);
    }

    public function show($id)
    {
        $result = $this->transaction->where('id',$id)->firstOrFail();

        return $this->response(true, 'Berhasil mendapatkan data', $result);
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $nasabah_id = $request->nasabah_id;
            $date = $request->date;
            $debit_credit_status = $request->debit_credit_status;
            $description = $request->description;
            $amount = $request->amount;

            $this->transaction->create([
                'nasabah_id' => $nasabah_id,
                'date' => $date,
                'debit_credit_status' => $debit_credit_status,
                'description' => $description,
                'amount' => $amount,
            ]);

            DB::commit();

            return $this->response(true, 'Berhasil menambahkan data');
        } catch (Throwable $th) {
            DB::rollback();
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $nasabah_id = $request->nasabah_id;
            $date = $request->date;
            $debit_credit_status = $request->debit_credit_status;
            $description = $request->description;
            $amount = $request->amount;
            
            $result = $this->transaction->findOrFail($id);

            $result->update([
                'nasabah_id' => $nasabah_id,
                'date' => $date,
                'debit_credit_status' => $debit_credit_status,
                'description' => $description,
                'amount' => $amount,
            ]);

            DB::commit();

            return $this->response(true, 'Berhasil mengubah data');
        } catch (Throwable $th) {
            DB::rollback();
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->transaction->findOrFail($id);
            $result->delete();

            return $this->response(true, 'Berhasil menghapus data');
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }
}
