<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipApplicationController extends Controller
{
    public function index()
    {
        $applications = MembershipApplication::with('reviewer')->orderBy('id', 'desc')->get();
        return view('admin.membership_applications.index', compact('applications'));
    }

    public function approve($id)
    {
        $application = MembershipApplication::findOrFail($id);
        $application->update([
            'status'      => 2,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Application marked as approved. You can now create a login account for them from Admin & Staff Directory.');
    }

    public function reject($id)
    {
        $application = MembershipApplication::findOrFail($id);
        $application->update([
            'status'      => 3,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Application marked as rejected.');
    }

    public function destroy($id)
    {
        $application = MembershipApplication::findOrFail($id);
        $application->delete();

        return redirect()->back()->with('success', 'Application removed.');
    }
}
