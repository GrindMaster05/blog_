<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    

    
    public function edit(Request $request, $post_id = NULL)
    {
  
      if (!empty($post_id)) {
        $post = Post::where('id', $post_id)->first();
        if (empty($post)) {
          return redirect()->back()->with('error', 'Invalid Post');
        }
      }
  
      if (!empty($request->input('content'))) {
        $res = Comment::_validateAndSaveComment($request, $post->id);
        if (!empty($res['comment'])) {
            return redirect('/')->with('success', 'Comment created succesfully');
        } else {
          return redirect()->back()->withInput()->with('error', !empty($res['message']) ? $res['message'] : 'Could not add the comment');
        }
      }
    }
}
