<?php

namespace App\Http\Controllers\Admin\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\StoreTicektRequest;
use App\Http\Requests\Admin\Ticket\UpdateTicektRequest;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use App\Models\Ticket\TicketCategory;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::where('parent_id', null)->get();
        return view('admin.ticket.ticket.index', compact( 'tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TicketCategory::all();
        return view('admin.ticket.ticket.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicektRequest $request)
    {
        $inputs = $request->validated();
        $parentTicket = Ticket::find($inputs['parent_id']);

        $TicketAdmin = TicketAdmin::where('user_id', Auth::user()->id)->first();

        $inputs['subject'] = $parentTicket->subject;
        $inputs['category_id'] = $parentTicket->category_id;
        $inputs['parent_id'] = $parentTicket->id;
        $inputs['status'] = 1;
        $inputs['reference_id'] = $TicketAdmin->id;
        $inputs['user_id'] = Auth::user()->id;
        
        // dd($inputs);
        Ticket::create($inputs);
        return to_route(route: 'admin.tickets.ticket.index')->with('swal-success', 'تیکت با موفقیت ساخته شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('admin.ticket.ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $admins = TicketAdmin::all();
        $categories = TicketCategory::all();
        return view('admin.ticket.ticket.edit', compact('categories', 'admins', 'ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicektRequest $request, Ticket $ticket)
    {
        $inputs = $request->validated();
        $ticket->update($inputs);
        return to_route(route: 'admin.tickets.ticket.index')->with('swal-success', 'تیکت با موفقیت ویرایش شد');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return to_route(route: 'admin.tickets.ticket.index')->with('swal-success', 'تیکت با موفقیت حذف شد');
    }
    
    public function changeStatus(Request $request,Ticket $ticket)
    {
        $TicketAnswers = Ticket::where('parent_id', $ticket->id)->get();
        foreach ($TicketAnswers as $TicketAnswer) {
            $TicketAnswer->status == 1 ? $TicketAnswer->update(['status' => 0]) : $TicketAnswer->update(['status' => 1]);
        }
        
        $ticket->status == 1 ? $ticket->update(['status' => 0]) : $ticket->update(['status' => 1]);
        return to_route(route: 'admin.tickets.ticket.index')->with('swal-success', 'وضعیت تیکت و پاسخ های آن با موفقیت تغییر یافت');

    }
}
