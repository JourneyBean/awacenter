<?php

namespace App\Http\Controllers\Admin\OAuthManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

class OAuthClientsController extends Controller
{

    public static function getClients() {
        $clients = Client::all();
        return $clients;
    }

    public function createPersonalClient(Request $request, ClientRepository $clients) {
        $request->validate([
            'name' => 'required|max:64',
        ]);
        $client = $clients->createPersonalAccessClient(
            null, $request->input('name'), 'http://localhost'
        );
        return $this->outputClientDetails($client);
    }

    public function createPasswordClient(Request $request, ClientRepository $clients)
    {
        $request->validate([
            'name' => 'required|max:64',
        ]);
        $provider = 'user';

        $client = $clients->createPasswordGrantClient(
            null, $request->input('name'), 'http://localhost', $request->input('provider')
        );

        return $this->outputClientDetails($client);
    }

    public function createClientCredentialsClient(Request $request, ClientRepository $clients)
    {
        $request->validate([
            'name' => 'required|max:64',
        ]);

        $client = $clients->create(
            null, $request->input('name'), ''
        );

        return $this->outputClientDetails($client);
    }

    public function createPublicAuthCodeClient(Request $request, ClientRepository $clients)
    {
        $request->validate([
            'user_id' => 'required|max:64',
            'name' => 'required|max:64',
            'redirect' => 'required|max:256',
        ]);

        $client = $clients->create(
            $request->input('user_id'),
            $request->input('name'),
            $request->input('redirect'), null, false, false, false
        );

        return $this->outputClientDetails($client);
    }

    public function createAuthCodeClient(Request $request, ClientRepository $clients)
    {
        $request->validate([
            'user_id' => 'required|max:64',
            'name' => 'required|max:64',
            'redirect' => 'required|max:256',
        ]);

        $client = $clients->create(
            $request->input('user_id'),
            $request->input('name'),
            $request->input('redirect'), null, false, false, true
        );

        return $this->outputClientDetails($client);
    }

    protected function outputClientDetails(Client $client)
    {
        return Redirect::back()->with([
            'status' => 'success',
            'message' => [
                'created_client_id' => $client->id,
                'created_client_secret' => $client->plainSecret,
            ],
            
        ]);
    }

    public function deleteClient(Request $request, Client $client)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $c = Client::where('id', $request->input('id'))->firstorfail()->delete();
        return Redirect::back()->with([
            'status' => 'success',
        ]);
    }

    public function toggleRevokeClient(Request $request, Client $client)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $c = Client::where('id', $request->input('id'))->first();
        $c->revoked = !$c->revoked;
        $c->save();
        return Redirect::back()->with([
            'status' => 'success',
        ]);
    }
}