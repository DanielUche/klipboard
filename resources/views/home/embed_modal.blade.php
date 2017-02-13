@extends('layouts.app')
@section("content")

<div class="col-md-6 col-md-offset-3">
<form name = "uploadForm" method="post" action="{{URL::to('upload-attandance')}}" enctype="multipart/form-data" novalidate>
{{ csrf_field() }}
<div class="inmodal">
    <div class="modal-header">
        <i class="fa fa-film modal-icon"></i>
        <h4 class="modal-upload"></h4>
        <small class="font-bold">Attendane Bulk Upload</small>
    </div>
    <div class="modal-body">
        <p><strong></strong> </p>
        

            <div class="form-group">
                <label>Choose Attendance File</label> 
                <input type="file" class = "form-control"  ng-model = "upload.upload" name ="attend" required/>
            </div>

        
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Upload Selected File</button>
    </div>
</div>
</form>
</div>


@endsection