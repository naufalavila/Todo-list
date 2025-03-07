@extends("layouts.default")

@section("content")
    <div class="d-flex align-items-center">
        <div class="container card shadow-sm" style="max-width: 500px; margin-top: 100px;">
            <div class="fs-3 fw-bold text-center">Add To-do List</div>
            <form method="POST" action="{{route("task.add.post")}}" class="p-3">
                @csrf
                <div class="mb-3">
                    <input type="text" name="title" class="form-control" placeholder="To-do Title">
                </div>
                <div class="mb-3">
                    <input type="datetime-local" name="deadline">
                </div>
                <div class="mb-3">
                    <textarea name="description" class="form-control" rows="3" placeholder="Description..."></textarea>
                </div>

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

                <button class="btn btn-success" type="submit">submit</button>
                <a href="{{ route(name: 'home') }}" class="btn text-white"
                    style="background-color: #1380d4; transition: background-color 0.3s;"
                    onmouseover="this.style.backgroundColor='#0f6bac'"
                    onmouseout="this.style.backgroundColor='#1380d4'">Back</a>
            </form>
        </div>
    </div>
@endsection