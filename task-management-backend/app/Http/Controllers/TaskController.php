<?php

namespace App\Http\Controllers;

use App\Models\Task;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    // public static function middleware()
    // {
    //     return [
    //         new Middleware('auth:sanctum', ['index'])
    //     ];
    // }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('view');
        // dd(Task::with('user')->latest()->get());
        // return Task::with('user')->latest()->get();

        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);



        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|max:255',
        //     'description' => 'required',
        // ]);


        // if($validator->fails()){
        //     return ["message"=> $validator->errors()];
        // }

        // $task = Task::create($request->all());
        // $task = Task::create($fields);
        $task = $request->user()->tasks()->create($request->all());

        return ['task' => $task];
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        Gate::authorize('modify', $task);

        $fields = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'max:255'
        ]);

        $task->update($fields);

        return $task;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return ["message" => "task deleted successfully"];
    }
}
