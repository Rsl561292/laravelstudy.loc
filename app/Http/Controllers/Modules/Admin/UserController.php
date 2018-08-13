<?php

namespace App\Http\Controllers\Modules\Admin;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    //
    public function getIndex()
    {
        //

        $users = User::where('id', '<>', Auth::user()->id)
            ->orderBy('name')
            ->paginate(10);

        return view('modules/admin/user/index', [
            'users' => $users,
        ]);
    }

    public function getChangeRole(Request $request)
    {
        //
        if(!$request->ajax()) {

            abort(400, 'Barequest.');
        }

        $response = [
            'status' => true
        ];
        $userId = $request->input('user_id');
        $userRole = $request->input('user_role');

        if(!Arr::except(User::getRoleList(), $userRole)) {

            $response['status'] = false;
        }

        $countUpdate = DB::table('users')->where('id', $userId)->update([
            'role' => $userRole,
        ]);

        if($countUpdate == 0) {

            $response['status'] = false;
        }

        return response()->json($response);
    }

    public function getChangeStatus(Request $request)
    {
        //
        if(!$request->ajax()) {

            abort(400, 'Barequest.');
        }

        $response = [
            'status' => true
        ];
        $userId = $request->input('user_id');
        $userStatus = $request->input('user_status');

        if(!Arr::except(User::getStatusList(), $userStatus)) {

            $response['status'] = false;
        }

        $countUpdate = DB::table('users')->where('id', $userId)->update([
            'status' => $userStatus,
        ]);

        if($countUpdate == 0) {

            $response['status'] = false;
        }

        return response()->json($response);
    }
}
