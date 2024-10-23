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
use Illuminate\Support\Carbon;

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

public function getPaymentData(Request $request)
{
    $filter = $request->get('filter', 'monthly'); // По умолчанию "monthly"
    $data = [];
    $labels = [];

    switch ($filter) {
        case 'yearly':
            $data = array_fill_keys(range(1, 12), 0);
            // Группировка данных по месяцам
            $payments = Payment::where('status', 'Completed')
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
            $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            foreach ($payments as $month => $total) {
                $data[$month] = $total;
            }
            $amounts = array_values($data);
            break;

            case 'monthly':
                // Группировка данных по дням текущего месяца
                $data = Payment::where('status', 'Completed')
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->selectRaw('DAY(created_at) as day, SUM(amount) as total')
                    ->groupBy('day')
                    ->pluck('total', 'day')
                    ->toArray();
            
                // Создаем метки для дней текущего месяца в формате M d
                $labels = [];
                for ($day = 1; $day <= Carbon::now()->daysInMonth; $day++) {
                    $labels[] = Carbon::createFromDate(Carbon::now()->year, Carbon::now()->month, $day)->format('M d');
                }
            
                // Убедитесь, что все дни представлены в $data
                $amounts = [];
                foreach ($labels as $day) {
                    // Извлекаем номер дня из метки, чтобы найти соответствующую сумму
                    $dayNumber = (int) Carbon::createFromFormat('M d', $day)->day;
                    $amounts[] = $data[$dayNumber] ?? 0; // Используем 0, если сумма не найдена
                }
                break;

        case 'weekly':
            // Группировка данных по дням недели
            $data = array_fill_keys(range(1, 7), 0);
            $payments = Payment::where('status', 'Completed')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->selectRaw('DAYOFWEEK(created_at) as day, SUM(amount) as total')
            ->groupBy('day')
            ->pluck('total', 'day')
            ->toArray();
            foreach ($payments as $day => $total) {
                $data[$day] = $total;
            }
            $labels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            $amounts = array_values($data);
            break;

        case 'today':
            // Группировка данных по часам дня
            $data = Payment::where('status', 'Completed')
            ->whereDate('created_at', Carbon::today())
            ->selectRaw('HOUR(created_at) as hour, SUM(amount) as total')
            ->groupBy('hour')
            ->pluck('total', 'hour')
            ->toArray();
            $labels = range(0, 23);
            $amounts = [];
            foreach ($labels as $label) {
                $amounts[] = $data[$label] ?? 0; // Используем ноль, если данных нет
            }
            break;
    }

    return response()->json([
        'labels' => $labels,
        'amounts' => $amounts,
        'totalAmount' => array_sum($amounts)
    ]);
}

}