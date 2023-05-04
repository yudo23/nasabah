@extends("dashboard.layouts.main")

@section("title","Transaction")

@section("css")
<!-- Datetime picker -->
<link rel="stylesheet" href="{{URL::to('/')}}/templates/dashboard/assets/plugins/datetimepicker/jquery.datetimepicker.css">
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Transaction</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>
        <h5 class="page-title">Transaction</h5>
    </div>
</div>
@endsection

@section("content")
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <form action="{{route('dashboard.transaction.store')}}" method="post" autocomplete="off" onsubmit="return confirm('Apakah anda yakin ingin mengirim data ini?')" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Nasabah <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <select class="form-control select2" name="nasabah_id" style="width: 100%;">
                                        <option value="">==Pilih Nasabah==</option
                                        >
                                        @foreach($nasabah as $index => $row)
                                        <option value="{{$row->id}}" @if(old('nasabah_id') == $row->id) selected @endif>{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Tanggal Transaksi <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control datetimepicker" name="date" placeholder="Tanggal Transaksi" value="{{old('date')}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Jenis Transaksi <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <select class="form-control select2" name="debit_credit_status" style="width: 100%;" required>
                                        <option value="">==Pilih Jenis Transaksi==</option
                                        >
                                        @foreach($types as $index => $row)
                                        <option value="{{$index}}" @if(old('debit_credit_status') == $index) selected @endif>{{$row}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Deskripsi Transaksi <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <select class="form-control select2" name="description" style="width: 100%;" required>
                                        <option value="">==Pilih Deskripsi Transaksi==</option
                                        >
                                        @foreach($description as $index => $row)
                                        <option value="{{$row}}" @if(old('description') == $row) selected @endif>{{$row}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Jumlah <span class="text-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{old('amount')}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{route('dashboard.transaction.index')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("script")
<!-- Datetimepicker -->
<script src="{{URL::to('/')}}/templates/dashboard/assets/plugins/moment/moment.min.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/plugins/datetimepicker/jquery.datetimepicker.min.js"></script>
<script src="{{URL::to('/')}}/templates/dashboard/assets/plugins/axios/axios.min.jss"></script>
<script>
    $(function(){

        $.datetimepicker.setDateFormatter('moment');
        $.datetimepicker.setLocale('id');
        
        $('.datetimepicker').datetimepicker({
              format:'YYYY-MM-DD HH:mm:ss',
              formatTime:'HH:mm:ss',
              formatDate:'YYYY-MM-DD'
        });
    })
</script>
@endsection