<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class APIController extends Controller
{
    function getData($id=null){
        if($id===null){
            return Hospital::all();
        }
        else{
            return Hospital::find($id);
        }
    }

    function addHospital(Request $request){
        $hospital=new Hospital;
        $hospital->hospital_name=$request->hospital_name;
        $hospital->phone=$request->phone;
        $hospital->address=$request->address;
        $hospital->since=$request->since;
        $hospital->bond_of=$request->bond_of;
        $result=$hospital->save();
        if($result){
            return ['Result'=>'Data Stored'];
        }
        else{
            return ['Result'=>'Failed'];
        }

        // try {
        //     $result = $hospital->save();
        //     if ($result) {
        //         return ['Result'=>'Data Has Received'];
        //     } else {
        //         return ['Result'=>'Operation Failed'];
        //     }
        // } catch (\Exception $e) {
        //    return response()->json(['Error'=>$e]);
        // }
    }

    function deleteHospital($id){
        $hospital=Hospital::find($id);
        $result=$hospital->delete();
        if($result){
            return ['Result'=>'Record deleted ',$id];
        }
        else{
            return ['Result'=>'Record not Found ',$id];
        }
    }

    function searchHospital($hospital_name){
        return Hospital::where('hospital_name','like','%'.$hospital_name.'%')->get();
    }

    function updateHospital(Request $req){
        $hospital=Hospital::find($req->id);
        $hospital->hospital_name=$req->hospital_name;
        $hospital->phone=$req->phone;
        $hospital->address=$req->address;
        $hospital->since=$req->since;
        $hospital->bond_of=$req->bond_of;
        $result=$hospital->save();
        if($result){
            return ['Result'=>'Data Updated'];
        }
        else{
            return ['Result'=>'Failed'];
        }
    }
}
