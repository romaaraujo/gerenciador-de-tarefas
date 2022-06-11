<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    private $valid_status = '';

    public function __construct()
    {
        $this->valid_status = implode(',', Task::$status);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'nullable|max:255',
                'status' => ['max:255', 'in:' . $this->valid_status],
                'file_url' => 'required|max:255'
            ]);

            if ($validator->fails())
                return response()->json($validator->messages(), 400);

            $new_task = Task::create(
                $request->all()
            );

            return $new_task;
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
            return response()->json(['error' => 'Internal error'], 500);
        }
    }

    public function update($task_id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'max:255',
                'description' => 'nullable|max:255',
                'status' => ['max:255', 'in:' . $this->valid_status],
                'file_url' => 'max:255'
            ]);

            if ($validator->fails())
                return response()->json($validator->messages(), 400);

            $task = Task::find($task_id);
            if ($task === null)
                return response()->json(['error' => 'Task not found'], 404);

            $task->update(
                $request->all()
            );

            return true;
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
            return response()->json(['error' => 'Internal error'], 500);
        }
    }

    public function updateTaskStatus($task_id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => ['required', 'max:255', 'in:' . $this->valid_status],
            ]);

            if ($validator->fails())
                return response()->json($validator->messages(), 400);

            $task = Task::find($task_id);
            if ($task === null)
                return response()->json(['error' => 'Task not found'], 404);

            if (!$this->canChangeStatus($task->status, $request->input('status')))
                return response()->json(['error' => 'Invalid status change'], 400);

            $task->update([
                'status' => $request->input('status')
            ]);

            return true;
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
            return response()->json(['error' => 'Internal error'], 500);
        }
    }

    private function canChangeStatus(string $current_status, string $requested_status): bool
    {
        $status_list = Task::$status;
        return (array_search($requested_status, $status_list) - array_search($current_status, $status_list)) === 1;
    }

    public function addTaskTag($task_id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tag_name' => ['required', 'max:255'],
            ]);

            if ($validator->fails())
                return response()->json($validator->messages(), 400);

            $task = Task::find($task_id);
            if ($task === null)
                return response()->json(['error' => 'Task not found'], 404);

            Tag::create([
                'task_id' => $task_id,
                'tag_name' => $request->input('tag_name')
            ]);

            return true;
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
            return response()->json(['error' => 'Internal error'], 500);
        }
    }

    public function index()
    {
        return Task::with('tags')->get(['id', 'name', 'description', 'status', 'created_at', 'updated_at']);
    }

    public function showFileUrl($task_id)
    {
        try {
            $task = Task::find($task_id);
            if ($task === null)
                return response()->json(['error' => 'Task not found'], 404);

            if ($task->status != 'approved')
                return response()->json(['error' => 'This task is not approved'], 400);

            return response()->json(['file_url' => $task->file_url]);
        } catch (\Exception $e) {
            Log::critical($e->getMessage());
            return response()->json(['error' => 'Internal error'], 500);
        }
    }
}
