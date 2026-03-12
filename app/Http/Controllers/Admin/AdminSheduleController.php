<?php
namespace App\Http\Controllers\Admin; // Укажите правильное пространство имен

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shedule;
use App\Models\Timework;
use Illuminate\Support\Facades\Auth;
use App\Models\SheduleDetail;
use App\Models\Marker;




class AdminSheduleController extends Controller
{

    public function storeMarker(Request $request)
    {
        \Log::info('== storeMarker START ==');
        \Log::info('Request data: ', $request->all());

        // Проверка авторизации
        if (!auth()->check()) {
            \Log::error('storeMarker: Unauthorized access attempt');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userId = auth()->id();
        \Log::info("Authenticated user ID: $userId");

        // Валидация
        $validator = \Validator::make($request->all(), [
            'reserv_date' => 'required|date',
            'marker_type' => 'required|string|max:100',
            'event_ids' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            \Log::error('storeMarker: Validation failed', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $marker = Marker::create([
                'user_id' => $userId,
                'date' => $request->input('reserv_date'),
                'marker_type' => $request->input('marker_type'),
                'event_ids' => is_array($request->input('event_ids')) ? $request->input('event_ids') : [],

            ]);


            \Log::info('storeMarker: Marker created successfully', [
                'marker_id' => $marker->id,
                'user_id' => $userId,
                'date' => $marker->date,
                'type' => $marker->marker_type,
            ]);

            return response()->json(['status' => 'ok', 'marker_id' => $marker->id]);
        } catch (\Exception $e) {
            \Log::error('storeMarker: Exception occurred', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    public function storeDetail(Request $request)
    {
        \Log::info('== storeDetail START ==');
        \Log::info('Request data: ', $request->all());

        if (!auth()->check()) {
            \Log::error('storeDetail: Unauthorized access attempt');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userId = auth()->id();
        \Log::info("Authenticated user ID: $userId");

        // Валидация
        $validator = \Validator::make($request->all(), [
            'shedule_id' => 'required|integer',
            'reserv_date' => 'required|date',
            'reserv_start' => 'required|date_format:H:i',
            'reserv_end' => 'required|date_format:H:i',
            'interval_minutes' => 'nullable|integer',
            'event_ids' => 'nullable|array',
            'is_interval' => 'nullable',
            'status' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            \Log::error('storeDetail: Validation failed', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Проверка временного интервала
        if (strtotime($request->reserv_start) >= strtotime($request->reserv_end)) {
            \Log::warning('storeDetail: Start time is not earlier than end time', [
                'start' => $request->reserv_start,
                'end' => $request->reserv_end,
            ]);
            return response()->json(['errors' => ['reserv_end' => ['End time must be later than start time.']]], 422);
        }

        try {
            // Создание записи в деталях расписания
            $detail = SheduleDetail::create([
                'shedule_id' => $request->input('shedule_id'),
                'date' => $request->input('reserv_date'),
                'start_time' => $request->input('reserv_start'),
                'end_time' => $request->input('reserv_end'),
                'interval_minutes' => $request->input('interval_minutes'),
                'is_interval' => $request->input('is_interval') === 'on' ? true : false,
                'event_ids' => $request->input('event_ids') ?? null,
                'status' => 'available',
                'user_id' => $userId,
            ]);

            \Log::info('storeDetail: SheduleDetail created', [
                'id' => $detail->id,
                'user_id' => $userId,
                'date' => $detail->date,
                'start' => $detail->start_time,
                'end' => $detail->end_time,
            ]);

            return response()->json(['status' => 'ok', 'id' => $detail->id]);

        } catch (\Exception $e) {
            \Log::error('storeDetail: Exception occurred', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }



    public function getShedules()
    {
        $shedules = Shedule::with('timework')->get();

        $events = [];

        foreach ($shedules as $shedule) {
            $label = $shedule->reserv;

            // Преобразуем Timework для каждого дня
            $days = [
                'mon' => 1,
                'tue' => 2,
                'wed' => 3,
                'thu' => 4,
                'fri' => 5,
                'sat' => 6,
                'sun' => 7,
            ];

            foreach ($days as $day => $iso) {
                $start = $shedule->timework->{'time_work_start_' . $day};
                $end = $shedule->timework->{'time_work_end_' . $day};

                if ($start && $end) {
                    $startTime = \Carbon\Carbon::createFromFormat('H:i:s', $start);
                    $endTime = \Carbon\Carbon::createFromFormat('H:i:s', $end);

                    // Создаем событие на всю неделю вперёд
                    $period = \Carbon\CarbonPeriod::create(now()->startOfWeek(), now()->endOfWeek());

                    foreach ($period as $date) {
                        if ($date->isoWeekday() === $iso) {
                            $events[] = [
                                'title' => $label,
                                'start' => $date->toDateString() . 'T' . $startTime->format('H:i:s'),
                                'end' => $date->toDateString() . 'T' . $endTime->format('H:i:s'),
                                'backgroundColor' => '#28a745',
                                'borderColor' => '#28a745',
                            ];
                        }
                    }
                }
            }

            // Отображаем индивидуальные записи shedule, если заданы даты
            if ($shedule->reserv_start && $shedule->reserv_end) {
                $events[] = [
                    'title' => $label,
                    'start' => $shedule->reserv_start,
                    'end' => $shedule->reserv_end,
                    'backgroundColor' => '#007bff',
                    'borderColor' => '#007bff',
                ];
            }
        }

        return response()->json($events);
    }

    public function updateShedule(Request $request, $id)
    {
        $shedule = Shedule::findOrFail($id);
        $shedule->update([
            'reserv' => $request->input('title'),
            'reserv_start' => $request->input('start'),
            'reserv_end' => $request->input('end'),
        ]);

        return response()->json($shedule);
    }


    public function deleteShedule($id)
    {
        $shedule = Shedule::findOrFail($id);
        $shedule->delete();

        return response()->json(['success' => true]);
    }
    public function index()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();
        $shedules = Shedule::paginate(10);
        $activeShedule = $shedules->first();

        $events = Event::where('user_id', $currentAdmin->id)
            ->get(['id', 'title as title', 'start_date as start', 'end_date as end']);

        $details = collect();

        if ($activeShedule) {
            $details = SheduleDetail::where('shedule_id', $activeShedule->id)
                ->where('user_id', $currentAdmin->id)
                ->get();
        }

        $markers = Marker::where('user_id', $currentAdmin->id)->get();

        $markerColors = [
            'Go home' => ['bg' => '#ffc107', 'border' => '#ffc107', 'text' => '#000'],
            'Do homework' => ['bg' => '#28a745', 'border' => '#28a745', 'text' => '#fff'],
            'Work on UI design' => ['bg' => '#007bff', 'border' => '#007bff', 'text' => '#fff'],
            'Sleep tight' => ['bg' => '#dc3545', 'border' => '#dc3545', 'text' => '#fff'],
        ];

        foreach ($details as $detail) {
            $eventIds = is_string($detail->event_ids)
                ? json_decode($detail->event_ids, true)
                : $detail->event_ids;

            if (is_array($eventIds)) {
                foreach ($eventIds as $eid) {
                    $events[] = [
                        'id' => $eid,
                        'title' => substr($detail->start_time ?? '00:00', 0, 5) . '-' . substr($detail->end_time ?? '23:59', 0, 5),
                        'start' => $detail->date . 'T' . ($detail->start_time ?? '00:00:00'),
                        'end'   => $detail->date . 'T' . ($detail->end_time ?? '23:59:59'),
                        'backgroundColor' => '#17a2b8',
                        'borderColor' => '#17a2b8',
                        'textColor' => '#fff',
                    ];
                }
            }
        }


        foreach ($markers as $marker) {
            $color = $markerColors[$marker->marker_type] ?? ['bg' => '#ffc107', 'border' => '#ffc107', 'text' => '#000'];

            $events[] = [
                'id' => 'marker_' . $marker->id,
                'title' => $marker->marker_type,
                'start' => $marker->date . 'T00:00:00',
                'end'   => $marker->date . 'T23:59:59',
                'backgroundColor' => $color['bg'],
                'borderColor' => $color['border'],
                'textColor' => $color['text'],
            ];
        }

        return view('admin.shedule.index', compact(
            'admins', 'currentAdmin', 'shedules', 'activeShedule', 'events', 'markers', 'details'
        ));
    }


    public function settings()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();
        $shedules = Shedule::all();

        return view('admin.shedule.settings', compact('admins', 'currentAdmin','shedules'));
    }

    public function create()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();

        return view('admin.shedule.create',compact('admins','currentAdmin'));
    }

    public function store(Request $request)
    {
        if ($request->has('reserv')) {
            $request->validate([
                'reserv' => 'required|string',
            ]);
            $user_id = Auth::id();
            $shedule = Shedule::create([
                'reserv' => $request->input('reserv'),
                'event_id' => 0,
                'mono' => $request->input('mono'),
                'datapicker' => $request->input('datapicker'),
                'user_id' =>$user_id,
                'reserv_start' => $request->input('reserv_start'),
                'reserv_end' => $request->input('reserv_end'),
                'time' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $start_time_mon = $request->input('time_work_start_mon');
            $end_time_mon = $request->input('time_work_end_mon');
            $time_work_start_tue = $request->input('time_work_start_tue');
            $time_work_end_tue = $request->input('time_work_end_tue');
            $time_work_start_wed = $request->input('time_work_start_wed');
            $time_work_end_wed = $request->input('time_work_end_wed');
            $time_work_start_thu = $request->input('time_work_start_thu');
            $time_work_end_thu = $request->input('time_work_end_thu');
            $time_work_start_fri = $request->input('time_work_start_fri');
            $time_work_end_fri = $request->input('time_work_end_fri');
            $time_work_start_sat = $request->input('time_work_start_sat');
            $time_work_end_sat = $request->input('time_work_end_sat');
            $time_work_start_sun = $request->input('time_work_start_sun');
            $time_work_end_sun = $request->input('time_work_end_sun');

            Timework::create([
                'shedule_id' => $shedule->id,
                'time_work_start_mon' => $start_time_mon,
                'time_work_end_mon' => $end_time_mon,
                'time_work_start_tue' => $time_work_start_tue,
                'time_work_end_tue' =>  $time_work_end_tue,
                'time_work_start_wed' =>  $time_work_start_wed,
                'time_work_end_wed' =>  $time_work_end_wed,
                'time_work_start_thu' => $time_work_start_thu,
                'time_work_end_thu' =>   $time_work_end_thu,
                'time_work_start_fri' =>  $time_work_start_fri,
                'time_work_end_fri' => $time_work_end_fri,
                'time_work_start_sat' => $time_work_start_sat ,
                'time_work_end_sat' => $time_work_end_sat,
                'time_work_start_sun' =>   $time_work_start_sun,
                'time_work_end_sun' => $time_work_end_sun,
                'time' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'status' => 1,
            ]);

            return redirect()->route('admin.shedules.index')->with('success', 'Shedule created successfully');
        }
    }

    public function destroy(Shedule $shedule)
    {
        $shedule->delete();
        return redirect()->route('admin.shedule.index')->with('success', 'Shedule deleted successfully');
    }
}

