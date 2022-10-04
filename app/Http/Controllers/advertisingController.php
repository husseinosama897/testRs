<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\advertising;
use App\Models\image;
use Illuminate\Support\Str;
class advertisingController extends Controller
{


public function index(){
  
    return view('advertising.index');
}

    public function create(){
      
        return view('advertising.create');
    }


    public function add(request $request){
        $this->validate($request,[
        'name'=>['required','string','max:255'],
        'from'=>['required','date'],
        'to'=>['required','date'],
         'total'=>['numeric'],
           'daily_budget'=>['numeric'],

        ]);

        $advertising = advertising::create([
            'name'=>$request->name,
            'from'=>$request->from,
            'to'=>$request->to,
             'total'=>$request->total,
               'daily_budget'=>$request->daily_budget,
    
        ]);


 if($request->count > 0){
    for($counter = 0;  $counter <= $request->count;  $counter++){
     
        $img = 'files-'.$counter;  // counting files that's makes us handel many files
        
          if($request->$img){  // we checking up here if this request is exist already 
            $image_tmp = $request->$img;  // here we calling file number 1 or 2 or 3 
            $fileName = $image_tmp->getClientOriginalExtension().''.Str::random(20); // rename image 
           
            $image_tmp->move('uploads/advertising', $fileName); // moving file 
   
      $files[] = [
                   'advertising_id'=>$advertising->id,
                   'img'=>$fileName,
                  ];
        ++$counter;
        }else{
          $fileName = null;
        
        }
   
   
      }
   
      $chunking_image = array_chunk($files, 3); // here we chunking rows thats make  us got lowest cost   

      if(!empty($chunking_image)){
          foreach($chunking_image as $chunk){
            image::insert($chunk);
          }
             }
             
   }

    }

    public function JsonListAdvertising(){
        $advertising = advertising::paginate(10);
        return response()->json(['data'=>$advertising]);
    }

    public function edit(advertising $advertising){
        $image = $advertising->image;

        return view('advertising.edit')->with('advertising',$advertising);
    }

    public function update(request $request){


        $advertising->update([
            'name'=>$request->name,
            'from'=>$request->from,
            'to'=>$request->to,
             'total'=>$request->total,
               'daily_budget'=>$request->daily_budget,
    
        ]);


        if($request->count > 0){
            for($counter = 0;  $counter <= $request->count;  $counter++){
             
                $img = 'files-'.$counter;  // counting files that's makes us handel many files
                
                  if($request->$img){  // we checking up here if this request is exist already 
                    $image_tmp = $request->$img;  // here we calling file number 1 or 2 or 3 
                    $fileName = $image_tmp->getClientOriginalExtension().''.Str::random(20); // rename image 
                   
                    $image_tmp->move('uploads/advertising', $fileName); // moving file 
           
              $files[] = [
                           'advertising_id'=>$advertising->id,
                           'img'=>$fileName,
                          ];
                ++$counter;
                }else{
                  $fileName = null;
                
                }
           
           
              }
           
              $chunking_image = array_chunk($files, 3); // here we chunking rows thats make  us got lowest cost   
        
              if(!empty($chunking_image)){
                  foreach($chunking_image as $chunk){
                    image::insert($chunk);
                  }
                     }
                     
           }

           

    }

    public function CallingImage(advertising $advertising){

        $data = $advertising->image;
        return response()->json(['data'=>$data]);

    }

    public function delete(advertising $advertising){
        $advertising->delete();
    }

}
