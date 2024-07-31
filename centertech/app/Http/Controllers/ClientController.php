<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use \Inertia\Response;

class ClientController extends Controller
{
    public function index(): Response
    {
        $clients = Client::with('tasks')
                        ->where('user_id', Auth::user()->id)
                        ->get();

        return Inertia::render('Clients/List', [
            'clients' => $clients
        ]);
    }

    public function create(): Response
    {
        $clients = Client::with('user')
                    ->where('user_id', Auth::user()->id)
                    ->get();

        return Inertia::render('Clients/Create', [
            'clients' => $clients
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'name'  => 'required | string | min:3 | max:100',
            'phone' => 'required | numeric | digits_between:8,12'
        ]);

        Client::create([
            'user_id'   => Auth::user()->id,
            'name'      => $data['name'],
            'phone'     => $data['phone'],
        ]);

        // $tasks = Task::with('client')
        //         ->whereHas('client', function($query) {
        //             $query->where('user_id', Auth::user()->id);
        //         })
        //         ->get();
        

        // return Inertia::render('Tasks/List', [
        //     'tasks' => $tasks
        // ]);

        return redirect()->route('clients.index');
    }
}
