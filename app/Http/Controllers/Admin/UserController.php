<?php
    
namespace App\Http\Controllers\Admin;

use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
    
class UserController extends Controller
{
    public $image_rules = 'mimes:jpg,png,jpeg,gif|min:2|max:2024|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000';
    protected $route = 'admin.users';
    protected $perPage = 20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'All users';
        if (($role = $request->get('role')) && $role !== 'Subscriber') {

            $role = Role::where('name', $role)->first();
            if (!$role) {
                return redirect()->back()->with('warning', 'Whoops! Role not found.');
            }
            $users = User::role($role)->orderBy('updated_at', 'desc')->paginate($this->perPage);
            $users->appends(['role' => $role]);
            $title = 'All Users with role '.$role->name.' ('.$users->total().')';
        }else {
            $users = User::where('is_active', true)->orderBy('id','DESC')->paginate($this->perPage);
            $title = 'All users ('.$users->total().')';
        }
        
        return view('admin/users/index', ['users' => $users, 'title' => $title]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $user = User::class;
        $userRole = [];
        return view($this->route.'.create', ['route' => $this->route.'.index', 'method' => 'POST', 'user' => $user, 'roles' => $roles, 'userRole' => $userRole]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ];
        if ($request->hasFile('avatar')) {
            $rules['avatar'] = $this->image_rules;
        }
        $input = $this->validate($request, $rules);
        unset($input['roles']);

        $input['slug'] = Str::slug($request->name);
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('public/users');
            chmod(storage_path('app/public/users'),0775);
            $path = preg_replace('#public/#', 'uploads/', $path);
            $input['avatar'] = asset($path);
        }

        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('admin.users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where(['is_active' => true, 'id' => $id])->first();
        if (!$user) {
            return redirect()->back()->with('danger', 'User not found');
        }
        return view('admin.users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where(['is_active' => true, 'id' => $id])->first();
        if (!$user) {
            return redirect()->back()->with('danger', 'User not found');
        }
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view($this->route.'.edit', ['route' => $this->route.'.update', 'method' => 'PATCH', 'user' => $user,'roles' => $roles, 'userRole' => $userRole]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'nullable|array'
        ];
        if ($request->get('confirm-password')) {
            $rules['password'] = ['same:confirm-password'];
        }
        if ($request->hasFile('avatar')) {
            $rules['avatar'] = $this->image_rules;
        }
        $input = $this->validate($request, $rules);
        unset($input['roles']);

        $input['slug'] = Str::slug($request->name);
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('public/users');
            chmod(storage_path('app/public/users'),0775);
 
            $path = preg_replace('#public/#', 'uploads/', $path);
            $input['avatar'] = asset($path);
            // Delete old image if exists
            $existing_path = preg_replace("#".asset('uploads')."#", "public", User::find($id)->avatar);
            Storage::delete($existing_path);
        }
    
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            unset($input['password']);    
        }
    
        $user = User::where(['is_active' => true, 'id' => $id])->first();

        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('admin.users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id != $id) {
            User::find($id)->update(['is_active' => false]);
            return redirect()->route('admin.users.index')
                            ->with('success','User deleted successfully');
        }else{
            return redirect()->back()->with('danger', 'Cannot delete own account from here');
        }
    }
}