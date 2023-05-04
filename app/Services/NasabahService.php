<?php

namespace App\Services;

use App\Services\BaseService;
use App\Http\Requests\Nasabah\StoreRequest;
use App\Http\Requests\Nasabah\UpdateRequest;
use App\Models\Nasabah;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;
use Throwable;

class NasabahService extends BaseService
{
    protected Nasabah $nasabah;

    public function __construct()
    {
        $this->nasabah = new Nasabah();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $search = $request->search;

        $table = $this->nasabah;
        if (!empty($search)) {
            $table = $this->nasabah->where(function ($query2) use ($search) {
                $query2->where('name', 'like', '%' . $search . '%');
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
        $result = $this->nasabah->where('id',$id)->firstOrFail();

        return $this->response(true, 'Berhasil mendapatkan data', $result);
    }

    public function store(StoreRequest $request)
    {
        try {
            $this->nasabah->create([
                'name' => $request->name,
            ]);

            return $this->response(true, 'Berhasil menambahkan data');
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $result = $this->nasabah->findOrFail($id);

            $result->update([
                'name' => $request->name,
            ]);

            return $this->response(true, 'Berhasil mengubah data');
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->nasabah->findOrFail($id);
            $result->delete();

            return $this->response(true, 'Berhasil menghapus data');
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }
}
