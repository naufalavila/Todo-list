@extends("layouts.default")
@section("style")
    <style>
        .task-buttons {
            display: flex;
            gap: 10px;
        }

        .task-buttons a {
            white-space: nowrap;
        }

        .d-flex.justify-content-between.align-items-center {
            display: flex;
            align-items: center;
        }

        .flex-grow-1 {
            flex-grow: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
@endsection
@section("content")
    <main class="flex-shrink-0 mt-5">
        <div class="container" style="max-width: 800px">
            @if (session()->has("success"))
                <div class="alert alert-success">
                    {{session()->get("success")}}
                </div>
            @endif
            @if (session("error"))
                <div class="alert alert-danger">
                    {{session("error")}}
                </div>
            @endif

            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0">To-do Lists</h6>
                @foreach ($tasks as $task)
                    <div class="d-flex text-body-secondary pt-3">
                        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="text-gray-dark flex-grow-1">{{$task->title}} | {{$task->deadline}}</strong>
                                <div class="task-buttons">
                                    <a href="{{ route('task.status.update', ['id' => $task->id]) }}" class="btn btn-success">
                                        Done
                                    </a>
                                    <a href="{{ route('task.delete', ['id' => $task->id]) }}" class="btn btn-danger">
                                        Delete
                                    </a>
                                </div>
                            </div>
                            <span class="d-block">{{$task->description}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection