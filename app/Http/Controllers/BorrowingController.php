<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Auth::user()->role === 'admin' ? Borrowing::with('lab','user')->get() : Auth::user()->borrowings;
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $labs = Lab::all();
        return view('borrowings.create', compact('labs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lab_id' => 'required|exists:labs,id',
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'nullable|date|after:borrow_date',
            'purpose' => 'required|string',
        ]);

        $borrowing = new Borrowing($request->all());
        $borrowing->user_id = Auth::id();
        $borrowing->status = 'pending';
        $borrowing->save();

        return redirect()->route('borrowings.index')->with('success', 'Borrowing request submitted.');
    }

    public function approve(Borrowing $borrowing)
    {
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }
        $borrowing->status = 'approved';
        $borrowing->save();

        return redirect()->route('borrowings.index')->with('success', 'Borrowing request approved.');
    }

    public function reject(Borrowing $borrowing)
    {
        if(Auth::user()->role !== 'admin'){
            abort(403);
        }
        $borrowing->status = 'rejected';
        $borrowing->save();

        return redirect()->route('borrowings.index')->with('success', 'Borrowing request rejected.');
    }

    public function destroy(Borrowing $borrowing)
    {
        if(Auth::user()->role !== 'admin' && $borrowing->user_id !== Auth::id()){
            abort(403);
        }
        $borrowing->delete();
        return redirect()->route('borrowings.index')->with('success', 'Borrowing request deleted.');
    }
}
