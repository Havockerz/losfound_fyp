<?php
namespace App\Http\Controllers;
use App\Models\Item; // Assuming your model is named Item 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Existing stats 
        $totalLost = Item::where('type', 'lost')->count();
        $totalFound = Item::where('type', 'found')->count();
        $totalResolved = Item::where('type', 'reunited')->count();
        $recentItems = Item::latest()->take(5)->get();

        // Data for Pie Chart: Count of each item_type where status is lost 
        $lostItemDistribution = Item::where('type', 'lost')->select('item_type', DB::raw('count(*) as total'))
            ->groupBy('item_type')->get();
            
        // Prepare labels and data for Chart.js 
        $chartLabels = $lostItemDistribution->pluck('item_type');
        $chartData = $lostItemDistribution->pluck('total');
        return view('dashboard', compact(
            'totalLost',
            'totalFound',
            'totalResolved',
            'recentItems',
            'chartLabels',
            'chartData'
        ));
    }
}