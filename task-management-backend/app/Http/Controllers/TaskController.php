<?php

namespace App\Http\Controllers;

use App\Models\Task;
use  App\Helpers\FormatResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user = $request->user();
        
        $tasks = $user->tasks;

        if($tasks->isEmpty()){
            return FormatResponse::success($tasks,"Task not found" , 200);
        }
    
        return FormatResponse::success( $tasks);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'required|string'
        // ]);



        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);


        if($validator->fails()){
            // return ["message"=> $validator->errors()];
            return FormatResponse::error("Error" , 400 , $validator->errors());
        }

        // $task = Task::create($request->all());
        // $task = Task::create($fields);
        $task = $request->user()->tasks()->create($request->all());
        // $task = $request->user();

        return  FormatResponse::success( $task,"Task created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {   
        
        try{
            $givenTask = Task::findOrFail($id);
            return  FormatResponse::success( $givenTask);
        }catch (ModelNotFoundException $e){

            return FormatResponse::success([],"Task not found" , 202);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        Gate::authorize('modify', $task);

        // $fields = $request->validate([
        //     'title' => 'required|max:255',
        //     'description' => 'required',
        //     'status' => 'max:255'
        // ]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'max:255'
        ]);


        if($validator->fails()){
            // return ["message"=> $validator->errors()];
            return FormatResponse::error("Error" , 400 , $validator->errors());
        }

    

        $task->update($request->all());

        return FormatResponse::success($task , "task updated successfully" );
    }

    public function updateStatus(Request $request , Task $task){

        Gate::authorize('modify' , $task);

        $request->validate([
            'status' => 'required|in:Pending,Completed'
        ]);

        
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Pending,Completed'
        ]);


        if($validator->fails()){
            return FormatResponse::error("Error" , 400 , $validator->errors());
        }

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
        return FormatResponse::success($deletedTask , "task deleted successfully" );
    }
}
