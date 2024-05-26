

                     
@extends('layouts.app') 

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <a href="{{ url('/show_form') }}" >      
             <button type="button" class="btn btn-primary">New</button>   
        </a>

        <div class="card">
   <br><br>
              <div class="card-body">


    <h1>Posts</h1>
    
    <table class="table" border="1">
        <thead>
            <tr><th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Published At</th>
                <th colspan="3"><center>Actions</center></th>
            </tr>
        </thead>


<?php 
$all_posts
?>
        @foreach ( $all_posts as $users)

{{ $users->name }}

@endforeach


        <tbody>
            @foreach($all_posts as $posts)
                <tr><td>{{ $posts->id }}</td>
                    <td>{{ $posts->title }}</td>
                    <td>{{ $posts->content }}</td>
                    <td>{{ $posts->published_at }}</td>

                    <td><a href = 'edit_post_data_display/{{ $posts->uuid }}' style="color: white"> <button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i>update</button> </a></td>
                    <td> <a href = 'delete_post/{{ $posts->uuid }}'><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button> </a></td>
                    <td><a href = '#' style="color: white"> <button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i>Publish</button> </a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
            </div>
        </div>
    </div>
</div>
@endsection

