<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\StoreTicektCategoryRequest;
use App\Http\Requests\Admin\Ticket\UpdateTicektCategoryRequest;
use App\Models\Ticket\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = TicketCategory::all();
        return view('admin.ticket.ticket-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ticket.ticket-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicektCategoryRequest $request)
    {
        $inputs = $request->validated();
        $category = TicketCategory::create($inputs);
        return to_route(route: 'admin.tickets.ticket-category.index')->with('swal-success', 'دسته بندی تیکت با موفقیت ساخته شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketCategory $ticketCategory)
    {
        return view('admin.ticket.ticket-category.edit', compact('ticketCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicektCategoryRequest $request, TicketCategory $ticketCategory)
    {
        $inputs = $request->validated();
        $ticketCategory->update($inputs);
        return to_route(route: 'admin.tickets.ticket-category.index')->with('swal-success', 'دسته بندی تیکت با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketCategory $ticketCategory)
    {
        $ticketCategory->delete();
        return to_route(route: 'admin.tickets.ticket-category.index')->with('swal-success', 'دسته بندی تیکت با موفقیت حذف شد');
    }
}
