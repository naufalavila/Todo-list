@extends("layouts.default")

@section("content")
    <div class="d-flex align-items-center">
        <div class="container card shadow-sm" style="max-width: 500px; margin-top: 100px;">
            <div class="fs-3 fw-bold text-center">Edit To-do List</div>
            <form method="POST" action="{{ route('task.update', ['id' => $task->id]) }}" class="p-3">
                @csrf
                <div class="mb-3">
                    <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
                </div>
                <div class="mb-3">
                    <input type="datetime-local" name="deadline" class="form-control" value="{{ $task->deadline }}">
                </div>
                <div class="mb-3">
                    <textarea name="description" class="form-control" rows="3" required>{{ $task->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('home') }}" class="btn text-white"
                    style="background-color: #1380d4; transition: background-color 0.3s;"
                    onmouseover="this.style.backgroundColor='#0f6bac'"
                    onmouseout="this.style.backgroundColor='#1380d4'">Back</a>
            </form>
        </div>
    </div>
@endsection