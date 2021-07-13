<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\Task as TaskResource;

class TaskController extends Controller
{
    use ApiResponser;
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
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the tasks from the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }

        if(isset($error))
            return $this->errorResponse('Something went wrong while getting the tasks from the database', 500);
        return $this->successResponse('OK', $tasksList, 200);
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
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the tasks from the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }
        
        if(isset($error))
            return $this->errorResponse('Something went wrong while getting the tasks from the database', 500);
        return $this->successResponse('OK', $tasksList, 200);
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

        if(isset($error))
            return $this->errorResponse('Something went wrong while storing the task into the database', 500);
        return $this->successResponse('Task created successfully', $new_task, 200);

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
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong when trying to update the task in the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error      = true;
        } 

        if(isset($error))
            return $this->errorResponse('Something went wrong when trying to update the task in the database', 500);
        return $this->successResponse('Task updated successfully', $task, 200);
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

        if(isset($error))
            return $this->errorResponse('Something went wrong when trying to update the tasks in the database', 500);
        return $this->successResponse('Tasks updated successfully', $tasks, 200);
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
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong trying to delete the task in the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error      = true;
        }

        if(isset($error))
            return $this->errorResponse('Something went wrong trying to delete the task in the database', 500);
        return $this->successResponse('Task deleted successfully', '', 200);
    }
}