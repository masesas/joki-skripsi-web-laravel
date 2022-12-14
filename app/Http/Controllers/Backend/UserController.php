<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Events\Backend\UserCreated;
use App\Events\Backend\UserProfileUpdated;
use App\Events\Backend\UserUpdated;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Userprofile;
use App\Models\UserProvider;
use App\Notifications\UserAccountCreated;
use Auth;
use Carbon\Carbon;
use Crypt;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class UserController extends Controller {
    use Authorizable;

    public function __construct() {
        // Page Title
        $this->module_title = 'Users';

        // module name
        $this->module_name = 'users';

        // directory path of the module
        $this->module_path = 'users';

        // module icon
        $this->module_icon = 'c-icon cil-people';

        // module model name, path
        $this->module_model = "App\Models\User";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $page_heading = ucfirst($module_title);
        $title = $page_heading . ' ' . ucfirst($module_action);

        $$module_name = $module_model::paginate();

        $data = $module_model;

        return view(
            'backend.users.index',
            compact(
                'module_title',
                'module_name',
                'module_path',
                'module_icon',
                'module_action',
                'module_name_singular',
                'page_heading',
                'title'
            )
        );
    }

    public function index_data() {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::select(
            'id',
            'nim',
            'nama',
            'username',
            'alamat',
            'telepon',
            'status'
        );

        $data = $$module_name;

        return Datatables::of($$module_name)
            ->editColumn('nim', '<strong>{{$nim}}</strong>')
            ->editColumn('nama', '<strong>{{$nama}}</strong>')
            ->editColumn('alamat', '<strong>{{$alamat}}</strong>')
            ->editColumn('telepon', '<strong>{{$telepon}}</strong>')
            ->addColumn('status', '<strong>{{ucwords($status)}}</strong>')
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;

                return view('backend.includes.user_actions', compact('module_name', 'data'));
            })
            ->rawColumns(['nim', 'nama', 'alamat', 'telepon', 'status', 'action'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';
        $user = null;

        return view(
            "backend.users.edit",
            compact(
                'module_title',
                'module_name',
                'module_path',
                'module_icon',
                'module_action',
                'module_name_singular',
                'user'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Details';

        $data_array = $request->except('_token');
        $data_array['password_string'] = $request->password;
        $data_array['password'] = Hash::make($request->password);
        $$module_name_singular = User::create($data_array);
        $$module_name_singular->save();


        Flash::success("<i class='fas fa-check'></i> New '" . Str::singular($module_title) . "' Created")->important();

        return redirect("admin/users");
    }

    /**
     * Show the form for Profile Paeg Editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id) {
        $module_title = 'Profile';
        $module_name = 'Profile';

        $module_action = 'Profile';
        $user = User::findOrFail($id);

        return view(
            "backend.users.profile",
            compact(
                'module_title',
                'module_name',
                'module_action',
                'user',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request, $id) {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Edit Profile';

        $this->validate($request, [
            'avatar'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'first_name' => 'required|min:3|max:191',
            'last_name' => 'required|min:3|max:191',
            'email'     => 'email',
        ]);

        if (!Auth::user()->can('edit_users')) {
            $id = auth()->user()->id;
        }

        $$module_name_singular = User::findOrFail($id);

        // Handle Avatar upload
        if ($request->hasFile('avatar')) {
            if ($$module_name_singular->getMedia($module_name)->first()) {
                $$module_name_singular->getMedia($module_name)->first()->delete();
            }

            $media = $$module_name_singular->addMedia($request->file('avatar'))->toMediaCollection($module_name);

            $$module_name_singular->avatar = $media->getUrl();

            $$module_name_singular->save();
        }

        $data_array = $request->except('avatar');
        $data_array['avatar'] = $$module_name_singular->avatar;
        $data_array['name'] = $request->first_name . ' ' . $request->last_name;

        // $user_profile = Userprofile::where('user_id', '=', $$module_name_singular->id)->first();
        // $user_profile->update($data_array);

        event(new UserProfileUpdated($user_profile));

        Flash::success('<i class="fas fa-check"></i> ' . label_case($module_name_singular) . ' Updated Successfully!')->important();

        Log::info(label_case($module_title . ' ' . $module_action) . ' | User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')');

        return redirect(route('backend.users.profile', $$module_name_singular->id));
    }

    /**
     * Show the form for Profile Paeg Editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeProfilePassword($id) {
        if (!Auth::user()->can('edit_users')) {
            $id = auth()->user()->id;
        }

        $title = $this->module_title;
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_name_singular = Str::singular($this->module_name);
        $module_icon = $this->module_icon;
        $module_action = 'Edit';

        $$module_name_singular = User::findOrFail($id);

        return view("backend.$module_name.changeProfilePassword", compact('module_name', 'module_title', "$module_name_singular", 'module_icon', 'module_action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeProfilePasswordUpdate(Request $request, $id) {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        if (!Auth::user()->can('edit_users')) {
            $id = auth()->user()->id;
        }

        $$module_name_singular = User::findOrFail($id);

        $request_data = $request->only('password');
        $request_data['password'] = Hash::make($request_data['password']);

        $$module_name_singular->update($request_data);

        Flash::success(icon() . " '" . Str::singular($module_title) . "' Updated Successfully")->important();

        return redirect("admin/$module_name/profile/$id");
    }

    /**
     * Show the form for Profile Paeg Editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword($id) {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Change Password';

        $page_heading = label_case($module_title);
        $title = $page_heading . ' ' . label_case($module_action);

        $user = $module_model::findOrFail($id);

        return view(
            "backend.users.changePassword",
            compact(
                'module_title',
                'module_name',
                'module_path',
                'module_icon',
                'module_action',
                'user',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePasswordUpdate(Request $request, $id) {
        $this->validate($request, [
            'password_baru' => 'required|min:6',
        ]);

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);


        $user = User::findOrFail($id);

        $request_data = $request->only('password_baru');
        $request_data['password_string'] = $request_data['password_baru'];
        $request_data['password'] = Hash::make($request_data['password_baru']);
        $user->update($request_data);

        Flash::success("<i class='fas fa-check'></i> '" . Str::singular($module_title) . "' Updated Successfully")->important();

        return redirect("admin/$module_name");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        if (!Auth::user()->can('edit_users')) {
            abort(404);
        }

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Edit';

        $$module_name_singular = $module_model::findOrFail($id);

        return view(
            "backend.$module_name.edit",
            compact(
                'module_title',
                'module_name',
                'module_path',
                'module_icon',
                'module_action',
                'module_name_singular',
                "$module_name_singular",
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if (!Auth::user()->can('edit_users')) {
            abort(404);
        }

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $$module_name_singular = User::findOrFail($id);

        $data = $request->except(['password', 'username']);
        $$module_name_singular->update($data);

        Flash::success("<i class='fas fa-check'></i> '" . Str::singular($module_title) . "' Updated Successfully")->important();

        Log::info(label_case($module_title . ' ' . $module_action) . " | '" . $$module_name_singular->name . '(ID:' . $$module_name_singular->id . ") ' by User:" . auth()->user()->name . '(ID:' . auth()->user()->id . ')');

        return redirect("admin/$module_name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'destroy';

        if (auth()->user()->id == $id) {
            Flash::warning("<i class='fas fa-exclamation-triangle'></i> You can not delete this user!")->important();

            Log::notice(label_case($module_title . ' ' . $module_action) . ' Failed | User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')');

            return redirect()->back();
        }

        $$module_name_singular = User::findOrFail($id);

        $$module_name_singular->delete();

        flash('<i class="fas fa-check"></i> ' . $$module_name_singular->name . ' User Successfully Deleted!')->success();

        Log::info(label_case($module_action) . " '$module_name': '" . $$module_name_singular->name . ', ID:' . $$module_name_singular->id . " ' by User:" . auth()->user()->name);

        return redirect("admin/$module_name");
    }
}
