@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<section class="container p-5">
    <div class="card mb-3">
            <div class="card-header">
                Post Info
            </div>
            <div class="card-body">
                <h5 class="card-title fs-4">Title: {{$post->title}}</h5>
                <span class="card-title fs-4">Description: </span><span class="fs-5">{{$post->description}}</span></br>
                  @if ($post->image)
                <h4>Image: </h4>
                <img src="{{Storage::url($post->image)}}"  alt="{{$post->image}}" class="img-fluid rounded mx-auto">
                @endif
            </div>
    </div>

    <div class="card mb-3">
            <div class="card-header">
                Post Creator Info
            </div>
            <div class="card-body">
                <h5 class="card-title fs-4">Name: {{$post->user->name}}</h5>
                <span class="card-title fs-4">Email: </span><span class="fs-5">{{$post->user->email}}</span></br>
              <span class="card-title fs-4">Created_At: </span><span class="fs-5">{{$post->created_at->format('l jS \\of F Y h:i:s A')}}</span>
            </div>
    </div>
<div class="accordion " id="accordionExample gap-2">
        <div class="accordion-item bg-transparent">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h3 class="text-black">Comments</h3>
                </button>
            </h2>
    <div id="collapseOne" class="accordion-collapse collapse hidden" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body mb-3">
            @foreach($comments as $comment)
                <div class="card w-30">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                        <p class="card-text fs-3">{{$comment->comment}}</p>
                        <span class="card-text fs-5">{{$comment->created_at}}</span>
                        </div>
                        <div>
                        <form action="{{route('comments.destroy', $comment->id)}}" method="post">
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
                                <h1 class="modal-title fs-3 text-danger" id="exampleModalLabel">Confirm Delete</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5> Are you sure, you want to delete this comment? </h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>
                    </div>
                    
                </div><br>
            @endforeach
        </div>
    </div>
</div>
    <form class="p-3" action="{{route('comments.store', $post->id)}}" method="post">
   @csrf
  <div class="mb-4">
    <label class="form-label fs-4">Comment</label>
    <div class="form-floating">
        <textarea class="form-control" name="comment" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Comment...</label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">ADD</button>
</form>

</section>

@endsection