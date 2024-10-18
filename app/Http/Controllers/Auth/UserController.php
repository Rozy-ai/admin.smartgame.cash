<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UsersTg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{

public static function middleware(): array
{
    return [
        // new Middleware('guest', except: ['home', 'logout']),
        new Middleware('auth', only: ['index', 'edit', 'update', 'show']),
    ];
}
public function index(Request $request)
{
    $search = $request->input('search');
    $users = UsersTg::query()
    ->when($search, function ($query, $search) {
        return $query->where('username', 'like', "%{$search}%")
                     ->orWhere('first_name', 'like', "%{$search}%")
                     ->orWhere('id', 'like', "%{$search}%")
                     ->orWhere('last_name', 'like', "%{$search}%");
    })
    ->orderBy('joining_date', 'desc')->paginate(30);
    return view('users.index', compact('users'));
}

public function show($id)
{    
    $user = UsersTg::findOrFail($id);
    $referals = UsersTg::where('inviter_id', $id)->get();

    return view('users.view',compact('user', 'referals'));
}

public function edit($id)
{
    $user = UsersTg::findOrFail($id);
    return view('users.edit', compact('user'));
}

public function update(Request $request, $id): RedirectResponse
{
    $user = UsersTg::findOrFail($id);
    // $user->status = $request->input('status');
    // $user->save(); 
    $user->update($request->all());
    return redirect('users')->with('success', 'баланс обновился');
}

// public function destroy($id)
// {
//     $User = UsersTg::findOrFail($id);
//     $User->delete();
//     return redirect('users')->with('success', 'User deleted successfully.');
// }
}