@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 add_blog_page">
            <div class="card">
                <div class="card-header">
                    <h5>Add Blog</h5>
                </div>
                <div class="card-body">
                    <div class="row product-adding">
                        <div class="col-xl-12">
                        <form action="{{route('save_blog')}}" method="post" class="needs-validation add-product-form">
                               @csrf
                                    <div class="form-group mb-3 row">
                                        <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">Category
                                                <span class="text-danger"
                                                title="This field is required">*</span>
                                        </label>
                                        <div class="col-xl-8 col-sm-7">
                                            {{ Form::select('category',array(''=>'Select category')+$data['category'],null,
                                                                array(
                                                                'class' => 'form-control',
                                                                'id'=>'category',
                                                                )
                                                                    )
                                            }}
                                                @if ($errors->has('category'))
                                                <div class="text-danger">
                                                            {{ $errors->first('category') }}
                                                </div>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Title<span class="text-danger"
                                                        title="This field is required">*</span></label>
                                        <div class="col-xl-8 col-sm-7">
                                        <input class="form-control " id="title" name="title" type="text" placeholder="Enter Title">
                                            @if ($errors->has('title'))
                                            <div class="text-danger">
                                                        {{ $errors->first('title') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 row">
                                        <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">Body
                                                <span class="text-danger"
                                                title="This field is required">*</span>
                                         </label>
                                         <div class="col-xl-8 col-sm-7">
                                            <textarea class="form-control" id="blog_description" name="blog_description" rows="2" cols="98"></textarea>
                                                @if ($errors->has('blog_description'))
                                                    <div class="text-danger">
                                                                {{ $errors->first('blog_description') }}
                                                    </div>
                                                @endif
                                        </div>
                                    </div>

                                <div class="offset-xl-3 offset-sm-4">
                                    <button  class="btn btn-primary">Save</button>
                                <a href="{{route('index')}}" class="btn btn-light">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush
