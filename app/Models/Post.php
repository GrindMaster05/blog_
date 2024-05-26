<?php

namespace App\Models;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

  
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function _validateAndSavePost(Request $request, $post = null)
    {
      $toBeValidated = [
        'title' => 'required|min:5|max:100',
        'content' => 'required|min:10',
        'published_at' => 'nullable'
      ];
      $validator = Validator::make($request->all(), $toBeValidated);
  
      if ($validator->fails()) {
        foreach ($validator->errors()->toArray() as $field_key => $messages) {
          foreach ($messages as $message) 
          {
            $form_errors[] = $message;
          }
        }
        return ['status' => false, 'message' => implode('; ', $form_errors)];
      }
  
      $validatedData =  $validator->validated();
      if (empty($post)) {
        $post = new self;
        $post->uuid = Uuid::uuid4();
        $post->user_id = auth()->user()->id;
      }

  
      $post->title = $validatedData['title'];
      $post->content = $validatedData['content'];
      $post->published_at = !empty($validatedData['published_at']) ? $validatedData['published_at'] : NULL;
  
      $post->save();
  
      return ['status' => true, 'post' => $post];
    }




}
