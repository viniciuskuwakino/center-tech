<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use \Inertia\Response;

class ClientController extends Controller
{
    public function index(Request $request)
    {

        $search = isset($request['search']) ? $request['search'] : "";

        $clients = Client::with('tasks')
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10)
                        ->withQueryString();

        return Inertia::render('Clients/List', [
            'clients'   => $clients,
            'filters'   => $request['search']
        ]);

    }

    public function show(int $id)
    {

        $client = Client::with('tasks')->find($id);

        return Inertia::render('Clients/Show', [
            'client' => $client
        ]);

    }

    public function create(): Response
    {

        $clients = Client::with('user')->get();

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
            'name'      => $data['name'],
            'phone'     => $data['phone'],
        ]);

        return redirect()->route('clients.index');

    }

    public function update(Request $request)
    {

        $data = $request->all();

        $request->validate([
            'name'  => 'required | string | min:3 | max:100',
            'phone' => 'required | numeric | digits_between:8,12'
        ]);

        $client = Client::find($data['client_id']);

        $client->name = $data['name'];
        $client->phone = $data['phone'];

        $client->save();

        return;

    }
}
