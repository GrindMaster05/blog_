<?php

namespace App\Models;
use App\Library\GeneralLibrary;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;



class Comment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Define the relationship: A comment belongs to a post.
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public static function _validateAndSaveComment(Request $request, $post_ID)
    {
      $toBeValidated = [
        'content' => 'required'
      ];
      $validator = Validator::make($request->all(), $toBeValidated);
  
      if ($validator->fails()) {
        foreach ($validator->errors()->toArray() as $field_key => $messages) {
          foreach ($messages as $message) {
            $form_errors[] = $message;
          }
        }
        return ['status' => false, 'message' => implode('; ', $form_errors)];
      }
  
      $validatedData =  $validator->validated();
  
      $comment = new self;
      $comment->uuid = Uuid::uuid4();
      $comment->user_id = auth()->user()->id;
      $comment->post_id = $post_ID;
      $comment->content = $validatedData['content'];
  
      $comment->save();
  
      return ['status' => true, 'comment' => $comment];
    }
}
