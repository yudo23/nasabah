@extends("dashboard.layouts.main")

@section("title","Transaction")

@section("css")
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Transaction</a></li>
                <li class="breadcrumb-item">Show</li>
                <li class="breadcrumb-item active">{{$result->id}}</li>
            </ol>
        </div>
        <h5 class="page-title">Transaction</h5>
    </div>
</div>
@endsection

@section("content")
<div class="row pb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Informasi Data</h5>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Nasabah</p>
                    <h6 class="">{{ $result->nasabah->name ?? null }}</h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Tanggal Transaksi</p>
                    <h6 class="">{{ date('d-m-Y H:i:s',strtotime($result->date)) }}<</h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Jenis Transaksi</p>
                    <h6 class="">{{ $result->debit_credit_status() ?? null }}</h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Deskripsi Transaksi</p>
                    <h6 class="">{{ $result->description }}</h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Jumlah</p>
                    <h6 class="">{{ number_format($result->amount,0,',','.') }}</h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Tanggal Dibuat</p>
                    <h6 class="">{{ date('d-m-Y H:i:s',strtotime($result->created_at)) }}</h6>
                </div>

                <div class="mt-3">
                    <p class="font-size-12 text-muted mb-1">Tanggal Diperbarui</p>
                    <h6 class="">{{ date('d-m-Y H:i:s',strtotime($result->updated_at)) }}</h6>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <a href="{{route('dashboard.transaction.index')}}" class="btn btn-warning btn-sm" style="margin-right: 10px;"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a href="{{route('dashboard.transaction.edit',$result->id)}}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-edit"></i> Edit</a>
                    <a href="#" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i> Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="frmDelete" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="id"/>
</form>
@endsection

@section("script")
<script>
    $(function(){

        $(document).on("click",".btn-delete",function(){
            if(confirm("Apakah anda yakin ingin menghapus data ini ?")){
                $("#frmDelete").attr("action", "{{ route('dashboard.transaction.destroy', '_id_') }}".replace("_id_", '{{$result->id}}'));
                $("#frmDelete").submit();
            }
        })
    })
</script>
@endsection