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
use Illuminate\Support\Carbon;

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

public function userActivity(Request $request)
{
    $filter = $request->query('filter', 'monthly'); // Default to 'monthly'
    $userCounts = [];
    $labels = [];
    $totalUsers = 0;

    switch ($filter) {
        case 'daily':
            // Today’s user activity
            $totalUsers = UsersTg::whereDate('joining_date', Carbon::today())->count();
            $userCounts = UsersTg::selectRaw('HOUR(FROM_UNIXTIME(joining_date)) as hour, COUNT(*) as count')
                ->whereDate('joining_date', Carbon::today())
                ->groupBy('hour')
                ->pluck('count', 'hour')
                ->toArray();
            $labels = range(0, 23); // 24 hours
            break;

        case 'weekly':
            // Last 7 days user activity
            $totalUsers = UsersTg::whereBetween('joining_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
            $userCounts = UsersTg::selectRaw('DAYOFWEEK(FROM_UNIXTIME(joining_date)) as day, COUNT(*) as count')
                ->whereBetween('joining_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy('day')
                ->pluck('count', 'day')
                ->toArray();
            $labels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            break;

        case 'monthly':
            // Last 30 days user activity
            $totalUsers = UsersTg::whereMonth('joining_date', Carbon::now()->month)->count();
            $userCounts = UsersTg::selectRaw('DAY(FROM_UNIXTIME(joining_date)) as day, COUNT(*) as count')
                ->whereMonth('joining_date', Carbon::now()->month)
                ->groupBy('day')
                ->pluck('count', 'day')
                ->toArray();
            $labels = range(1, Carbon::now()->daysInMonth); // Days in the current month
            break;

        case 'yearly':
            // This year’s user activity
            $totalUsers = UsersTg::whereYear('joining_date', Carbon::now()->year)->count();
            $userCounts = UsersTg::selectRaw('MONTH(FROM_UNIXTIME(joining_date)) as month, COUNT(*) as count')
                ->whereYear('joining_date', Carbon::now()->year)
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();
            $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            break;
    }

    // Ensure there are values for each label
    $userCounts = array_replace(array_fill_keys($labels, 0), $userCounts);

    return response()->json([
        'totalUsers' => $totalUsers,
        'userCounts' => array_values($userCounts),
        'labels' => $labels,
    ]);
}

// public function destroy($id)
// {
//     $User = UsersTg::findOrFail($id);
//     $User->delete();
//     return redirect('users')->with('success', 'User deleted successfully.');
// }
}