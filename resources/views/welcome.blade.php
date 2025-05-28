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

        body {
    transition: background-color 0.3s, color 0.3s;
}

       body.dark-mode {
        background-color: #121212;
        color: #f0f0f0;
    }

    body.dark-mode .bg-body {
        background-color: #1e1e1e !important;
    }

    body.dark-mode .text-gray-dark {
        color: #e0e0e0 !important;
    }

    body.dark-mode .btn-dark {
        background-color: #333;
        border-color: #333;
    }

    body.dark-mode .card,
    body.dark-mode .alert {
        background-color: #1e1e1e;
        color: #f0f0f0;
        border-color: #333;
    }

    body.dark-mode .navbar {
        background-color: #1e1e1e !important;
    }

    body.dark-mode .btn-outline-success {
        color: #0f0;
        border-color: #0f0;
    }

    body.dark-mode .btn-outline-light {
        color: #ccc;
        border-color: #ccc;
    }

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
<div class="container d-flex justify-content-end mt-3">
    <button id="dark-mode-toggle" class="btn btn-dark">Toggle Dark Mode</button>
</div>

    <main class="flex-shrink-0 mt-5">
        <div class="container" style="max-width: 800px">
            @if (session()->has("success"))
                <div class="alert alert-success">
                    {{ session()->get("success") }}
                </div>
            @endif
            @if (session("error"))
                <div class="alert alert-danger">
                    {{ session("error") }}
                </div>
            @endif

            <!-- Uncompleted Tasks Section -->
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0">Uncompleted</h6>
                @foreach ($uncompletedTasks as $task)
                    <div class="d-flex text-body-secondary pt-3">
                        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="text-gray-dark flex-grow-1">{{ $task->title }} | {{ $task->deadline }}</strong>
                                <div class="task-buttons">
                                    <a href="{{ route('task.status.update', ['id' => $task->id]) }}" class="btn btn-success">
                                        Done
                                    </a>
                                    <a href="{{ route('task.delete', ['id' => $task->id]) }}" class="btn btn-danger">
                                        Delete
                                    </a>
                                    <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-warning text-white">
                                        Edit
                                    </a>
                                </div>
                            </div>
                            <span class="d-block">{{ $task->description }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Completed Tasks Section -->
            <div class="my-3 p-3 bg-body rounded shadow-sm mt-4">
                <h6 class="border-bottom pb-2 mb-0">Done</h6>
                @foreach ($completedTasks as $task)
                    <div class="d-flex text-body-secondary pt-3">
                        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong class="text-gray-dark flex-grow-1">
                                    {{ $task->title }} | {{ $task->deadline }} | Completed
                                </strong>
                                <div class="task-buttons">
                                    <a href="{{ route('task.delete', ['id' => $task->id]) }}" class="btn btn-danger">
                                        Delete
                                    </a>
                                </div>
                            </div>
                            <span class="d-block">{{ $task->description }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection

@section("script")
<script>
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
