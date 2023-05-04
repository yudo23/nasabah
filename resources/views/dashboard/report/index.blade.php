@extends("dashboard.layouts.main")

@section("title","Report")

@section("css")
@endsection

@section("breadcumb")
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Report</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>
        </div>
        <h5 class="page-title">Report</h5>
    </div>
</div>
@endsection

@section("content")
<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <a href="#" class="btn btn-success btn-filter"><i class="fa fa-filter"></i> Filter</a>
                        <a href="{{route('dashboard.report.index')}}" class="btn btn-warning"><i class="fa fa-refresh"></i> Refresh</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        @if(!empty(request()->get("nasabah_id")) && !empty(request()->get("start_date")) && !empty(request()->get("end_date")))
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Nasabah</td>
                                                <td>{{$table->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Start Date</td>
                                                <td>{{date('d-m-Y',strtotime(request()->start_date))}}</td>
                                            </tr>
                                            <tr>
                                                <td>End Date</td>
                                                <td>{{date('d-m-Y',strtotime(request()->end_date))}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Deskripsi</th>
                                    <th>Credit</th>
                                    <th>Debit</th>
                                    <th>Jumlah</th>
                                </thead>
                                <tbody>
                                    @if(!empty(request()->get("nasabah_id")) && !empty(request()->get("start_date")) && !empty(request()->get("end_date")))
                                        @forelse ($table->transaction as $index => $row)
                                        <tr>
                                            <td>{{$table->transaction->firstItem() + $index}}</td>
                                            <td>{{date('d-m-Y H:i:s',strtotime($row->date))}}</td>
                                            <td>{{$row->description}}</td>
                                            <td>
                                                @if($row->debit_credit_status == \App\Models\Transaction::CREDIT)
                                                {{number_format($row->amount,0,',','.')}}
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>
                                                @if($row->debit_credit_status == \App\Models\Transaction::DEBIT)
                                                {{number_format($row->amount,0,',','.')}}
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>{{number_format($row->amount,0,',','.')}}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                        @endforelse
                                    @else
                                    <tr>
                                        <td colspan="10" class="text-center">Silahkan gunakan tombol untuk menampilkan data</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if(!empty(request()->get("nasabah_id")) && !empty(request()->get("start_date")) && !empty(request()->get("end_date")))
                            {!!$table->transaction->links()!!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("dashboard.report.modal.index")

@endsection

@section("script")
<script>
    $(function() {
        $(document).on("click", ".btn-filter", function(e) {
            e.preventDefault();

            $("#modalFilter").modal("show");
        });
    })
</script>
@endsection