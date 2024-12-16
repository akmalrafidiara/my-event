<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Event\EventRegistrant;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Constants for payment statuses
    const STATUS_PENDING = 'pending';
    const STATUS_VERIFICATION = 'verification';
    const STATUS_REJECTED = 'rejected';
    const STATUS_APPROVED = 'approved';

    public function index()
    {
        if (Auth::user()->role == "admin") {
            // Admin can see all payments that are not pending
            $payments = Payment::where('status', '!=', self::STATUS_PENDING)
                ->orderBy('created_at', 'desc')
                ->get();
            return view("payments.index", compact("payments"));
        }

        if (Auth::user()->role == "user") {
            // Users can only see their own payments
            $user = Auth::user();
            $registrantIds = EventRegistrant::where("user_id", $user->id)->pluck("id");
            $payments = Payment::whereIn("registrant_id", $registrantIds)
                ->orderBy('created_at', 'desc')
                ->get();
            return view("payments.index", compact("payments"));
        }
    }

    public function detail(string $id)  
    {
    $payment = Payment::findOrFail($id);

    // Ensure users can only view their own payments
    if (Auth::user()->role == "user" && $payment->registrant->user_id != Auth::id()) {
        return redirect()->route("payments.index")->with("error", "You are not authorized to access this payment");
    }

    return view("payments.detail", compact("payment"));
    }

    public function update(PaymentRequest $request, string $id)
{
    $payment = Payment::findOrFail($id);

    // Ensure the user can only update their own payment
    if (Auth::user()->role == 'user' && $payment->registrant->user_id != Auth::id()) {
        return redirect()->route("payments.index")->with("error", "You are not authorized to update this payment");
    }

    // Proceed with the update if authorized
    $payment->fill($request->validated());

    if ($request->hasFile('proof_image')) {
        $newImagePath = $request->file('proof_image')->store('payments', 'public');
        $payment->proof_image = $newImagePath;
    }

    $payment->status = 'verification';
    $payment->save();

    return redirect()->route("payments.index")->with("success", "Payment status updated successfully");
}


    public function rejected(string $id)
    {
        $payment = Payment::findOrFail($id);

        // Ensure only admin can reject
        if (Auth::user()->role != 'admin') {
            return redirect()->route("payments.index")->with("error", "You are not authorized to reject this payment");
        }

        $payment->status = self::STATUS_REJECTED;
        $payment->save();

        return redirect()->route("payments.index")->with("success", "Payment status updated successfully");
    }

    public function approved(string $id)
    {
        $payment = Payment::findOrFail($id);

        // Ensure only admin can approve
        if (Auth::user()->role != 'admin') {
            return redirect()->route("payments.index")->with("error", "You are not authorized to approve this payment");
        }

        $user = $payment->registrant->user;
        $event = $payment->registrant->event;

        $registrant = EventRegistrant::findOrFail($payment->registrant_id);

        $registrant->ticket_uid = $this->generateTicketUid($user, $event);
        $registrant->status = "confirmed";
        $payment->status = self::STATUS_APPROVED;

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
