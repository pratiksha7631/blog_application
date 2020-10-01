@if ($message = Session::get('success'))
<div class="alert btn-success alert-block col-sm-6">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert btn-danger alert-block col-sm-6">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert btn-warning alert-block col-sm-6">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert btn-info alert-block col-sm-6">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert btn-danger col-sm-6">
	<button type="button" class="close" data-dismiss="alert">×</button>
	Please check the form below for errors
</div>
@endif
