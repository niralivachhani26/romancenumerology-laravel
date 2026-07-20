<?php

namespace App\Http\Controllers;

use App\Models\Transcript;
use Illuminate\Http\Request;
use App\Services\ConvertKitService;
use Illuminate\Support\Facades\Log;

class TranscriptController extends Controller
{

    public function savedata( Request $request, ConvertKitService $convertKit){

        $transcript = new Transcript();
        $transcript->first_name = request('first_name');
        $transcript->full_name = request('full_name');
        $transcript->bod = request('bod');
        $transcript->love_path_number = request('love_path_number') ?? 1;
        $transcript->heart_desier_number = request('heart_desier_number') ?? 1;
        $transcript->love_Desire_number = request('love_Desire_number') ?? 1;
        $transcript->random_number = rand(100000, 999999) . now()->format('YmdHis');
        $transcript->email = request('email');
        $transcript->custom_gender = request('custom_gender');
        $transcript->custom_gender_interest = request('custom_gender_interest');
        $transcript->custom_ethencity = request('custom_ethencity');
        // $convertKit->getSubscriberByEmail($request->email, request('first_name') , request('bod') ,$transcript->random_number);
        $transcript->status = 1;
        $transcript->save();
            // $convertKit->getSubscriberByEmail($transcript);
            Log::info('transcript data:'. json_encode($transcript));
        //send to generate sketch
        // $sketchGen= new Front\HomeController();
        // $sketchGen->sketchgenerator($transcript);
        session(['name' => $transcript->first_name]);
        session(['transcript_id' => $transcript->id]);
        if($transcript){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'error']);
        }
    }

    public function transcript($slug){
        $transcript = Transcript::where('random_number', $slug)->first();
        if($transcript){
            return view('front.transcript.index', compact('transcript'));
        }else{
            abort(404);
        }
    }
}
