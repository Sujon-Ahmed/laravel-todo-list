@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-header text-light d-inline-block"><h3>{{ $total_task }} / <small style="font-size: 15px">{{ $complete_task }} Tasks Complete</small></h3></div>
                <div class="card-body">
                    <div class="add-task" data-bs-toggle="modal" data-bs-target="#exampleModal"></div>
                    <div class="icon-list">
                        <a href="" class="active"><i class="fa fa-list"></i> Task Lists</a>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"></li>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($tasks as $task)                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo{{$task->id}}" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        @if ($task->status == 1)                                            
                                            <span><i class="far fa-check-circle"></i> {{ $task->task_title }}</span>
                                        @else 
                                            <span><i class="far fa-circle"></i> {{ $task->task_title }}</span>
                                        @endif
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo{{$task->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>{{ $task->task_description }}</p>
                                        @if ($task->status == 1)                                            
                                        <a href="{{ url('/status/change',$task->id) }}" class="btn btn-warning btn-sm">Undone</a>
                                        <a href="{{ url('/task/delete', $task->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                        @else 
                                        <a href="{{ url('/status/change',$task->id) }}" class="btn btn-success btn-sm">Done</a>
                                        <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalDelete">Delete</a>
                                        @endif
                                    </div>                                
                                </div>
                            @endforeach
                        </div>

                        </div>
                    </ul>


                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal for add task-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('/task/create') }}" method="POST">
                @csrf
                <input type="text" name="task_title" class="form-control mb-3" placeholder="Enter Task Title">
                <div class="form-floating">
                    <textarea class="form-control" name="task_description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Write Task Description Here..</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!-- Modal for delete task-->
<div class="modal fade" id="exampleModalDelete" tabindex="-1" aria-labelledby="exampleModalLabelDelete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelDelete">Delete Conform Alert</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are You Sure Permanently Delete This Task ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <a href="{{ url('/task/delete', $task->id) }}" class="btn btn-danger btn-sm">Delete</a>
        </div>
      </div>
    </div>
  </div>
@endsection
