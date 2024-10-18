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
public function index()
{
    $users = UsersTg::orderBy('joining_date', 'desc')->paginate(30);
    return view('users.index', compact('users'));
}

public function show($id)
{    
    $user = UsersTg::findOrFail($id);

    return view('users.view',compact('user'));
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