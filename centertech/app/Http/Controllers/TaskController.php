<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    public function index(): Response
    {
        
        $tasks = Task::with('client')
                ->whereHas('client', function($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->get();
        

        return Inertia::render('Tasks/List', [
            'tasks' => $tasks
        ]);
    }

    public function create(): Response
    {
        $clients = Client::with('user')
                    ->where('user_id', Auth::user()->id)
                    ->get();

        return Inertia::render('Tasks/Create', [
            'clients' => $clients
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->all();

    //    dd($request->all());

        Task::create([
            'user_id'       => Auth::user()->id,
            'cen_client_id' => $data['client_id'],
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
                ->get();
        

        // return Inertia::render('Tasks/List', [
        //     'tasks' => $tasks
        // ]);

        return redirect()->route('tasks.index');
    }
}
