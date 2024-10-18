<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PaymentController extends Controller implements HasMiddleware
{

public static function middleware(): array
{
    return [
        // new Middleware('guest', except: ['home', 'logout']),
        new Middleware('auth', only: ['index', 'edit', 'show', 'update']),
    ];
}
public function index(Request $request)
{
    $search = $request->input('search');
    $payments = Payment::query()
    ->when($search, function ($query, $search) {
        return $query->where('card_number', 'like', "%{$search}%")
                    ->orWhereHas('user', function($query) use ($search) {
                        $query->where('username', 'like', "%{$search}%");
                    })
                     ->orWhere('external_id', 'like', "%{$search}%")
                     ->orWhere('user_id', 'like', "%{$search}%")
                     ->orWhere('amount', 'like', "%{$search}%")
                     ->orWhere('status', 'like', "%{$search}%");
    })
    ->with('user')->orderBy('id', 'desc')->paginate(30);
    return view('payments.index', compact('payments'));
}

public function show($id)
{    
    $payment = Payment::findOrFail($id);

    return view('payments.view',compact('payment'));
}

public function edit($id)
{
    $payment = Payment::findOrFail($id);
    return view('payments.edit', compact('payment'));
}

public function update(Request $request, $id): RedirectResponse
{
    $payment = Payment::findOrFail($id);
    $payment->status = $request->input('status');
    $payment->save(); 
    // $payment->update($request->all());
    return redirect('payments')->with('success', 'статус обновился');
}

}