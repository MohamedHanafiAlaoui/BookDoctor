<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendrier;
use App\Services\CalendrierService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendrierController extends Controller
{
    protected $calendrierService;

    public function __construct(CalendrierService $calendrierService)
    {
        $this->calendrierService = $calendrierService;
    }

    public function index()
    {
        $calendriers = Calendrier::where('medecin_id', Auth::id())->get();
        return view('medecin.calendriers.index', compact('calendriers'));
    }

    public function create()
    {
        return view('medecin.calendriers.ajouter');
    }

// Controller
public function store(Request $request)
{
    $request->validate([
        'periods' => 'required|array|min:1',
        'periods.*.date' => 'required|date',
        'periods.*.start' => 'required|date_format:H:i',
        'periods.*.end' => 'required|date_format:H:i|after:periods.*.start',
    ]);

    foreach ($request->periods as $period) {
        $exists = Calendrier::where('medecin_id', auth()->id())
            ->where('jour', $period['date'])
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['periods' => "Vous avez déjà une période pour ce jour : {$period['date']}"])
                ->withInput();
        }

        $this->calendrierService->createCalendrier([
            'jour' => $period['date'],
            'heure_debut' => $period['start'],
            'heure_fin' => $period['end'],
        ]);
    }

    return redirect()->route('medecin.calendriers.index')->with('success', 'Périodes ajoutées avec succès.');
}



}
