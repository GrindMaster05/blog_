@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @foreach($post as $posts)  
                <div class="card-body">
                
                    <h1>Update The Post</h1>
                    <form method="POST" action="{{ url('/edit_post_save', ['uuid' => $posts->uuid]) }}">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" id="uuid" value="{{ $posts->uuid }}" name="uuid">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" value="{{ $posts->title }}" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" required>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea id="content" name="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" rows="9" required>{{ $posts->content }}</textarea>
                            @if ($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="published_at">Published At (Optional)</label>
                            <input id="published_at" type="datetime-local" value="{{ $posts->published_at }}" name="published_at" class="form-control{{ $errors->has('published_at') ? ' is-invalid' : '' }}">
                            @if ($errors->has('published_at'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('published_at') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                 @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
