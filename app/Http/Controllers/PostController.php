<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Post;
use DB;
class PostController extends Controller
{      


    public function edit(Request $request, $uuid = NULL)
    {
      $data = [];
  
  
      if (!empty($uuid)) 
      {
        $post = Post::where('uuid', $uuid)->first();
  
        if (empty($post)) {
          return redirect()->back()->with('error', 'Invalid Post');
        }
        $data['post'] = $post;
      }
  
      if (!empty($request->input('title')))
       {
        $res = Post::_validateAndSavePost($request, !empty($post) ? $post : NULL);
        if (!empty($res['post'])) {
            return redirect('/home')->with('success', 'Post created succesfully');
        } else {
          return redirect()->back()->withInput()->with('error', !empty($res['message']) ? $res['message'] : 'Could not save post');
        }
      }
  
      return redirect('/home')->with('success', 'Post created succesfully');
    }
  

    // deleting apost by  using uuid
    public function delete_post($uuid)
        {
            if(!Auth()->user())
             {
                return redirect()->back()->with('error', ucfirst(__('body.unauthorized')));
              }
              $post = Post::where('uuid', $uuid)->first();
         
               if(empty($post ))
                 {
                     return redirect()->back()->with('error', ucfirst(__('body.var_not_found', ['item' => __('body.province')])));
                 }
                 $post->delete();
                 return redirect('/home')->with('success', ucfirst(__('body.var_deleted', ['item' => __('body.province')])));
        }
 

       // Viewing all posts
        public function view_all_posts() 
        {
        $all_posts=Post::all();
        return view('home')->with('all_posts',$all_posts);
        }  

        public function show_form(){

            return view('post.new_post');
        }


       // Viewing all posts  ON HOME

        public function view_all_posts_on_home() 
        {
        $all_posts=Post::all();
        return view('welcome')->with('all_posts',$all_posts);
        }  



                 // Edite Post Data Display
        public function edit_post_data_display($uuid)
        {
            if(!Auth()->user())
            {
                return redirect()->back()->with('error', ucfirst(__('body.unauthorized')));
            }
            $post = Post::where('uuid', $uuid)->first();
    
            if(empty($post ))
            {
                return redirect()->back()->with('error', ucfirst(__('body.var_not_found', ['item' => __('body.province')])));
            }
            $post = DB::select('select * from posts where uuid = ?',[$uuid]);
            return view('post.show_post_to_update')->with('post',$post);
        }

          
}
