<?php

namespace App\Http\Controllers;

use App\Models\Fundraiser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    //
    public function apply_fundraiser(){

        $user = Auth::user();
        
        DB::Transaction(function () use ($user) {
            $validated['user_id'] = $user->id;
            $validated['is_active'] = false;

            Fundraiser:: create($validated);
        });
        Alert::success('Success', 'Fundraiser application submitted successfully');
        return redirect()->route('admin.fundraisers.index');
        
    }
   

}
