<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Mockery\Generator\Method;
use  Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function __construct(){

        // $this->middleware('auth:admin');



        $this->middleware('permission:admins-read')->only('index');
        $this->middleware('permission:admins-create')->only('create');
        $this->middleware('permission:admins-update')->only(['update','edit']);
        $this->middleware('permission:admins-delete')->only(['destroy','usersTrashed']);
    }



    public function index(Request $request)
    {



//method4


$admins=Admin::whereRoleIs('admin')->when($request->search ,function($query)  use ($request){

    return $query->where('name','like','%'. $request->search .'%');




})->latest()->paginate(2);


        return view('admin.admins.index',compact('admins'));
    }


    public function create()
    {
        return view('admin.admins.create');
    }
    // public function show()
    // {
    //     // return view('admin.admins.create');
    // }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([



            'name'=>'required',
            'email'=>'required|email|unique:admins',
            'password'=>'required',
            'cpassword' => 'required|same:password',
            'image'        =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'


],[

'email.unique'=>'this email already existisin users table '

]);


try{

    $requestdata=$request->except(['password','cpassword','permissions','image']);
    $requestdata['password']=bcrypt($request->password);

    if($request->image){


        Image::make($request->image)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/user_images/'. $request->image->hashName()));

        $requestdata['image']= $request->image->hashName();
    }
    // dd($requestdata);

    $admin= Admin::create($requestdata);




    $admin->attachRole('admin');
    // dd($user->attachRole('admin'));
    $admin->syncPermissions($request->get('permissions'));





    return redirect()->route('admin.index')->with([

                                            'message' =>'you inserted data successfully',
                                            'alert-type' =>'success',
                                            'success' =>' data inserted successfully'

                                        ]);



}catch(\Exception $ex){


    return redirect()->route('admin.index')->with([

        'message' =>'there is fetal error please try again',
        'alert-type' =>'danger',
        'error' =>'there is fetal error please try again'

    ]);




}






    }



    public function edit(Admin $admin)
    {

        // $users=User::all();
        return view('admin.admins.edit',compact('admin'));
    }



    public function update(Request $request,Admin $admin )
    {
        $request->validate([



            'name'=>'required',
            'email'=>'required|email',

            'image'        =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'


],[

'email.unique'=>'this email already existisin users table '

]);

try{


        $requestdata=$request->except(['permissions','image']);



    if($request->image){


        if($admin->image != 'default.png'){

            Storage::disk('public_uploads')->delete('/user_images/'. $admin->image);


        }


        Image::make($request->image)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads/user_images/'. $request->image->hashName()));

        $requestdata['image']= $request->image->hashName();



    }

    $admin->update($requestdata);

    // $user->syncRoles($request->roles);
    $admin->syncPermissions($request->get('permissions'));


    return redirect()->route('admin.index')->with([

        'message' =>'your data updated successfully',
        'alert-type' =>'info',
        'success' =>' data updated successfully'
    ]);




}catch(\Exception $ex){

    return redirect()->route('admin.index')->with([

        'message' =>'your data  not updated try again',
        'alert-type' =>'danger',

        'error' =>'there is fetal error please try again'

    ]);

}



    }//end update


    public function destroy($id)
    {

        try{

            $admin=Admin::find($id);
            $admin->delete();
            return redirect()->back()->with([

                'message' =>'your data stored  in your trashedbin successfully',
                'alert-type' =>'warning',
                 'success' =>' data strored in trash bin successfully'
            ]);

        }catch(\Exception $ex){

            return redirect()->back()->with([

                'message' =>'your data stored  in your trashedbin successfully',
                'alert-type' =>'danger',
                'error' =>'there is fetal error please try again'
            ]);
        }

    }
    public function usersTrashed()
    {
        $admins=Admin::onlyTrashed()->orderBy('id','desc')->paginate(3);
        return view('admin.admins.trash')->with('admins',$admins);
    }
    public function restore($id)
    {

        try{

            $admin=Admin::onlyTrashed()->where('id',$id)->first();
            $admin->restore();
            return redirect()->route('admin.index')->with([

                                                'message' =>'your data restored successfully',
                                                'alert-type' =>'warning',
                                                'success' =>' data restrored  successfully'
                                            ]);

        }catch(\Exception $ex){
            return redirect()->route('admin.index')->with([

                'message' =>'your data  not restored try again',
                'alert-type' =>'danger',
                'error' =>'there is fetal error please try again'
            ]);

        }


    }
    public function hdelete($id)
    {

        try{

                $admin=Admin::withTrashed()->where('id',$id)->first();


        // $post=Postlw::whereId($id)->first();

        if($admin->image !='default.png'){

            Storage::disk('public_uploads')->delete('/user_images/'. $admin->image);
        }




        $admin->forceDelete();
        return redirect()->route('admin.index')->with([
            'message' =>'user deleted successfully',
            'alert-type' =>'success',
            'success' =>' data restrored  successfully'
          ]);

        }catch(\Exception $ex){

            return redirect()->route('admin.index')->with([
                'message' =>'user not deleted try again',
                'alert-type' =>'danger',
                'error' =>'there is fetal error please try again'
              ]);
        }


    }





    }
