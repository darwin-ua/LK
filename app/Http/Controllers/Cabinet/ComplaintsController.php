<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ComplaintsExport;


class ComplaintsController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();

        // ===== параметры =====
        $perPage   = (int) $request->get('per_page', 10);
        $dateRange = $request->get('date_range', '30'); // по умолчанию 30 дней

        // ===== SORTING =====
        $sortable = [
            'complaint_number' => 'complaint_number',
            'complaint_date'   => 'complaint_date',
            'client'           => 'user_id',        // формально, клиент один
            'status'           => 'posted',
            'amount'           => 'amount',          // если есть поле
        ];

        $sort = $request->get('sort', 'complaint_date');
        $direction = $request->get('direction', 'desc');

        if (!array_key_exists($sort, $sortable)) {
            $sort = 'complaint_date';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }


        $query = Complaint::where('user_id', $user->id);

        // ===== фильтр по дате =====
        if ($dateRange !== 'all') {
            $days = (int) $dateRange;
            $query->where('complaint_date', '>=', now()->subDays($days));
        }

        // ===== сортировка =====
        $query->orderBy($sortable[$sort], $direction);


        // ===== пагинация =====
        $complaints = $query->paginate($perPage)->withQueryString();

        return view('admin.cabinet.complaints.index', [
            'complaints' => $complaints,
            'perPage'    => $perPage,
            'dateRange'  => $dateRange,
            'sort'       => $sort,
            'direction'  => $direction,
        ]);


    }

    public function export(Request $request)
    {
        $user = auth()->user();

        $dateRange = $request->get('date_range', 'all');

        return Excel::download(
            new ComplaintsExport($user->id, $dateRange),
            'complaints.xlsx'
        );
    }

}
