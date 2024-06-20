<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    public function getClients(): View
    {
        $user = Auth::user();
        $clients = Client::where('name_is_responsible', $user->fio)->get();

        return view('index', compact('clients'));
    }

    public function updateStatus(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:Не в работе,В работе,Отказ,Сделка закрыта',
        ]);

        try {
            DB::transaction(function () use ($id, $request){
                $client = Client::findOrFail($id);
                $client->status = $request->input('status');
                $client->save();
            });
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());
        }

        return redirect()->route('index')->with('success', 'Статус клиента обновлен.');
    }
}
