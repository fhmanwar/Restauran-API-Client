<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Library\JsonRes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return JsonRes::data(true,'testing');
    }

    public function getAll()
    {
        $data = User::select('tb_user.id_user','tb_user.username', 'tb_user.nama_user', 'tb_user.id_level', 'tb_user.status', 'tb_level.nama_level')
                ->leftJoin('tb_level', 'tb_user.id_level','=','tb_level.id')
                ->get();
        return response()->json($data);
    }

    public function getId($id)
    {
        $data = User::select('tb_user.id_user','tb_user.username', 'tb_user.nama_user', 'tb_user.id_level', 'tb_user.status', 'tb_level.nama_level')
                ->leftJoin('tb_level', 'tb_user.id_level','=','tb_level.id')
                ->where('tb_user.id_user',$id)
                ->first();
        return JsonRes::data(true, 'Successfully', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'pass' => 'required',
        ]);
        if ($valid->fails()) {
            return JsonRes::data(false, 'Create unsuccessfully', $valid->errors());
        } else {
            User::forceCreate([
                'username' => $request->username,
                'password' => Hash::make($request->pass),
                'nama_user' => $request->name,
                'id_level' => $request->levelId,
                'status' => $request->status,
            ]);
            return JsonRes::data(true, 'Create Successfully');
        }
        // return JsonRes::data(true, 'Create Successfully',$request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
        ]);
        if ($valid->fails()) {
            return JsonRes::data(false, 'Create unsuccessfully', $valid->errors());
        } else {
            if ($request->pass != null) {
                User::where('id_user', $id)
                    ->update([
                        'password' => Hash::make($request->pass),
                    ]);
            }
            User::where('id_user', $id)
                ->update([
                    'username' => $request->username,
                    'nama_user' => $request->name,
                    'id_level' => $request->levelId,
                    'status' => $request->status,
                ]);
            // $data = $request->all();
            return JsonRes::data(true, 'Update Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // User::destroy($id);
        User::where('id_user', $id)->delete();
        return JsonRes::data(true, 'Delete Successfully');
    }
}
