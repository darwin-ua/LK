<?php
namespace App\Exports;

use App\Models\Complaint;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ComplaintsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected int $userId;
    protected string $dateRange;

    public function __construct(int $userId, string $dateRange)
    {
        $this->userId    = $userId;
        $this->dateRange = $dateRange;
    }

    public function collection(): Collection
    {
        $query = Complaint::where('user_id', $this->userId);

        if ($this->dateRange !== 'all') {
            $query->where(
                'complaint_date',
                '>=',
                now()->subDays((int)$this->dateRange)
            );
        }

        return $query
            ->orderByDesc('complaint_date')
            ->get()
            ->map(fn ($c) => [
                '№ рекламації' => $c->complaint_number,
                'Дата'        => optional($c->complaint_date)->format('d.m.Y'),
                'Клієнт'      => $c->user->name ?? '',
                'Тип'         => 'Брак продукції',
                'Статус'      => $c->posted ? 'Вирішено' : 'В роботі',
                'Коментар'    => $c->comment,
            ]);
    }

    public function headings(): array
    {
        return [
            '№ рекламації',
            'Дата',
            'Клієнт',
            'Тип',
            'Статус',
            'Коментар',
        ];
    }
}

