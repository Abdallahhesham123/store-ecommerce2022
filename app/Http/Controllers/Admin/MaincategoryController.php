<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MainCatRequest;
// use  Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MaincategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $default_lang =get_default_lang();
        $cats=MainCat::where('trans_lang',$default_lang)->selection()->get();

        return view('admin.maincategory.index',compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.maincategory.create');
    }


    public function store(MainCatRequest $request)
    {
    //   dd($request->image);


    try{
    $main_cat = collect($request->category);
    $filter = $main_cat ->filter(function($value,$key){

        return $value['abbr']==get_default_lang();


    });

    $default_cat = array_values($filter->all())[0]; // to not return index of array

    $filepath="";
    if($request->has('image')){


        $filepath =uploadImage('maincategories',$request->image);

    }

    DB::beginTransaction();
   $default_cat_id =MainCat::insertGetId([

        'trans_lang' => $default_cat['abbr'],
        'trans_of'=>0,
        'name'=>$default_cat['name'],
        'slug'=>$default_cat['name'],
        'image'=>$filepath
    ]);



            $cats_remain = $main_cat ->filter(function($value,$key){

        return $value['abbr'] !=get_default_lang();


    });

                if(isset($cats_remain) && $cats_remain->count()){


                    $cat_remain_array=[];
                    foreach($cats_remain as $cat_remain){
                        $cat_remain_array[]=[

                            'trans_lang' => $cat_remain['abbr'],
                            'trans_of'=>$default_cat_id,
                            'name'=>$cat_remain['name'],
                            'slug'=>$cat_remain['name'],
                            'image'=>$filepath

                        ];



                    }

                         MainCat::insert($cat_remain_array);



                                                            }
                DB::commit();

      return redirect()->route('admin.maincat')->with(['success'=>'data inserted successfuly']);


}catch(\Exception $ex){
    DB::rollback();

    return redirect()->route('admin.maincat')->with(['error'=>'there is fetal error please try again']);

}





    }


    public function edit($id)
    {

        //get spacific categories with this translation and its translation
       $maincat= MainCat::with('category')->selection()->find($id);

       if(!$maincat){

         return redirect()->route('admin.maincat')->with(['error'=>'this part not found please try again']);

       }

       return view('admin.maincategory.edit',compact('maincat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MainCatRequest $request, $id)
    {



        try{

            $maincat= MainCat::find($id);
            if(!$maincat){
             return redirect()->route('admin.maincat')->with(['error'=>'this part not found please try again']);
            }

           $category= array_values($request->category)[0];

        //    return  $request->active;

           if(!$request->has('category.0.active')){

            //    return  $request->active;

             $request->request->add(['active' => 0]);
            }else{

             $request->request->add(['active' => 1]);
            }

            //save image


// return  $request->active;

                 MainCat::where('id',$id)->update([



                         'name'=>$category['name'],
                         'active'=>$request->active,
                        //  'image'=>$filepath,


                 ]);



                 if($request->has('image')){


                    if($request->image != 'cat.png'){

                        // return Str::after($request->image, '\tmp');

                        // return  app_path($request->image) ;
                        // unlink($image);//delete from folder


                    }



                  $filepath =uploadImage('maincategories',$request->image);


                  MainCat::where('id',$id)->update([

                    'image'=>$filepath,


            ]);


              }

     return redirect()->route('admin.maincat')->with(['success'=>'data updated successfully']);

        }catch(\Exception $ex){

            return redirect()->route('admin.maincat')->with(['error'=>'fetal error occur y again']);

        }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}