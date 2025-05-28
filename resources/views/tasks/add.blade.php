@extends("layouts.default")

@section("style")
<style>
body.dark-mode input[type="text"],
body.dark-mode input[type="datetime-local"],
body.dark-mode textarea {
    background-color: #333 !important;
    color: #fff !important;
    border: 1px solid #555 !important;
}

body.dark-mode input[type="text"]::placeholder,
body.dark-mode textarea::placeholder {
    color: #bbb !important;
}
</style>
@endsection

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

                <button class="btn btn-success" type="submit">Submit</button>
                <a href="{{ route(name: 'home') }}" class="btn text-white"
                    style="background-color: #1380d4; transition: background-color 0.3s;"
                    onmouseover="this.style.backgroundColor='#0f6bac'"
                    onmouseout="this.style.backgroundColor='#1380d4'">Back</a>
            </form>
        </div>
    </div>
@endsection

@section("script")
<script>
    if (document.getElementById('dark-mode-toggle')) {
        document.getElementById('dark-mode-toggle').addEventListener('click', function () {
            const isDark = document.body.classList.toggle('dark-mode');
            fetch('/dark-mode', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ dark_mode: isDark })
            });
        });
    }

    window.onload = function () {
        fetch('/dark-mode-status')
            .then(res => res.json())
            .then(data => {
                if (data.dark_mode) {
                    document.body.classList.add('dark-mode');
                }
            });
    }
</script>
@endsection
