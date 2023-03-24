@extends('layouts.app')


@section('title') Update @endsection

@section('content')
<form class="mt-5" action="{{route("posts.update", $post['id'])}}" method="post">
    @csrf
     @method("put") 
     <div class="mb-4">
      <label class="form-label">Title</label>
      <input type="text" class="form-control" value="{{$post['title']}}" name="title">
    </div>
    <div class="mb-4">
      <label class="form-label">Description</label>
      <div class="form-floating">
          <textarea name="description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{$post['description']}}</textarea>
          <label for="floatingTextarea2">Post</label>
      </div>
    </div>
    <div class="mb-3">
      <label for="exampleInputCreator" class="form-label fs-4">Post Creator<span class="text-danger">*</span></label>
      <select class="form-select" name="post_creator" aria-label="Default select example">
          <option value="{{ $post['user_id'] }}" selected hidden>
              @if($post->user)
                  {{$post->user->name}}
              @else
                  Unknown
              @endif
          </option>
          @foreach($users as $user)
              <option value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
      </select>
  </div>
  
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
@endsection