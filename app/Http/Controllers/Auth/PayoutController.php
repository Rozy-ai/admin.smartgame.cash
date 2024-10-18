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
        new Middleware('auth', only: ['index', 'edit', 'view', 'update', 'destroy']),
    ];
}
public function index()
{
    $payouts = Payout::with('payment')->orderBy('payout_id', 'desc')->paginate(30);
    return view('payouts.index', compact('payouts'));
}

public function view($payout_id)
{    
    $payout = Payout::findOrFail($payout_id);

    return view('payouts.view',compact('payout'));
}
}