<?php

namespace App\Http\Controllers;

use App\Models\ConvertKit;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transcript;
use Exception;
use App\Services\ConvertKitService;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //      $orders = Order::with('getTranscript')->paginate(10);
    //     return view('admin.orders.index', compact('orders'));
    // }
    public function index(Request $request){


        if($request->ajax()){
            $settings = Order::select(
                    'orders.id',
                    'orders.order_no',
                    'orders.product',
                    'transcripts.full_name as name',
                    'transcripts.email',
                    'transcripts.bod',
                    'orders.status',
                    // 'transcript.custom_gender',
                    'transcripts.custom_gender_interest',
                    'transcripts.image_path',
                    'transcripts.pdf_url',
                    'orders.payment_gateway'

                )
                ->join('transcripts', 'orders.transcript_id', '=', 'transcripts.id')
                ->get();


            $response = [
                "draw" => 1,
                "recordsTotal" => count($settings),
                "recordsFiltered" => count($settings),
                "data" => $settings,
            ];
            return response()->json($response, 200);
        }
       $orders = Order::select(
                    'orders.id',
                    'orders.order_no',
                    'orders.product',
                    'transcripts.full_name as name',
                    'transcripts.email',
                    'transcripts.bod',
                    'orders.status',
                    // 'transcript.custom_gender',
                    'transcripts.custom_gender_interest',
                    'transcripts.image_path',
                    'transcripts.pdf_url',
                    'orders.payment_gateway'

                )
                ->join('transcripts', 'orders.transcript_id', '=', 'transcripts.id')
                ->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ConvertKitService  $convertKit)
    {
        try{
            $orderNo = 'ORD'. time();
            $transcriptId = session('transcript_id');
            $transcript = Transcript::find($transcriptId);
            // $subscription = json_decode($transcript->convert_kit_response);
            // $subscription->subscription;
            //check order for this user
            $userOrder = Order::where('transcript_id', $transcriptId)->first() ;
            if($userOrder){
                return redirect()->route('getSoulmateNumber')->withSuccess('Order already Exist Order No:'. $userOrder->order_no);
            }
            /**
             * send data to convert kit
            */
            $convertKit->getSubscriberByEmail($transcript);
            //first generate sketch according to selected product
            $sketchGen= new Front\HomeController();
            if($request->sketch == 'black&white'){
                $sketchGen->sketchgenerator($transcript);
            } elseif($request->sketch == 'color') {
                $sketchGen->sketchgeneratorcolor($transcript);
            } elseif($request->sketch == 'background') {
                $sketchGen->sketchgeneratorbackgroundcolor($transcript);
            }
            $pdfGen= new Front\HomeController();
            $pdfGen->savePdfContent($transcript);
            $order = new Order();
            $order->transcript_id = $transcriptId;
            $order->order_no = $orderNo;
            $order->product =   $request->sketch;
            $order->payment_gateway = 'clickbank';
            $order->save();

            $message = 'Order created successfully!';
            return view('front.subscriberPages.thankyou', compact('order','message'));
            // return redirect()->route('getSoulmateNumber')->withSuccess('Order created successfully');
            // return response()->json(['success' => true, 'data' => $order, 'message'=> 'Order created successfully']);
        }catch(Exception $e) {
            return response()->json('Error:'.$e->getMessage().'line:'.$e->getLine());
        }
    }

    /**
     * Display the specified resource.
     */
    public function subscriberLogin()
    {
        return view('front.subscriberPages.login');
    }
    /**
     * Display Subscriber product
     */
    public function subscriberProduct(Request $request) {
        //validate here
        $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'regex:' . $emailRegex], // Using the regex rule
        ], [
            // Custom error message for the regex rule
            'email.regex' => 'Please enter a valid email address (e.g., user@example.com).',
            'email.required' => 'The email field is required.',
        ]);

        if ($validator->fails()) {
            // Redirect back with the errors and old input
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $transcript = Transcript::where('email', $request->email)->orderByDesc('id')->first();
        if(!$transcript) {
             return redirect()->back()
                             ->withErrors("Email doesn't exist in our database.")
                             ->withInput();
        }
        $order = Order::where('transcript_id', $transcript->id)->first();
        $updatedAt = $order->updated_at;
        // Calculate the expiry time by adding 10 minutes to updated_at
        $accessTime = $updatedAt->addMinutes(10);
        // Get the current time
        $now = Carbon::now();
        $canAccessProduct = $now->greaterThanOrEqualTo($accessTime);
        $isPaid = ($order->status == 'success') ? true : false;
        $isPaid = true;
        $sketchProducts = config('constants.sketch');
        $productName = $sketchProducts[$order->product];
        return view('front.subscriberPages.product', compact('transcript','order', 'isPaid', 'productName', 'canAccessProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
