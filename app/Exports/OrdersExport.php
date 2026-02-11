<?php


namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    protected array $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Order::where('user_id', auth()->id());

        if (!empty($this->filters['date_range']) && $this->filters['date_range'] !== 'all') {
            $query->where(
                'created_at',
                '>=',
                now()->subDays((int)$this->filters['date_range'])
            );
        }

        if (!empty($this->filters['q'])) {
            $search = trim($this->filters['q']);

            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhere('client', 'like', "%{$search}%");
            });
        }

        return $query
            ->orderByDesc('created_at')
            ->get();
    }



    public function headings(): array
    {
        return [
            '№ замовлення',
            'Дата створення',
            'Клієнт',
            'Статус',
            'Сума',
        ];
    }
}
