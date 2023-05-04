<?php

namespace App\Services;

use App\Services\BaseService;
use App\Models\Nasabah;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Helpers\CollectionHelper;
use Auth;
use DB;
use Log;
use Throwable;

class PointService extends BaseService
{
    protected Nasabah $nasabah;

    public function __construct()
    {
        $this->nasabah = new Nasabah();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $table = $this->nasabah;
        $table = $table->orderBy('created_at', 'DESC');

        if ($paginate) {
            $table = $table->paginate(10);
            $table = $table->withQueryString();
        } else {
            $table = $table->get();
        }

        $collection = new Collection();
        foreach($table as $index => $row){
            $point = 0;

            foreach($row->transaction as $i => $v){
                if($v->description == Transaction::DESCRIPTION_BELI_PULSA){
                    if($v->amount >= 0 && $v->amount <= 10000){
                        $point = 0;
                    }
                    else if($v->amount >= 10001 && $v->amount <= 30000){
                        for ($j=1; $j <= $v->amount; $j++) { 
                            if($j%1000 == 0){
                                $point +=1;
                            }
                        }
                    }
                    else if($v->amount >= 30001){
                        for ($j=1; $j <= $v->amount; $j++) { 
                            if($j%2000 == 0){
                                $point +=1;
                            }
                        }
                    }
                }
                else if($v->description == Transaction::DESCRIPTION_BAYAR_LISTRIK){
                    if($v->amount >= 0 && $v->amount <= 50000){
                        $point = 0;
                    }
                    else if($v->amount >= 50001 && $v->amount <= 100000){
                        for ($j=1; $j <= $v->amount; $j++) { 
                            if($j%2000 == 0){
                                $point +=1;
                            }
                        }
                    }
                    else if($v->amount >= 100001){
                        for ($j=1; $j <= $v->amount; $j++) { 
                            if($j%2000 == 0){
                                $point +=2;
                            }
                        }
                    }
                }
            }
            $collection->push([
                'nasabah_id' => $row->id,
                'name' => $row->name ?? null,
                'point' => $point
            ]);
        }

        if($paginate){
            $collection = CollectionHelper::paginate($collection, 10);
        }

        return $this->response(true, 'Berhasil mendapatkan data', $collection);
    }
}
