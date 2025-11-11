@extends('layouts.app')

@section('title', 'Summary')

@section('content')
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Summary</h1>
            <p class="page-subtitle">Task summary</p>
        </div>

        <!-- Main Content -->

        <div>
            <h2 class="page-title">Total number of todos - {{$todos->count()}}</h2>
            <br></br>
            <h2 class="page-title">Number of completed ( {{$completedTodosCount}} ) vs. pending todos ( {{$pendingTodosCount}} )</h2>
            <br></br>
            <h2 class="page-title">Completion percentage (as a progress bar or text)</h2>
            <br></br>
            <h2 class="page-title">List of todos due in the next 30 days</h2>
            <br></br>
            <h2 class="page-title">A button/link to access this page from the main todo list (for example in header or near "Create New Todo" button)</h2>
            <br></br>
        </div>

        <div>
            @if($todos->count() > 0)
                @foreach($todos as $todo)
                    @include('partials.todo-card', ['todo' => $todo])
                @endforeach
            @else
                <p>No todos yet!</p>
            @endif
        </div>
        
        

    @if ($errors->any())
        @push('scripts')
            <script>
                // Reopen modal if there are validation errors
                document.addEventListener('DOMContentLoaded', function () {
                    var modal = new bootstrap.Modal(document.getElementById('createTodoModal'));
                    modal.show();
                });
            </script>
        @endpush
    @endif
@endsection