<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{

        public function index(Request $request)
        {
        
            $query=User::select('id','name','email','role','estado');
            $documentos=$query->orderBy('id', 'asc')->paginate(5);
    
            return ['paginate'=>[
                'total' => $documentos->total(),
                'current_page' => $documentos->currentPage(),
                'per_page' =>$documentos->perPage(),
                'last_page' =>$documentos->lastPage(),
                'from' => $documentos->firstItem(),
                'to' => $documentos->lastPage(),
            ],
            'user'=> $documentos];
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  bcrypt($request->password);
        $user->role = $request->get('role');
        $user->estado = "ACTIVADO";
        $user->save();
    }

    public function show($id)
    {
        $documentos=User::where('id','=',$id)->first();

        return ['user'=> $documentos];
    }

    public function edit($id)
    {

    }

    public function update(Request $request)
    {
        $user = User::where('id','=',$request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  bcrypt($request->password);
        $user->role = $request->get('role');
        $user->estado = "ACTIVADO";
        $user->save();
    }

    public function destroy($id)
    {
        //
    }
}
