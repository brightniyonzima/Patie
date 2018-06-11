@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><label class="btn-danger">&nbsp;&nbsp;&nbsp;Select a location where you would like to do your screening from to see nearby hospitals&nbsp;&nbsp;&nbsp;</label></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-6 control-label">From where would you like to do screening? </label>

                            <div class="col-md-4">
                                {{ Form::select('location',$districts,'',['class' => 'form-control','id' => 'location']) }}

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                   

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-6">
                                <button type="submit" class="btn btn-primary" id="view_hospitals">
                                    View Hospitals
                                </button>
                            </div>
                        </div>
                    </form> 

                    <!-- display the hspitals in that selected district -->
                    <div style="display: none;" id="hospital_results">
                        <label class="btn-success"> &nbsp;&nbsp;Hospitals in selected district &nbsp;&nbsp;&nbsp;</label>
                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">
                            Test Hospital &nbsp;&nbsp;&nbsp;
                            {{ Form::checkbox('test_hospital','',['class' => 'form-control','checked'=>'false']) }}
                            </label>

                            <!-- <div class="col-md-4">
                                {{ Form::checkbox('test_hospital','',['class' => 'form-control']) }}
                            </div> -->
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
/*jQuery(document).ready(function(e) {
    console.log('loadded');
    $('#view_hospitals').on("click", function () {
        e.preventDefault();
        alert('clicked');
    });
});*/
function show_hospitals() {
    var chosenDistrict = document.getElementById('location').value;
    alert('you have chosen ' + chosenDistrict + ' district');
}
</script>
@endpush
