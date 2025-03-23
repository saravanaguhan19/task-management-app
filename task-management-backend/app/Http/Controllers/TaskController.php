<?php

namespace App\Http\Controllers;

use App\Models\Task;
use  App\Helpers\FormatResponse;
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
    public function index(Request $request)
    {
        // Gate::authorize('view');
        // dd(Task::with('user')->latest()->get());
        // return Task::with('user')->latest()->get();
        $user = $request->user();


        // $tasks = Task::with(' user_id' , $user->id )->get();
        $tasks = $user->tasks;

        if($tasks->isEmpty()){
            return FormatResponse::success($tasks,"Task not found" , 202);
        }

        // return FormatResponse::success($tasks,"Task not found");
        return FormatResponse::success( $tasks);
        // return FormatResponse::success( $user->id);

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
        // $task = $request->user();

        return  FormatResponse::success( $task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {   
      
        

        return  FormatResponse::success( $task);
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

        return FormatResponse::success($task , "task updated successfully" );
    }

    public function updateStatus(Request $request , Task $task){

        Gate::authorize('modify' , $task);

        $request->validate([
            'status' => 'required|in:Pending,Completed'
        ]);

        
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|max:255',
        //     'description' => 'required',
        // ]);


        // if($validator->fails()){
        //     return ["message"=> $validator->errors()];
        // }



        $task->update(['status'=>$request->status]);

        return FormatResponse::success([] , "Task updated successfully");

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('modify', $task);
        $deletedTask =$task->delete();
// task deleted successfully
        return FormatResponse::success($deletedTask , "task deleted successfully" );
    }
}
