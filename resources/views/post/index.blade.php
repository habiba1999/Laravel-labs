@extends('layouts.app')


@section('title') Index @endsection

@section('content')
<div class="create my-4 text-center">
    <a href="{{route("posts.create")}}" class="btn btn-success">Create Post</a>
</div>

    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                @if ($post->user)
                    <td>{{$post->user->name}}</td>
                @else
                    <td>Not Found</td>
                @endif
                <td>{{$post->created_at->format('Y-m-d')}}</td>
                <td class="d-flex gap-3">
                    <a href="{{route('posts.show', $post->id)}}" class="btn btn-info">View</a>
                    <a href="{{route('posts.edit',  $post->id)}}" class="btn btn-primary">Edit</a>
                    {{-- <a href="#" class="btn btn-danger">Delete</a> --}}
                    <form action="{{route('posts.destroy', $post->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                            <!-- <button type="submit" class="btn btn-danger" onclick="return myFunction()"> Delete </button> -->
                            <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete-modal{{$post->id}}">
                        Delete
                        </button>

                        <!--Delete  Modal -->
                        <div class="modal fade" id="confirm-delete-modal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title fs-3 text-danger" id="exampleModalLabel">Confirm Delete</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5> Are you sure, you want to delete this post? </h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row col-12 text-center d-flex flex-row justify-content-center my-4">
        <div class="row w-auto">
            {{ $posts->links('pagination::bootstrap-4')}}</div>
    </div>
    
    <script src=" https://code.jquery.com/jquery-3.6.0.min.js">
    </script>

@endsection
