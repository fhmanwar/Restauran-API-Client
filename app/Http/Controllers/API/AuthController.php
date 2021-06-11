<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Library\JsonRes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return JsonRes::data(true,'testing');
    }

    public function login(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'uName' => 'required',
            'pass' => 'required',
        ]);
        // return JsonRes::data(true, 'Successfully', $request->all());

        if ($valid->fails()) {
            return JsonRes::data(false, 'Login unsuccessfully', $valid->errors());
        } else {
            $emp = User::select( 'username', 'nama_user', 'password', 'passHash')
                ->leftJoin('tb_level as l','tb_user.id_level', '=', 'l.id' )
                ->where('username',$request->uName)
                ->first();

            if ($emp != null) {
                // $hash = Hash::check($request->pass, $emp->password);
                // if ($hash) {
                //     return JsonRes::data(true,'Success');
                // }
                if ($request->pass == $emp->password) {
                    return JsonRes::data(true,'Success');
                }
                return JsonRes::data(true,'Invalid Password');
            }
            return JsonRes::data(true,'ID Card is Not Exist, You must registered');
        }
    }

    public function register(Request $request)
    {
        // return JsonRes::data(true,'testing Auth');
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'pass' => 'required',
            'roleId' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // return response()->json($valid->fails());
        if ($valid->fails()) {
            return $this->data(false, 'Create unsuccessfully', 'Your Data is wrong');
        } else {
            $newName = null;
            $image = $request->file('avatar');
            if ($image) {
                // $path = url('img/upload/avatar/');
                $path = '/img/upload/profile';
                $name = $image->getClientOriginalName().'-'.time().'.'.$image->getClientOriginalExtension();
                // $image->move(public_path('img/upload/avatar/'),$name);
                $image->storeAs($path,$name);
                $newName = $path.'/'.$name;
            }

            $user = User::forceCreate([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->pass),
            ]);
            return JsonRes::data(true, 'Create Successfully');
        }
    }
}
