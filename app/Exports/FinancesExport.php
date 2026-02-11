<?php
namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class FinancesExport implements FromCollection
{
    public function __construct(
        protected $user,
        protected $range
    ) {}

    public function collection()
    {
        $q = DB::table('lk_partner_payments')
            ->where('id_lk', $this->user->id_lk);

        if ($this->range !== 'all') {
            $q->where('created_at', '>=', now()->subDays((int)$this->range));
        }

        return $q->orderBy('created_at', 'desc')->get();
    }
}
