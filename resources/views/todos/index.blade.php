<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .todo-item {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
        }

        .todo-item.completed {
            background: #e8f5e8;
            border-color: #4caf50;
        }

        .todo-title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .todo-title.completed {
            text-decoration: line-through;
            color: #666;
        }

        .todo-description {
            color: #666;
            margin-bottom: 10px;
        }

        .todo-status {
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 12px;
            color: white;
        }

        .status-pending {
            background-color: #ff9800;
        }

        .status-completed {
            background-color: #4caf50;
        }

        .empty-state {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 40px;
        }

        .todo-meta {
            font-size: 12px;
            color: #999;
            margin-top: 10px;
        }

        .due-date {
            background-color: #2196f3;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 11px;
            margin-left: 10px;
        }

        .due-date.overdue {
            background-color: #f44336;
        }

        .due-date.due-soon {
            background-color: #ff9800;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Todo List</h1>

        @if($todos->count() > 0)
            @foreach($todos as $todo)
                <div class="todo-item {{ $todo->completed ? 'completed' : '' }}">
                    <div class="todo-title {{ $todo->completed ? 'completed' : '' }}">
                        {{ $todo->title }}
                    </div>

                    @if($todo->description)
                        <div class="todo-description">
                            {{ $todo->description }}
                        </div>
                    @endif

                    <div class="todo-meta">
                        <span class="todo-status {{ $todo->completed ? 'status-completed' : 'status-pending' }}">
                            {{ $todo->completed ? 'Completed' : 'Pending' }}
                        </span>

                        @if($todo->due_date)
                            @php
                                $today = now()->startOfDay();
                                $dueDate = $todo->due_date->startOfDay();
                                $daysDiff = $today->diffInDays($dueDate, false);

                                $dueDateClass = '';
                                if ($daysDiff < 0) {
                                    $dueDateClass = 'overdue';
                                } elseif ($daysDiff <= 3) {
                                    $dueDateClass = 'due-soon';
                                }
                            @endphp
                            <span class="due-date {{ $dueDateClass }}">
                                Due: {{ $todo->due_date->format('M j, Y') }}
                                @if($daysDiff < 0)
                                    ({{ abs($daysDiff) }} day{{ abs($daysDiff) > 1 ? 's' : '' }} overdue)
                                @elseif($daysDiff == 0)
                                    (Today)
                                @elseif($daysDiff <= 7)
                                    ({{ $daysDiff }} day{{ $daysDiff > 1 ? 's' : '' }} left)
                                @endif
                            </span>
                        @endif

                        <span style="margin-left: 10px;">
                            Created: {{ $todo->created_at->format('M j, Y g:i A') }}
                        </span>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <p>No todos found. The list is empty!</p>
            </div>
        @endif
    </div>
</body>

</html>