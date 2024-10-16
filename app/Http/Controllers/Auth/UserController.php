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
        new Middleware('auth', only: ['index', 'edit', 'update', 'destroy']),
    ];
}
public function index()
{
    $users = UsersTg::paginate(30);
    return view('users.index', compact('users'));
}

// public function edit($id)
// {
//     $User = UsersTg::findOrFail($id);
//     return view('users.edit', compact('User'));
// }

// public function update(Request $request, $id)
// {
//     $User = UsersTg::findOrFail($id);
//     $User->update($request->all());
//     return redirect('users')->with('success', 'User updated successfully.');
// }

// public function destroy($id)
// {
//     $User = UsersTg::findOrFail($id);
//     $User->delete();
//     return redirect('users')->with('success', 'User deleted successfully.');
// }
}