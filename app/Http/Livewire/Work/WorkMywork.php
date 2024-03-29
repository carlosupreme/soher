<?php

namespace App\Http\Livewire\Work;

use App\Mail\WorkBlockedByAdmin;
use App\Models\Review;
use App\Work\Domain\Status;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WorkMywork extends Component
{
    public $work;
    public $clientRate;
    public $fechaSolicitada;

    protected $listeners = ['blockWork'];

    public $user;
    public $modalAssignOpen = false;


    public function mount($work)
    {
        $this->user = Auth::user();
        $this->clientRate = number_format(Review::where('to_user_id', $work->client_id)->avg('rating'), 1);
        $this->work = $work;
        $deadline = $work->deadline;
        $this->fechaSolicitada = sprintf(
            "%s %d de %s del %d",
            $deadline->getTranslatedDayName(),
            $deadline->day,
            $deadline->getTranslatedMonthName(),
            $deadline->year
        );
    }

    public function archive()
    {
        $this->work->status = Status::ARCHIVED->value;
        $this->work->save();
        return redirect()->route('work.show', $this->work->id)->with(['flash.bannerStyle' => 'success', 'flash.banner' => 'Solicitud archivada exitosamente']);
    }

    public function openWork()
    {
        $this->work->status = Status::OPEN->value;
        $this->work->save();
        return redirect()->route('work.show', $this->work->id)->with(['flash.bannerStyle' => 'success', 'flash.banner' => 'Solicitud abierta exitosamente']);
    }

    public function close()
    {
        //pedir firma
        $this->work->status = Status::CLOSED->value;
        $this->work->save();
        return redirect()->route('work.show', $this->work)->with('flash.banner', 'Solicitud cerrada');
    }

    public function render()
    {
        $assigned = null;
        if (in_array($this->work->status, ['progress', 'finished', 'closed'])) {
            $assigned = $this->work->assigned->user;
        }
        return view('livewire.work.work-mywork', compact('assigned'));
    }
}
