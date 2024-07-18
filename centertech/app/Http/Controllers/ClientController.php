<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use \Inertia\Response;

class ClientController extends Controller
{
    public function index(): Response
    {
        $clients = Client::where('user_id', Auth::user()->id)->get();

        return Inertia::render('Clients/List', [
            'clients' => $clients
        ]);
    }
}
