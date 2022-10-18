<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request)
    {
//        Método profissional combinando a pesquisa
//        $search = $request->search;
        $users = $this->model
                  ->getUsers(
                      search: $request->search ?? ''
                  );
        return view('users.index', compact('users'));

//        dd($request->search);
//       Método convencional
//        $users = User::where('name','LIKE',"%{$request->search}%")->get();
//        dd($users);

//        return view('users.index', compact('users'));

    }

    public function show($id)
    {
//        $user = User::where('id',$id)->first();
        if (!$user = User::find($id))
            return redirect()->route('users.index');

        return view('users.show', compact('user'));
//        dd($user);

//        dd('users.show', $id);
//        return view('users.show');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        return redirect()->route('users.index');

//        Opção Método
//        $user = new User;
//        $user->name = $request->name;
//        $user->email = $request->email;
//        $user->password = $request->password;
//        $user->save();

//        dd($request->only([
//            'name', 'email', 'password'
//        ]));
    }

    public function edit($id)
    {
        if (!$user = User::find($id))
            return redirect()->route('users.index');

        return view('users.edit', compact('user'));
    }

    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        if (!$user = User::find($id))
            return redirect()->route('users.index');

        $data = $request->only('name', 'email');
        if ($request->password)
            $data['password'] = bcrypt($request->password);

        $user->update($data);

        return redirect()->route('users.index');
//        dd($request->all());
//        return view('users.edit', compact('user'));
    }

    public function destroy($id)
    {
        if (!$user = User::find($id))
            return redirect()->route('users.index');

        $user->delete();
        return redirect()->route('users.index');
    }
}
