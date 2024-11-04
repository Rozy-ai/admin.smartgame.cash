<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PayoutController extends Controller implements HasMiddleware
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
    $status = $request->input('status');
    $payouts = Payout::query()
    ->when($status, function ($query, $status) {
        return $query->where('status', $status);
    })
    ->when($search, function ($query, $search) {
        return $query->where('payout_id', 'like', "%{$search}%")
                    ->orWhereHas('payment.user', function($query) use ($search) {
                        $query->where('username', 'like', "%{$search}%");
                    })
                     ->orWhere('amount', 'like', "%{$search}%")
                     ->orWhere('amount', 'like', "%{$search}%")
                     ->orWhere('status', 'like', "%{$search}%");
    })
    ->orderBy('payout_id', 'desc')->paginate(30);
    return view('payouts.index', compact('payouts'));
}

public function show($payout_id)
{    
    $payout = Payout::findOrFail($payout_id);

    return view('payouts.view',compact('payout'));
}

public function edit($id)
{
    $payout = Payout::findOrFail($id);
    return view('payouts.edit', compact('payout'));
}

public function update(Request $request, $id): RedirectResponse
{
    $payout = Payout::findOrFail($id);
    $payout->status = $request->input('status');
    $payout->save(); 
    // $payment->update($request->all());
    return redirect('payouts')->with('success', 'статус обновился');
}
}