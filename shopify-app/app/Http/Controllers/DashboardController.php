<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate total sales
        $totalSales = Order::sum('total_amount');

        // Get total number of orders
        $totalOrders = Order::count();

        // Get total products sold
        $productsSold = OrderItem::sum('quantity');

        // Calculate average order value
        $averageOrderValue = $totalOrders > 0 ? $totalSales / $totalOrders : 0;

        // Get sales data for the last 7 days
        $salesChartData = $this->getSalesChartData();

        // Get top 5 selling products
        $topProductsData = $this->getTopProductsData();

        // Get recent orders
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalSales',
            'totalOrders',
            'productsSold',
            'averageOrderValue',
            'salesChartData',
            'topProductsData',
            'recentOrders'
        ));
    }

    private function getSalesChartData()
    {
        $sales = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_amount) as total')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $data = [];

        // Fill in any missing days with zero sales
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $amount = $sales->firstWhere('date', $date)?->total ?? 0;
            
            $labels[] = Carbon::parse($date)->format('M d');
            $data[] = $amount;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    private function getTopProductsData()
    {
        $topProducts = OrderItem::select(
            'product_id',
            DB::raw('SUM(quantity) as total_quantity')
        )
            ->with('product:id,name')
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

        $labels = $topProducts->pluck('product.name')->toArray();
        $data = $topProducts->pluck('total_quantity')->toArray();

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}
