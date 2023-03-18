@extends('layouts.app')


@section('title') Create @endsection

@section('content')
<form class="mt-5" action="{{route("posts.store")}}" method="post">
    @csrf
    @method("post")
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
        <select class="form-select" id="inputGroupSelect03" aria-label="Example select with button addon">
            <option selected>Choose...</option>
            <option value="name1">habiba</option>
            <option value="name2">Ahmed</option>
            <option value="name3">Aya</option>
          </select>
      </div>

    <button type="submit" class="btn btn-primary">Create</button>
  </form>
@endsection