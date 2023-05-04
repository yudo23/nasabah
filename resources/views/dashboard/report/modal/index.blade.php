<div class="modal fade" id="modalFilter" tabindex="false" role="dialog" aria-labelledby="modalFilterLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFilterLabel">Filter Pencarian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="get" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nasabah <span class="text-danger"> *</span></label>
                        <select class="form-control select2" style="width: 100%;" name="nasabah_id">
                            <option value="">==Pilih Nasabah==</option>
                            @foreach($nasabah as $index => $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tanggal Mulai <span class="text-danger"> *</span></label>
                                <input type="date" class="form-control" name="start_date">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tanggal Berakhir <span class="text-danger"> *</span></label>
                                <input type="date" class="form-control" name="end_date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>