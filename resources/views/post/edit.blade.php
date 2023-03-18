@extends('layouts.app')


@section('title') Update @endsection

@section('content')
<form class="mt-5" action="{{route("posts.update", $post['id'])}}" method="post">
    @csrf
     @method("put") 
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" class="form-control" id="title" value="{{$post['title']}}">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <input class="form-control" name="description" id="description" value="{{$post['description']}}">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Post Creator</label>
        <select class="form-select" id="inputGroupSelect03" aria-label="Example select with button addon" value="{{$post['posted_by']}}">
            <option selected>Choose...</option>
            <option value="name1">habiba</option>
            <option value="name2">Ahmed</option>
            <option value="name3">Aya</option>
          </select>
      </div>

    <button type="submit" class="btn btn-primary">Update</button>
  </form>
@endsection