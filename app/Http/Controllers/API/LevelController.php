<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Library\JsonRes;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        return JsonRes::data(true,'testing');
    }

    public function getAll()
    {
        $data = Level::all();
        return response()->json($data);
    }

    public function getId($id)
    {
        $data = Level::find($id);
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
        $request->validate([
            'role' => 'required',
        ]);
        Level::create([
            'nama_level' => $request->role,
        ]);
        // Role::create($request->all());
        // $data = $request->all();
        return JsonRes::data(true, 'Create Successfully');
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
        Level::whereId($id)
            ->update([
                'nama_level' => $request->role
            ]);
        // $data = $request->all();
        return JsonRes::data(true, 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Level::destroy($id);
        return JsonRes::data(true, 'Delete Successfully');
    }
}
