<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\Task as TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tasks = Task::all();
            $tasksList = TaskResource::collection($tasks);
            $message = '';
            $code = 200;
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the tasks from the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
            $message = "Something went wrong while getting the tasks from the database";
            $code = 404;
        }

        return response()->json([
            'error' => $error ?? false,
            'message' => $message,
            'data' => $tasksList,
            'code' => $code, 
            ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchByName(TaskRequest $request)
    {
        try {
            $tasks = Task::where('title', 'like', '%'.$request->title.'%')->get();
            $tasksList = TaskResource::collection($tasks);
            $message = '';
            $code = 200;
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the tasks from the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
            $message = "Something went wrong while getting the tasks from the database";
            $code = 404;
        }

        return response()->json([
            'error' => $error ?? false,
            'message' => $message,
            'data' => $tasksList,
            'code' => $code, 
            ]); 
    }

    /**
     * Store a newly created resource in storage.
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        try {
            $task = Task::create($request->validated());
            $new_task = new TaskResource($task);

            $message = 'Task created successfully';
            $code = 200;

        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while storing the task into the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
            $message = "Something went wrong while storing the task into the database";
            $code = 404;
        }

        return response()->json([
            'error'     => $error ?? false,
            'message'   => $message,
            'data'      => $new_task,
            'code'      => $code, 
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json([
            'error'     => $error ?? false,
            'message'   => '',
            'data'      => $task,
            'code'      => 200, 
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        try {
            $task->update($request->validated());
            $message    = 'Task updated successfully';
            $code       = 200;

        } catch (\Exception $e) {
            Log::error(
                'Something went wrong when trying to update the task in the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error      = true;
            $message    = "Something went wrong when trying to update the task in the database";
            $code       = 404;
        } 

        return response()->json([
            'error'     => $error ?? false,
            'message'   => '',
            'data'      => $task,
            'code'      => 200, 
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkAll(Request $request)
    {
        try {
            $tasksUpdated = Task::query()->update($request->only(['completed']));
            $tasks = Task::all();
            $message    = 'Tasks updated successfully';
            $code       = 200;

        } catch (\Exception $e) {
            Log::error(
                'Something went wrong when trying to update the tasks in the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error      = true;
            $message    = "Something went wrong when trying to update the tasks in the database";
            $code       = 404;
        } 

        return response()->json([
            'error'     => $error ?? false,
            'message'   => '',
            'data'      => $tasks,
            'code'      => 200, 
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        try {
            $task       = Task::where('id', $task->id)->delete();
            
            $message    = "Task deleted successfully";
            $code       = 200;

        } catch (\Exception $e) {
            Log::error(
                'Something went wrong trying to delete the task in the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error      = true;
            $message    = 'Something went wrong trying to delete the task in the database';
            $code       = 201;
        }


        return response()->json([
            'error'     => $error ?? false,
            'message'   => $message,
            'code'      => $code, 
            ]);
    }
}
