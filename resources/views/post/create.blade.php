@extends('layouts.app')


@section('title') Create @endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="mt-5" action="{{route("posts.store")}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" class="form-control" id="title">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" name="description" id="description"></textarea>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Post Creator</label>
        <select name="post_creator" class="form-control">
          @foreach($users as $user)
              <option value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
      </select>
      </div>
      <div class="input-group mb-3">
        <input class="form-control form-control-lg" id="formFileLg" name="image" type="file">
      </div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
@endsection