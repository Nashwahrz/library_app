<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WriterApprovalController extends Controller
{
    /**
     * List writer pending
     */
    public function index(): View
    {
        $writers = User::where('role', 'writer')
            ->where('status', 'pending')
            ->get();

        return view('admin.writers.index', compact('writers'));
    }

    /**
     * Approve writer
     */
    public function approve(User $user): RedirectResponse
    {
        if ($user->role !== 'writer') {
            abort(403);
        }

        $user->update([
            'status' => 'active'
        ]);

        return redirect()
            ->route('admin.writers')
            ->with('success', 'Penulis berhasil disetujui.');
    }
}
