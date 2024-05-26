

                     
@extends('layouts.app') 

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
   <br><br>
              <div class="card-body">


    <h1>Create New Post</h1>
    <form method="POST" action="{{ url('/save_post') }}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" required>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div><br>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea id="content" name="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" rows="9" required>{{ old('content') }}</textarea>

                            @if ($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div><br>
                       

                        <div class="form-group">
                            <label for="published_at">Published At (Optional)</label>
                            <input id="published_at" type="datetime-local" name="published_at" class="form-control{{ $errors->has('published_at') ? ' is-invalid' : '' }}" value="{{ old('published_at') }}">

                            @if ($errors->has('published_at'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('published_at') }}</strong>
                                </span>
                            @endif
                        </div><br>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
    

    </div>
            </div>
        </div>
    </div>
</div>
@endsection

