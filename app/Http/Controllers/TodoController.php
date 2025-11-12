<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TodoController extends Controller
{
    /**
     * Display a listing of all todos.
     */
    public function index()
    {
        $todos = Todo::orderBy('created_at', 'desc')->get();

        return view('todos.index', compact('todos'));
    }

    /**
     * Create todo summary.
     */
    public function summary()
    {
        $completedTodosCount = Todo::where('completed', true)->count();
        $pendingTodosCount = Todo::where('completed', false)->count();
        $totalTodosCount = $completedTodosCount + $pendingTodosCount;

        $completionPercentage = $totalTodosCount > 0 ? round(($completedTodosCount/$totalTodosCount)*100) : 0;

        $currentDate = Carbon::now(config('app.timezone'))->startOfDay();
        $endDate = $currentDate->copy()->addDays(30)->endOfDay();
        $todosInMonthRange = Todo::whereBetween('due_date', [$currentDate, $endDate])->orderBy('created_at', 'desc')->get();
        
        return view('todos.summary', compact('totalTodosCount', 'completedTodosCount', 'pendingTodosCount', 'completionPercentage', 'todosInMonthRange'));
    }

    /**
     * Store a newly created todo in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date|after_or_equal:today',
        ]);

        Todo::create($validated);

        return redirect()->back()
            ->with('success', 'Todo created successfully!');
    }

    /**
     * Mark a todo as completed.
     */
    public function complete(Todo $todo)
    {
        $todo->update(['completed' => true]);

        return redirect()->back()
            ->with('success', 'Todo marked as completed!');
    }

    /**
     * Mark a todo as incomplete (undo completion).
     */
    public function uncomplete(Todo $todo)
    {
        $todo->update(['completed' => false]);

        return redirect()->back()
            ->with('success', 'Todo marked as incomplete!');
    }

    /**
     * Remove the specified todo from the database.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->back()
            ->with('success', 'Todo deleted successfully!');
    }

}
