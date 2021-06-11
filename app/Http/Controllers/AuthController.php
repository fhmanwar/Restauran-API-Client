<?php

namespace App\Http\Controllers;

use App\Library\JsonRes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function tes()
    {
        $data = User::select( 'id_user as userId', 'username', 'nama_user as name', 'password', 'passHash', 'l.id as roleId', 'l.nama_level as roleName')
                ->leftJoin('tb_level as l','tb_user.id_level', '=', 'l.id' )
                ->where('username','triadmin')
                ->first();

        return JsonRes::data(true, 'Successfully', $data);
    }

    public function tesSession(Request $request)
    {
        $data = $request->session()->all();
        // $data = $request->session()->get('RoleName');
        return JsonRes::data(true, 'Successfully', $data);
    }

    public function login()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'uName' => 'required',
            'pass' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->route('login')->with('status', $valid->errors());
            // return JsonRes::data(false, 'Login unsuccessfully', $valid->errors());
        } else {
            $emp = User::select( 'id_user as userId', 'username', 'nama_user as name', 'password', 'passHash', 'l.id as roleId', 'l.nama_level as roleName')
                ->leftJoin('tb_level as l','tb_user.id_level', '=', 'l.id' )
                ->where('username',$request->uName)
                ->first();

            if ($emp != null) {
                if ($request->pass == $emp->password) {
                    session([
                        'userId' => $emp->userId,
                        'userName' => $emp->username,
                        'name' => $emp->name,
                        'roleId' => $emp->roleId,
                        'roleName' => $emp->roleName,
                        'statusLogin' => true,
                    ]);
                    return redirect()->route('dasbor');
                    // return redirect()->route('tes');
                }
                return redirect()->route('login')->with('status', 'Invalid Password');
            }
            return redirect()->route('login')->with('status', 'Your Name Does Not Exist');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }

}
