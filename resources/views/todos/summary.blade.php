@extends('layouts.app')

@section('title', 'Summary')

@section('content')
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Summary</h1>
            <p class="page-subtitle">Todo statistics</p>
        </div>

        <!-- Main Content -->

        <div class="card shadow mb-4">
            <div class="card-body">

                <h2 class="card-title mb-4">Todo Summary</h2>

                <!-- Statistics -->

                <div class="row text-center mb-4">
                    <div class="col-md-4">
                        <h3 class="text primary">{{$totalTodosCount}}</h3>
                        <p class="text-muted">Total Todos</p>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text success">{{$completedTodosCount}}</h3>
                        <p class="text-muted">Completed Todos</p>                            
                    </div>
                    <div class="col-md-4">
                        <h3 class="text warning">{{$pendingTodosCount}}</h3>
                        <p class="text-muted">Pending Todos</p>
                    </div>
                </div>

                <!-- Progress Bar -->

                <h2 class="mb-4">Your Progress!</h2>
                <div class="progress mb-4" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: {{ $completionPercentage }}%;">{{$completionPercentage}} %</div>
                </div>

            </div>
        </div>

        <!-- Relevant Cards -->

        <h3 class="page-title mb-4">List of todos due in the next 30 days</h3>
        <div>
            
            @if($todosInMonthRange->count() > 0)
                <div class="todos-list">
                    @foreach($todosInMonthRange as $todo)
                        @include('partials.todo-card', ['todo' => $todo])
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>
                    <h2 class="empty-state-title">No todos yet</h2>
                    <p class="empty-state-text">Start by creating your new todo to stay organized!</p>
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#createTodoModal">
                        <i class="bi bi-plus-circle me-2"></i>Create Your New Todo
                    </button>
                </div>
            @endif
        </div>


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