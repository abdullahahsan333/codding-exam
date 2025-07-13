<?php

namespace App\Http\Controllers;

use App\Models\TaskManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = TaskManagement::allTask();
        return response()->json(['success' => true, 'Task Management' => $tasks]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $task = TaskManagement::create($validator->validated());

        return response()->json(['success' => true,'Task Management' => $task], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = TaskManagement::find($id);

        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Task management not found'], 404);
        }

        return response()->json(['success' => true, 'Task management' => $task]);
    }

    public function markCompleted($id)
    {
        $task = TaskManagement::find($id);

        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Task Management not found'], 404);
        }

        $task->is_completed = true;
        $task->save();

        return response()->json(['success' => true, 'message' => 'Task Management marked as completed', 'Task Management' => $task]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = TaskManagement::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task Management not found.'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task Management deleted successfully.'
        ]);
    }
}
