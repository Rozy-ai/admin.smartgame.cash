<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Payout;
use App\Models\User;
use App\Models\UsersTg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Carbon\Carbon;

class LoginRegisterController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['home', 'logout']),
            new Middleware('auth', only: ['home', 'logout']),
        ];
    }

    public function register(): View
    {
        return view('auth.register');
    }
    
    public function store(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'name' => 'required|string|max:250',
        //     'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
        //     'password' => 'required|string|min:8|confirmed'
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('home')
            ->withSuccess('You have successfully registered & logged in!');
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    }
    
    public function home(): View
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $lastMonth = Carbon::now()->subMonth()->month;
        $lastMonthYear = Carbon::now()->subMonth()->year;

        $currentMonthAmount = Payment::where('status', 'Completed')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('amount');
    
        // Total amount for last month
        $lastMonthAmount = Payment::where('status', 'Completed')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('amount');
            // Calculate percentage change
        if ($lastMonthAmount > 0) {
            $percentChange = (($currentMonthAmount - $lastMonthAmount) / $lastMonthAmount) * 100;
        } else {
            // If the last month's amount is 0, percentage change is undefined
            $percentChange = $currentMonthAmount > 0 ? 100 : 0;
        }

        $currentMonthUsers = UsersTg::whereRaw('FROM_UNIXTIME(joining_date, "%Y") = ?', [$currentYear])
        ->whereRaw('FROM_UNIXTIME(joining_date, "%m") = ?', [$currentMonth])
        ->count();

        $lastMonthUsers = UsersTg::whereRaw('FROM_UNIXTIME(joining_date, "%Y") = ?', [$lastMonthYear])
        ->whereRaw('FROM_UNIXTIME(joining_date, "%m") = ?', [$lastMonth])
        ->count();
   
    
        // Calculate percentage change
        if ($lastMonthUsers > 0) {
            $percentChangeUsers = (($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100;
        } else {
            $percentChangeUsers = $currentMonthUsers > 0 ? 100 : 0;
        }
        $percentChangeUsers = number_format($percentChangeUsers, 2);
        
        $currentMonthPayouts = Payout::where('status', 'Completed')
        ->whereMonth('payout_date', Carbon::now()->month)
        ->whereYear('payout_date', Carbon::now()->year)
        ->sum('amount');
    
        // Total amount for last month
        $lastMonthPayouts = Payment::where('status', 'Completed')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('amount');
            // Calculate percentage change
        if ($lastMonthPayouts > 0) {
            $percentChangePayouts = (($currentMonthPayouts - $lastMonthPayouts) / $lastMonthPayouts) * 100;
        } else {
            // If the last month's amount is 0, percentage change is undefined
            $percentChangePayouts = $currentMonthPayouts > 0 ? 100 : 0;
        }


        return view('auth.home',compact(
            'currentMonthAmount',
            'percentChange',
            'currentMonthUsers',
            'percentChangeUsers',
            'currentMonthPayouts',
            'percentChangePayouts'
         ));
    } 
    
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }
}