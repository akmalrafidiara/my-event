<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Event\EventRegistrant;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
{
    if (Auth::user()->role == "admin") {
        $payments = Payment::whereNot('status', 'pending')->orderBy('created_at', 'desc')->get();
        return view("payments.index", compact("payments"));
    }
    
    if (Auth::user()->role == "user") {
        $user = Auth::user();
        $registrantIds = EventRegistrant::where("user_id", $user->id)->pluck("id");

        $payments = Payment::whereIn("registrant_id", $registrantIds)->orderBy('created_at', 'desc')->get();
        return view("payments.index", compact("payments"));
    }
}
public function detail(string $id)
{
    if (Auth::user()->role == "user") {
        $user = Auth::user();
        $registrantIds = EventRegistrant::where("user_id", $user->id)
            ->pluck("id")
            ->toArray();

        $payment = Payment::whereIn("registrant_id", $registrantIds)
            ->where("id", $id)
            ->first();

        if (!$payment) {
            return redirect()->route("payments.index")->with("error", "You are not authorized to access this payment");
        }
    }

    $payment = Payment::findOrFail($id);
    return view("payments.detail", compact("payment"));
}
public function update(PaymentRequest $request, string $id)
{
    $getPayment = Payment::findOrFail($id);

    $payment = $getPayment->fill($request->validated());

    $newImagePath = $request->file('proof_image')->store('payments', 'public');
    $payment->proof_image = $newImagePath;

    $payment->status = 'verification';

    $payment->save();

    return redirect()->route("payments.index")->with("success", "Payment status updated successfully");
}
public function rejected(string $id)
{
    $payment = Payment::findOrFail($id);
    $payment->status = "rejected";

    $payment->save();
    
    return redirect()->route("payments.index")->with("success", "Payment status updated successfully");
}
public function approved(string $id)
{
    $payment = Payment::findOrFail($id);

    $user = $payment->registrant->user;
    $event = $payment->registrant->event;

    $registrant = EventRegistrant::findOrFail($payment->registrant_id);

    $registrant->ticket_uid = $this->generateTicketUid($user, $event);
    $registrant->status = "confirmed";
    $payment->status = "approved";

    $registrant->save();
    $payment->save();

    return redirect()->route("payments.index")->with("success", "Payment status updated successfully");
}
private function generateTicketUid($user, $event)
{
    $userInitials = strtoupper(substr($user->name, 0, 1) . substr(explode(' ', $user->name)[1] ?? '', 0, 1));

    $datePart = now()->format('ymd'); // Tanggal dalam format singkat (YYMMDD)

    $eventWords = explode(' ', $event->title);
    $eventInitials = strtoupper(substr($eventWords[0], 0, 1) . substr($eventWords[1] ?? '', 0, 1) . substr($eventWords[2] ?? '', 0, 1));

    $randomNumber = rand(100, 999);

    $ticketUid = $userInitials . $datePart . $eventInitials . $randomNumber;

    return $ticketUid;
}
}