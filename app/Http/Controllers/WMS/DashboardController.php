<?php

namespace App\Http\Controllers\WMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select([
                'id', 'name', 'email', 'phone', 'gender', 
                'status', 'city', 'birth_date', 'created_at'
            ]);

            return DataTables::of($users)
                // ->addColumn('action', function ($user) {
                //     return '<div class="btn-group" role="group">
                //         <button type="button" class="btn btn-sm btn-primary" onclick="editUser(' . $user->id . ')">
                //             <i class="fas fa-edit"></i> Edit
                //         </button>
                //         <button type="button" class="btn btn-sm btn-danger" onclick="deleteUser(' . $user->id . ')">
                //             <i class="fas fa-trash"></i> Delete
                //         </button>
                //     </div>';
                // })
                // ->addColumn('age', function ($user) {
                //     return \Carbon\Carbon::parse($user->birth_date)->age;
                // })
                // ->editColumn('status', function ($user) {
                //     $badgeClass = $user->status === 'active' ? 'badge-success' : 'badge-secondary';
                //     return '<span class="badge ' . $badgeClass . '">' . ucfirst($user->status) . '</span>';
                // })
                // ->editColumn('gender', function ($user) {
                //     return ucfirst($user->gender);
                // })
                // ->editColumn('birth_date', function ($user) {
                //     return \Carbon\Carbon::parse($user->birth_date)->format('d M Y');
                // })
                // ->editColumn('created_at', function ($user) {
                //     return $user->created_at->format('d M Y H:i');
                // })
                // ->filter(function ($query) use ($request) {
                //     // Filter by status
                //     if ($request->has('status') && $request->status !== '') {
                //         $query->where('status', $request->status);
                //     }
                    
                //     // Filter by gender
                //     if ($request->has('gender') && $request->gender !== '') {
                //         $query->where('gender', $request->gender);
                //     }
                    
                //     // Filter by city
                //     if ($request->has('city') && $request->city !== '') {
                //         $query->where('city', $request->city);
                //     }
                    
                //     // Filter by age range
                //     if ($request->has('min_age') && $request->min_age !== '') {
                //         $maxBirthDate = now()->subYears($request->min_age)->format('Y-m-d');
                //         $query->where('birth_date', '<=', $maxBirthDate);
                //     }
                    
                //     if ($request->has('max_age') && $request->max_age !== '') {
                //         $minBirthDate = now()->subYears($request->max_age + 1)->format('Y-m-d');
                //         $query->where('birth_date', '>', $minBirthDate);
                //     }
                // })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('wms.dashboard.index');
    }
}
