<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lang;
use App\Http\Requests\LangRequest;

class LangController extends Controller
{
    public function index()
    {

       $langs = Lang::selection()->paginate(PAGINATION_COUNT);
return view('admin.langs.index',compact('langs'));

        
    }

    public function create()
    {

      
return view('admin.langs.create');

        
    }

    public function store(LangRequest $request)
    {

    try{

        if(!$request->has('active')){

            $request->request->add(['active' => 0]);
           }
        
        Lang::create($request->except(['_token']));

        return redirect()->route('admin.lang')->with(['success'=>'data inserted successfuly']);

    }catch(\Exception $ex){

        return redirect()->route('admin.lang')->with(['error'=>'there is fetal error please try again']);
        


        
    }
      
        
    }

    public function edit($id)
    {

 $lang =Lang::selection()->find($id);

 if(!$lang){

    return redirect()->route('admin.lang')->with(['error'=>' this lang doesnt exist']);
 }

 return view('admin.langs.edit',compact('lang'));
        
    }

    public function update(LangRequest $request,$id)
    {

    try{
       $lang= Lang::find($id);
       if(!$lang){

        return redirect()->route('admin.lang.edit',$id)->with(['error'=>' this lang doesnt exist']);
       }

       if(!$request->has('active')){

        $request->request->add(['active' => 0]);
       }
        $lang->update($request->except(['_token']));

        return redirect()->route('admin.lang')->with(['success'=>'data updated successfuly']);

    }catch(\Exception $ex){

        return redirect()->route('admin.lang')->with(['error'=>'there is fetal error please try again']);
        


        
    }
      
        
    }

    public function destroy($id){

        try{
            $lang= Lang::find($id);
            if(!$lang){
     
             return redirect()->route('admin.lang.edit',$id)->with(['error'=>' this lang doesnt exist']);
            }
     
           
             $lang->delete();
     
             return redirect()->route('admin.lang')->with(['success'=>'data deleted successfuly']);
     
         }catch(\Exception $ex){
     
             return redirect()->route('admin.lang')->with(['error'=>'there is fetal error please try again']);
             
     
     
             
         }
        
    }

    
}