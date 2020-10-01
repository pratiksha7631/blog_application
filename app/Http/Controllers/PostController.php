<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\models\post;
use App\models\category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function index()
    {
        $data['category']=category::pluck('name','id')->toArray();

        return view('masters/post',['data'=>$data]);
    }

    function blog_list(Request $request)
    {
        $category = $request->category;
        $post = post::leftjoin('categories','categories.id','posts.category_id')
                    ->leftjoin('users','users.id','posts.user_id')
                    ->select('posts.id as id', 'posts.title as title','categories.name as category_name','posts.user_id as user_id','posts.category_id as category_id')
                    ->where(function ($query) use ($category) {
                        if (!empty($category)) {
                            $query->orWhere('posts.category_id',$category);

                        }
                    });
                    // ->get();
        return Datatables::of($post)
            ->filter(function ($query) use ($request) {
                if ($request->has('category') && !empty($request->category)) {
                    $query->Where('posts.category_id',$request->category);
                }

            })
            ->addColumn('action', function ($post) {
                $edit = '';
                $delete = '';

                $view = ' <a href="' . route('view_post', ['id' => $post->id]) . '" class="apply_btn btn mb-1" ><i class="fa fa-eye text-primary" title="View"></i> </a>';
                if($id=Auth::user())
                {
                    if($id->id==$post->user_id)
                    {
                        $edit = '<a href="' . route('edit_post', ['id' => $post->id]) . '" class="apply_btn btn mb-1" ><i class="fa fa-pencil text-success" title="Edit"></i> </a>';

                        $delete = '<a href="javascript:void(0)" id="btnDelete" class="apply_btn btn mb-1" data-id="' . $post->id . '"> <i class="fa fa-trash text-danger" title="Delete"></i></a>';
                    }
                }

                return $view.$edit . $delete;
            })

            // ->rawColumns(['action'])
            ->toJson();
    }

    function add_blog()
    {
        $data['category']=category::pluck('name','id')->toArray();
        return view('masters/add_blog',['data'=>$data]);
    }

    function save_blog(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'title' => 'required',
            'blog_description' =>  'required',
        ]);
        $id=Auth::user()->id;
        $post = new post;
        $post->category_id = $request->category;
        $post->title = $request->title;
        $post->body = $request->blog_description;
        $post->user_id = $id;

        $post->save();
        $message = "Blog Added Successfully!";
        return redirect()->route('index')->with('success', $message);
    }

    function view_post(Request $request)
    {
        $id = $request->id;
        $data['view_post']=post::leftjoin('categories','categories.id','posts.category_id')
                                ->select('posts.id as id','posts.title as title','posts.body as body','categories.name as name')
                                ->where('posts.id',$id)
                                ->first();

        return view('masters/view_post',['data'=>$data]);
    }

    function edit_post(Request $request)
    {
        $id = $request->id;
        $data['view_post']=post::select('id','title','body','category_id')
                                ->where('id',$id)
                                ->first();
        $data['category']=category::pluck('name','id')->toArray();

        return view('masters/edit_post',['data'=>$data]);
    }

    function update_blog(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'title' => 'required',
            'blog_description' =>  'required',
        ]);

        $id=Auth::user()->id;
        $post =  post::find($request->post_id);
        $post->category_id = $request->category;
        $post->title = $request->title;
        $post->body = $request->blog_description;
        $post->user_id = $id;

        $post->save();
        $message = "Blog Updated Successfully!";
        return redirect()->route('index')->with('success', $message);
    }

    function delete_blog(Request $request)
    {
        $id = $request->id;
        $post = post::find($id);
        $post->delete();

        return  redirect()->back();
    }
}
