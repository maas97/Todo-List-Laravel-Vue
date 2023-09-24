<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Http\Response;


class TaskController extends Controller
{

    public function __construct(){
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::orderBy('Date', 'DESC')->get();
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
    public function store(Request $request)
    {
        $newTask = new Task;
        $newTask->Title = $request->title;
        $newTask->Notes = $request->notes;
        $newTask->Date = $request->date;
        $newTask->save();

        return response()->json('task stored successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // var_dump($id);
        // var_dump($request);
        Task::where('id', $id)->update([
            'Title'=> $request->title,
            'Notes'=> $request->notes,
            'Date'=> $request->date
        ]);
        
        return response()->json('task updated successfully');
    }

    public function completed(Request $request, string $id)
    {
        $currentTask = Task::find($id);
        if ($currentTask){
            $currentTask->Completed = $request->task['completed'] ? true : false;
            $currentTask->save();

            return $currentTask;
        }

        return "Task not found";
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $currentTask = Task::find($id);
        if ($currentTask){
            $currentTask->delete();

            return response()->json('task deleted successfully');
        }

        return "Task not found";
    }
}
