<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterTaskRequest;
use App\Http\Requests\SearchTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ToDoController extends Controller
{
    public function index()
    {
        $order = request('order') == 1 ? 'asc' : 'desc';

        $tasks = Task::where('limitDate', '>=', date('Y-m-d'))
            ->when(request('search'), fn ($q, $search) => $q->where('name', 'like', "%$search%"))
            ->when(request('categories') == 1, fn ($q) => $q->orderBy('priority', $order))
            ->when(request('categories') == 2, fn ($q) => $q->orderBy('limitDate', $order))
            ->paginate(5);

        return view('todo.index', compact('tasks'));
    }

    public function previousTask()
    {
        $today = date('Y-m-d');

        $tasks = Task::where('limitDate', '<', $today)->get();
        return view('todo.previous', compact('tasks'));
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(StoreTaskRequest $request)
    {

        $task = Task::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'limitDate'     => $request->limitDate,
            'priority'      => $request->priority,
        ]);

        return response()->json(['task' => $task, 'message' => 'Tarea creada correctamente'], 201);
    }

    public function edit(int $id)
    {
        $task = Task::findOrFail($id);

        return view('todo.create', compact('task'));
    }

    public function update(StoreTaskRequest $request, int $id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'limitDate'     => $request->limitDate,
            'priority'      => $request->priority,
        ]);

        return response()->json(['task' => $task, 'message' => 'Tarea actualizada correctamente'], 200);
    }

    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return response()->json(['message' => 'Tarea eliminada correctamente'], 200);
    }

    public function filter()
    {
        $order = request('order') == 1 ? 'asc' : 'desc';

        $tasks = Task::where('limitDate', '>=', date('Y-m-d'))
            ->when(request('categories') == 1, fn ($q) => $q->orderBy('priority', $order))
            ->when(request('categories') == 2, fn ($q) => $q->orderBy('limitDate', $order))
            ->paginate(5);

        // $tasks = Task::where('limitDate', '>=', $today)
        // ->when(request('categories') == 1, function($q){
        //     $order = request('order') == 1 ? 'asc': 'desc';

        //     $q->orderBy('priority', $order);
        // })
        // ->when(request('categories') == 2, function($q){
        //     $order = request('order') == 1 ? 'asc': 'desc';

        //     $q->orderBy('limitDate', $order);
        // })->paginate(5);

        /* //propiedades
        if ($request->categories == 1) {
            if ($request->order == 1) {
                $tasks = Task::where('limitDate', '>=', $today)
                        ->orderBy('priority')->paginate(5);
            } else {
                $tasks = Task::where('limitDate', '>=', $today)
                        ->orderBy('priority', 'desc')->paginate(5);
            }
        } 
        
        //fecha
        else {
            if ($request->order == 1) {
                $tasks = Task::where('limitDate', '>=', $today)
                        ->orderby('limitDate')->paginate(5);
            }else{
                $tasks = Task::where('limitDate', '>=', $today)
                        ->orderBy('limitDate', 'desc')->paginate(5);
            }
        } */

        return view('todo.index', compact('tasks'));
    }

    /* public function search(){
        $tasks = Task::where('limitDate', '>=', date('Y-m-d'))
                ->when(request('search'), fn($q, $search) => $q->where('name', 'like', "%$search%"))
                ->paginate(5);

        return view('todo.index', compact('tasks'));
    } */

    public function test()
    {
        return response()->json(["response" => true]);
    }
}
