<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Task\TaskResource;
use App\Http\Requests\Task\StoreTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Gate::authorize('viewAny', Task::class);

        return TaskResource::collection(auth()->user()->tasks()->get());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        if($request->user()->cannot('create', Task::class))
        {

            abort('403', 'This is unauthorized action');

        }

        $task = $request->user()->tasks()->create($request->validated());

        return TaskResource::make($task);

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        Gate::authorize('view', $task);

        return TaskResource::make($task);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        if($request->user()->cannot('update', $task))
        {

            abort('403', 'This is unauthorized action');

        }

        $task->update($request->validated());

        return TaskResource::make($task);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if(request()->user()->cannot('delete', $task))
        {

            abort('403', 'This is unauthorized action');

        }

        $task->delete();

        return response()->noContent();
    }
}
