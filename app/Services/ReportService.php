<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Nasabah;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests\Report\ReportRequest;
use Auth;
use DB;
use Log;
use Throwable;

class ReportService extends BaseService
{
    protected Nasabah $nasabah;
    protected Transaction $transaction;

    public function __construct()
    {
        $this->nasabah = new Nasabah();
        $this->transaction = new Transaction();
    }

    public function index(ReportRequest $request, bool $paginate = true)
    {
        $nasabah_id = $request->nasabah_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $result = $this->nasabah->where("id",$nasabah_id)->firstOrFail();

        $table = $this->transaction;
        if (!empty($nasabah_id)) {
            $table = $table->where("nasabah_id",$nasabah_id);
        }
        if (!empty($start_date)) {
            $table = $table->whereDate("date",">=",$start_date);
        }
        if (!empty($end_date)) {
            $table = $table->whereDate("date","<=",$end_date);
        }
        $table = $table->orderBy('created_at', 'DESC');

        if ($paginate) {
            $table = $table->paginate(10);
            $table = $table->withQueryString();
        } else {
            $table = $table->get();
        }

        $result->transaction = $table;

        return $this->response(true, 'Berhasil mendapatkan data', $result);
    }
}
