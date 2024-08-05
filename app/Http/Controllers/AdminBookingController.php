<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.booking.index', [
            'bookings' => Booking::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('admin.pages.booking.show', [
            'booking' => $booking,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // dd($booking);

        $status = [
            'status' => $request['status']
        ];

        $status_created = [
            'status' => $request['status'],
            'created_at' => now(),
        ];

        $stockMin = [
            'stock' => $booking->book->stock - 1,
        ];

        $stockPlus = [
            'stock' => $booking->book->stock + 1,
        ];

        if ($booking->book->stock > 0) {
            if ($request['status'] == 'Disetujui') {
                $booking->update($status_created);
                $booking->book->update($stockMin);
            } else if ($request['status'] == 'Ditolak') {
                $booking->update($status);
            } else if ($request['status'] == 'Dikembalikan') {
                $booking->update($status);
                $booking->book->update($stockPlus);
            }
        } else {
            if ($request['status'] == 'Ditolak') {
                $booking->update($status);
            } else if ($request['status'] == 'Dikembalikan') {
                $booking->update($status);
                $booking->book->update($stockPlus);
            } else {
                return redirect()->back()->with('failed', 'Stock buku habis, tidak bisa menyetujui peminjaman!');
            }
        }

        return redirect('/admin/booking');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
