<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function join()
    {
        $user = Auth::user();
        $clients = Client::where('name_is_responsible', $user->fio)->get();
        return view('index', compact('clients'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Не в работе,В работе,Отказ,Сделка закрыта',
        ]);

        $client = Client::findOrFail($id);
        $client->status = $request->input('status');
        $client->save();

        return redirect()->route('index')->with('success', 'Статус клиента обновлен.');
    }
}
