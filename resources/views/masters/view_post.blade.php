@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11" style="margin-top:10%">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center"><i>View Blog</i></h5>
                </div>
                <div class="card-body">
                    <div class="row offset-md-2">
                        <div class="col-md-2">Title :</div>
                        <div class="col-md-4"> <b>{{$data['view_post']->title}}</b></div>
                        <div class="col-md-2">Category :</div>
                        <div class="col-md-4"> <b>{{$data['view_post']->name}}</b></div>
                    </div>
                </div><hr>
                <div class="card-body">
                    <b>Body : </b>
                    {{$data['view_post']->body}}
                </div>
            </div>
        </div>
        <div class="offset-sm-5" style="margin-top:1%">
         <a href="{{route('index')}}" class="btn btn-info">Back</a>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush
