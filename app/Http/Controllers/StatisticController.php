<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function filterByDate(Request $request) {
        $data = $request->all();
        $from = $data['from'];
        $to = $data['to'];
        $get = Statistic::whereBetween('date_order_statistic', [$from, $to])->orderBy('date_order_statistic', 'asc')->get();
        $chart_data = $get->map(function ($statistic) {
            return [
                'period' => $statistic->date_order_statistic,
                'order' => $statistic->total_order_statistic,
                'sales' => $statistic->sales_statistic,
                'profit' => $statistic->profit_statistic,
                'quantity' => $statistic->quantity_statistic
            ];
        });
    
        return response()->json($chart_data);
    }
    public function filterBy30days(Request $request) {
        $to = Carbon::now()->format('Y-m-d');
        $from = Carbon::now()->subDays(30)->format('Y-m-d');
        $get = Statistic::whereBetween('date_order_statistic', [$from, $to])->orderBy('date_order_statistic', 'asc')->get();
        $chart_data = $get->map(function ($statistic) {
            return [
                'period' => $statistic->date_order_statistic,
                'order' => $statistic->total_order_statistic,
                'sales' => $statistic->sales_statistic,
                'profit' => $statistic->profit_statistic,
                'quantity' => $statistic->quantity_statistic
            ];
        });
    
        return response()->json($chart_data);
    }
    public function filterByPreset(Request $request) {
        $data = $request->all();
        switch ($data['interval']) {
            case '7days':
                $to = Carbon::now()->format('Y-m-d');
                $from = Carbon::now()->subDays(7)->format('Y-m-d');
                break;
            case '365days':
                $to = Carbon::now()->format('Y-m-d');
                $from = Carbon::now()->subDays(365)->format('Y-m-d');
                break;
            case 'thang-nay':
                $to = Carbon::now()->format('Y-m-d');
                $from = Carbon::now()->startOfMonth()->format('Y-m-d');
                break;
            case 'thang-truoc':
                $to = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
                $from = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
                break;
        }
        
        $get = Statistic::whereBetween('date_order_statistic', [$from, $to])->orderBy('date_order_statistic', 'asc')->get();
        $chart_data = $get->map(function ($statistic) {
            return [
                'period' => $statistic->date_order_statistic,
                'order' => $statistic->total_order_statistic,
                'sales' => $statistic->sales_statistic,
                'profit' => $statistic->profit_statistic,
                'quantity' => $statistic->quantity_statistic
            ];
        });
    
        return response()->json($chart_data);
    }

    public function chartPOP(Request $request) {
        $product = Product::count();
        $post = Post::count();
        $admin = Admin::count();
        $client = Client::count();
        $order = Order::count();

        $chart_data = [
            'Sản phẩm' => $product,
            'Đơn hàng' => $order,
            'Bài viết' => $post,
            'Quản trị viên' => $admin,
            'Khách hàng' => $client
        ];

        return response()->json($chart_data);
    }
}
