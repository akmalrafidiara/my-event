<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event\Event;
use App\Models\Event\EventRegistrant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrantController extends Controller
{
    public function register(String $id)
    {
        $event = Event::findOrFail($id);
        $user = User::findOrFail(Auth::user()->id);

        // check if user is already complete the profile
        if ($user->hasNullColumns()) {
            return redirect()->route('events.index')->with('error','Complete your profile first!');
        }

        // check if register is already exsist
        $registrant = EventRegistrant::query()
                    ->where('event_id', $event->id)
                    ->where('user_id', $user->id)
                    ->first();
        
        if ($registrant) {
            return redirect()->route('events.index')->with('error','User is already registered to the event!');
        }

        // check if event is already done
        if($event->status === 'done') {
            return redirect()->route('events.index')->with('error','Event is already done!');
        }

        // check if event is already full
        $totalRegistrant = EventRegistrant::query()->where('event_id', $event->id)->where('status', 'confirmed')->count();

        if ($totalRegistrant >= $event->quota) {
            return redirect()->route('events.index')->with('error','Event is already full!');
        }

        
        // check if user age is allowed
        $userAge = $this->calculateAge($user->birth_date);
        
        if ($userAge < $event->min_age) {
            return redirect()->route('events.index')->with('error','User age is not allowed!');
        }   

        EventRegistrant::create([
            'event_id' => $event->id,
            'user_id' => $user->id
        ]);

        return redirect()->route('events.index')->with('success','User Successfully registered for the '. $event->title .' event');
    }

    private function calculateAge($birthDate)
    {
        $birthDate = date('Y-m-d', strtotime($birthDate));
        $today = date('Y-m-d');
        $diff = date_diff(date_create($birthDate), date_create($today));
        return $diff->format('%y');
    }
}
