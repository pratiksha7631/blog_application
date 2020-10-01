@extends('layouts.app')

@section('content')


    @if (Route::has('login'))
    <div class="login_section">
        @auth
            {{-- <a href="{{ url('/home') }}">Home</a> --}}
        @else
            <a href="{{ route('login') }}" >Login</a>
            <span class="login_reg_space"></span>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
@endif
@if(Auth::User())
<ul class="navbar-nav ml-auto">
<li class="nav-item dropdown logout_section">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }}
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>
</ul>
    <div class="btn-popup add_blog_btn">
    <a type="button" class="btn btn-info" href="{{route('add_blog')}}">Add Blog</a>
    </div>
@endif
<form id="search-form" name="search-form" >
        @csrf
    <div class="row offset-8">
        <div class="col-sm-7">
            {{ Form::select('category',array(''=>'Select category')+ $data['category'],null,
                array(
                'class' => 'form-control chosen-select ',
                'id'=>'category'
                        )
                )
            }}
        </div>
        <div class="col-sm-2 pl-lg-0">
                <input type="submit" class="btn btn-primary width-100" id="search-btn" name="search" value="Search">
        </div>
    </div>
</form>
<div class="container main_table">
    <h2 class="text-center"><i>BLOGS</i></h2>
    <table class="table table-bordered data-table" id="blogs">
        <thead>
            <tr>
                <th>Id</th>
                <th>Category</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@endsection
@push('scripts')

<script type="text/javascript">
   var oTable = $('#blogs').DataTable({
        processing: true,
        serverSide: true,
        paging:true,
        order: [[0,'desc']],
        pageLength: 100,
        oLanguage: {
            sProcessing: '<div class="spinnerpart"></div>',
        },
        ajax: {
            url: "{!! route('blog_list') !!}",
            data: function (d) {
                d.category = $('#category').val();
            }
        },
        columns: [
            { data: 'id', name: 'id',searchable: false, visible: false},
            { data: 'category_name', name: 'category_name' },
            { data: 'title', name: 'title' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#search-form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });

    $(document).on('click', '#btnDelete', function () {
        var id = $(this).attr("data-id");

        delete_post(id);
    });

    function delete_post(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
               post_delete_confirm(id);
                Swal.fire(
                'Deleted!',
                'Post has been deleted.',
                'success'
                )

                oTable.draw();
            }
            })
    }

    function post_delete_confirm(id){
        var id = id;
        $.ajax({
                url: "{!! route('delete_blog') !!}",
                type:'POST',
                async:true,
                data: {"_token": "{{ csrf_token() }}",
                    'id':id
                },
            })
            .done(function( data ) {
        });
    }


</script>


@endpush
