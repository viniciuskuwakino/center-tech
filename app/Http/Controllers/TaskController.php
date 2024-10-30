<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Client;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;


class TaskController extends Controller
{
    public function index(Request $request): Response
    {
        
        $search = isset($request['search']) ? $request['search'] : "";

        $tasks = Task::with('client')
                ->whereHas('client', function($query) use ($search) {
                    $query->where('user_id', Auth::user()->id)
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();


        return Inertia::render('Tasks/List', [
            'tasks'     => $tasks,
            'filters'   => $request['search']
        ]);
    }

    public function create(): Response
    {
        $clients = Client::with('user')
                    ->where('user_id', Auth::user()->id)
                    ->orderBy('name', 'asc')
                    ->get();

        return Inertia::render('Tasks/Create', [
            'clients' => $clients
        ]);
    }

    public function register(StoreTaskRequest $request)
    {

        $data = $request->all();

        Task::create([
            // 'user_id'       => Auth::user()->id,
            'client_id'     => $data['client_id'],
            'device'        => $data['device'],
            'brand'         => $data['brand'],
            'model'         => $data['model'],
            'serial_number' => $data['serial_number'],
            'description'   => $data['description'],
            'price'         => $data['price'],
            'status'        => false,
        ]);

        $tasks = Task::with('client')
                ->whereHas('client', function($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

        return Redirect::route('tasks.index')->with(['tasks'], [$tasks]);

    }
    
    public function update(Request $request)
    {
        $data = $request->all();
        $taskUpdated = Task::find($data['task_id']);

        $taskUpdated->device = $data['device'];
        $taskUpdated->brand = $data['brand'];
        $taskUpdated->model = $data['model'];
        $taskUpdated->serial_number = $data['serial_number'];
        $taskUpdated->description = $data['description'];
        $taskUpdated->price = $data['price'];
        $taskUpdated->status = $data['status'];

        $taskUpdated->save();

        return;
    }

    public function destroy(Request $request)
    {
        $id = $request['id'];
        Task::find($id)->delete();

        return;
    }
}
