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
            // Today's user activity
            $today = Carbon::today();
        
            // Total users registered today
            $totalUsers = UsersTg::whereRaw('DATE(FROM_UNIXTIME(joining_date)) = ?', [$today->format('Y-m-d')])->count();
        
            // User counts grouped by hour
            $userCounts = UsersTg::selectRaw('HOUR(FROM_UNIXTIME(joining_date)) as hour, COUNT(*) as count')
                ->whereRaw('DATE(FROM_UNIXTIME(joining_date)) = ?', [$today->format('Y-m-d')])
                ->groupBy('hour')
                ->pluck('count', 'hour')
                ->toArray();
        
            // Labels for 24 hours (0-23)
            $labels = range(0, 23);
        
            // Ensure all 24 hours are represented with a count (0 if no users registered during that hour)
            $userCounts = array_merge(array_fill_keys($labels, 0), $userCounts);
        
            break;

            case 'weekly':
                // Last 7 days user activity
                $startOfWeek = Carbon::now()->startOfWeek(); // Start of the week (Monday)
                $endOfWeek = Carbon::now()->endOfWeek();     // End of the week (Sunday)
            
                // Total users for the current week
                $totalUsers = UsersTg::whereBetween(
                    'joining_date',
                    [Carbon::createFromTimestamp($startOfWeek->timestamp), Carbon::createFromTimestamp($endOfWeek->timestamp)]
                )->count();
            
                // User counts grouped by day of the week
                $userCounts = UsersTg::selectRaw('DAYOFWEEK(FROM_UNIXTIME(joining_date)) as day, COUNT(*) as count')
                    ->whereRaw('FROM_UNIXTIME(joining_date) BETWEEN ? AND ?', [$startOfWeek, $endOfWeek])
                    ->groupBy('day')
                    ->pluck('count', 'day')
                    ->toArray();
            
                // Labels for days of the week (1 = Sun, 2 = Mon, ..., 7 = Sat)
                $labels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            
                // Ensure all days of the week are represented
                $userCounts = array_merge(array_fill_keys([1, 2, 3, 4, 5, 6, 7], 0), $userCounts);
            
                break;

        case 'monthly':
            // Last 30 days user activity
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
    
            $totalUsers = UsersTg::whereRaw('FROM_UNIXTIME(joining_date, "%Y") = ?', [$currentYear])
            ->whereRaw('FROM_UNIXTIME(joining_date, "%m") = ?', [$currentMonth])
            ->count();
    

            $userCounts = UsersTg::selectRaw('DAY(FROM_UNIXTIME(joining_date)) as day, COUNT(*) as count')
            ->whereRaw('MONTH(FROM_UNIXTIME(joining_date)) = ?', [Carbon::now()->month])
            ->groupBy('day')
            ->pluck('count', 'day')
            ->toArray();
              
            $labels = [];
            for ($day = 1; $day <= Carbon::now()->daysInMonth; $day++) {
                $labels[] = Carbon::createFromDate($currentYear, $currentMonth, $day)->format('M d');
            }
            $userCounts = array_replace(array_fill_keys(range(1, Carbon::now()->daysInMonth), 0), $userCounts);
       
            break;

            case 'yearly':
                // This year's user activity
                $currentYear = Carbon::now()->year;
            
                // Total users registered this year
                $totalUsers = UsersTg::whereRaw('YEAR(FROM_UNIXTIME(joining_date)) = ?', [$currentYear])->count();
            
                // User counts grouped by month
                $userCounts = UsersTg::selectRaw('MONTH(FROM_UNIXTIME(joining_date)) as month, COUNT(*) as count')
                ->whereRaw('YEAR(FROM_UNIXTIME(joining_date)) = ?', [$currentYear])
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();
               
                // Labels for 12 months
                $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            
                // Ensure all months are represented with a count (0 if no users registered during that month)
                $userCounts = array_replace(array_fill_keys(range(1, 12), 0), $userCounts);
 
                break;
    }
    if($filter !== 'yearly' && $filter !== 'monthly' ){
            // Ensure there are values for each label
     $userCounts = array_replace(array_fill_keys($labels, 0), $userCounts);
    }


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