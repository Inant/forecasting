<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class PurchaseOrderChart extends BaseChart
{
    public ?string $name = 'po_chart';
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        return Chartisan::build('line')
            ->labels(['First', 'Second', 'Third'])
            ->dataset('Sample', [10, 50, 100])
            ->dataset('Sample 2', [20, 80, 130]);
    }
}