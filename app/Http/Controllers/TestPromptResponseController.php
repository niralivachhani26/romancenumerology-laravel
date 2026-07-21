<?php

namespace App\Http\Controllers;

use App\Models\TestPromptResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\File;
use App\Models\TestPdfContentPromt;
use App\Jobs\GenerateTestSketchPdfContent;


class TestPromptResponseController extends Controller
{

    public function create() {
        return view('admin.test_prompts.sketch_create');
    }
    /**
     * Display a listing of the resource.
     */
   
    public function store(Request $request){
        try{
            $query =   <<<EOD
                        $request->prompt
                        EOD;

            $apiKey = env('STABILITY_API_KEY');
            $url = 'https://api.stability.ai/v2beta/stable-image/generate/ultra';
            // $url = 'https://api.stability.ai/v2beta/stable-image/generate/core';
            // $url = 'https://api.stability.ai/v2beta/stable-image/generate/sd3';

            $payload = [
                ['name' => 'prompt', 'contents' => $query],
                ['name' => 'output_format', 'contents' => 'webp'],
            ];
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'image/*',
            ])->asMultipart()->post($url, $payload);
            $imageUrl = $response->body();
             $imageData = $response->body();
                $filename = 'test-sketch/tss-' . uniqid() . '.webp';
                $directory = public_path('test-sketch');

                file_put_contents(public_path($filename), $imageData);

                 DB::table('test_sketch_prompts')->insert([
                    'image_path' => $filename,
                ]);
            return response()->json([
                'success' => true,
                'message' => 'Sketch generated successfully!',
                'image_path' => asset($filename), // This is the URL that the frontend will use
            ]);

        }catch(Exception $e) {
            Log::error($e->getMessage().'in line:'. $e->getLine());
            // return response()->json($e->getMessage().'in line:'. $e->getLine());
        }
    }

    //save sketch image into database using stability api
    protected static function saveImage($image_url){
        $fileName = time() . '-' . rand(0, 9999) . Str::random(4) . '.png';
        $savePath = public_path("/test-sketch/$fileName");
        // Initialize curl
        $ch = curl_init($image_url);
        // Set curl options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // Execute and get image data
        $imageData = curl_exec($ch);
        // Check for curl errors
        if(curl_errno($ch)){
            return [
                'status' => 2,
                'error' => curl_error($ch),
            ];
        }
        curl_close($ch);

        // Save the image
        file_put_contents($savePath, $imageData);
        return [
            'status' => 1,
            'filename' => $fileName,
            'savepath' => $savePath,
            'path' => '/test-sketch/'.$fileName,
        ];
    }
    //create pdf promt form
    public function createTestPdfContent(){
        $testPdfContent = TestPdfContentPromt::get();
        if(count($testPdfContent)==9) {
            return view('admin.test_prompts.test_pdf', compact('testPdfContent'));
        }
        return view('admin.test_prompts.test_pdf');
    }
    // save pdf content using through jb que
    public function storeTestPdfContent(Request $request) {
        try{
            $prompt = $request->prompt;
            $arrayPrompt = explode(',', $prompt);
            $arrayPrompt = array_map('trim', $arrayPrompt);
            TestPdfContentPromt::truncate();
            foreach($arrayPrompt as $k => $chapterRow) {
                $chapter = explode(':',$chapterRow);
                $chapter_key = $chapter[0];
                $chapter_title = $chapter[1];
                GenerateTestSketchPdfContent::dispatch($chapter_key, $chapter_title, 7);
            }
        }catch(Exception $e){
            return response()->json($e->getMessage().'error in line:'. $e->getLine());
        }

    }

    public function newPdfGeneration() {
           $solumatdata= TestPdfContentPromt::where('transcript_id',36)->get();
            $html = view('front.chat_gpt.newpdf',['solumatdata' => $solumatdata])->render();

            $mpdf = new \Mpdf\Mpdf([
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_top' => 10,       // No top margin on first page
                'margin_bottom' => 15,    // No bottom margin on first page
                'default_body_css' => 'margin:0; padding:0;',
                'format' => 'A4',
            ]);

            // Write the HTML content to the PDF
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->SetHTMLFooter('
                <div class="footer">
                    <div class="footer_items">
                        <table width="100%">
                            <tr>
                                <td width="33%"><p>{PAGENO}</p></td>
                                <td width="66%" style="text-align: right;"><p>Romance Numerology</p></td>
                            </tr>
                        </table>
                    </div>
                </div>');

            $mpdf->WriteHTML($html);
            return response($mpdf->Output('', 'S'))->header('Content-Type', 'application/pdf'); //s show PDF d Download pdf
    }
   }
