<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booking;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("admin.index", [
            'countBooks' => Book::count(),
            'countCategories' => Category::count(),
            'countBookings' => Booking::count(),
            'countUsers' => User::where('role', 'member')->count(),

            'latestBooks' => Book::latest()->limit(5)->get(),
            'todayBookings' => Booking::whereDay('created_at', now()->day)->limit(5)->get(),
        ]);
    }
}
