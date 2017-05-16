<?php
/**
 * Created by PhpStorm.
 * User: Thilan K Bandara
 * Date: 3/28/2017
 * Time: 12:03 PM
 */

namespace App\Http\Controllers;


use App\Book;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function getDeletePost($post_id){

        $post=Post::where('id',$post_id)->first();
//        if(Auth::user() !=$post->user){
//            return redirect()->back();
//        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message'=>'Successfully Deleted!']);
    }
    public function getHomePage(Request $request){
        $posts=Post::orderBy('created_at','desc')->get();
        return view('welcome',['posts'=>$posts]);
    }

    public function getDashboard(Request $request){
        $posts=Post::orderBy('created_at','desc')->get();
        $books=Book::orderBy('created_at','desc')->take(5)->get();



        $studentsTransacions = \App\Transaction::where('student_id', Auth::user()->admission_number)->get();


        return view('dashboard',['posts'=>$posts,'books'=>$books,'transactions'=>$studentsTransacions,]);
    }

    public function postCreatePost(Request $request){
        //validation
        $this->validate($request,[
            'body'=>'required|max:1000'
        ]);

        $post=new Post();
        $post->body=$request['body'];
        $message='there is an error';
        if( $request->user()->posts()->save($post)){
            $message='post successfully created';
        }
        return redirect()->route('dashboard')->with(['message'=>$message]);
    }

    public function postEditPost(Request $request){
        $this->validate($request,[
            'body'=>'required|max:1000'
        ]);
        $post=Post::find($request['postId']);
        if(Auth::user() !=$post->user){
            return redirect()->back();
        }
        $post->body=$request['body'];
        $post->update();
        return response()->json(['new_body'=>$post->body],200);

    }

}