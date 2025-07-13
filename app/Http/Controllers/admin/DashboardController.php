<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\AdminMenu;
use App\Http\Helpers\Calculus;
use App\Models\Events;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class DashboardController extends Controller
{
    private function GetCustomerCountFromMonth($month, $year) {
        return User::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereHas('role', function($q) {
                $q->where('name', 'GUEST');
            })
            ->count();
    }
    private function GetCustomers():array {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;

        $last_month = $month - 1;
        $last_year = $year;
        if($last_month < 0) {
            $last_month = 11;
            $last_year = $year - 1;
        }
        
        $current_month_customers = $this->GetCustomerCountFromMonth($month, $year);
        $last_month_customers = $this->GetCustomerCountFromMonth($last_month, $last_year);
        $customers = [
            'last' => $last_month_customers,
            'current' => $current_month_customers,
            'percentage' => Calculus::GrowPercentageIndex($last_month_customers, $current_month_customers)
        ];
        return $customers;
    }

    private function GetEventsData() {
        return Events::select([
            DB::raw("DATE_FORMAT(date, '%Y-%m') as date"),
            DB::raw('COUNT(*) as Total')
        ])
            ->whereYear('date', Carbon::now()->year)
            ->groupBy(DB::raw("DATE_FORMAT(date, '%Y-%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(date, '%Y-%m')"), 'asc')
            ->get()
            ->toArray();
    }

    public function create(string $lang) {
        if(Auth::user()->role->name !== 'ADMIN') return redirect("/{$lang}/my-place");
        return Inertia::render('admin/Dashboard', [
            'lang' => $lang, 
            'menu' => (new AdminMenu())->GetMenu($lang),
            'customers' => $this->GetCustomers(),
            'events' => $this->GetEventsData()
        ]);
    }
}
