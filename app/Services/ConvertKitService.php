<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Subscriber;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\ConvertKit;

class ConvertKitService
{
    protected string $apiSecret = '9pJriNRazfkYnamLcnW6yMeFQiXUhWAqJvhIUDJYBM4';

    // public function getSubscriberByEmail(string $email, string $first_name, string $birth_date, $random_number): void
    // {
    //     try {
    //         $response = Http::withHeaders([
    //             'Content-Type' => 'application/json',
    //         ])->post('https://api.convertkit.com/v3/forms/7916857/subscribe', [
    //             'api_key'    => 'XmW1yc0npFVnNdJAhX_NNA',
    //             'first_name' => ucfirst($first_name),
    //             'email'      => $email,
    //             'birth_date' => $birth_date,
    //             'fields'     => [
    //                 'transcript_url' => route('transcript', ['slug' => $random_number]),
    //             ],
    //         ]);

    //         if ($response->successful()) {
    //             $subscription = $response->json('subscription');

    //             if (!empty($subscription)) {
    //                 $subscriber = $subscription['subscriber'] ?? null;

    //                 // if ($subscriber) {
    //                 //     $this->saveSubscriber(
    //                 //         $subscriber['first_name'] ?? null,
    //                 //         $subscriber['email_address'] ?? $email,
    //                 //         $subscriber['state'] ?? null,
    //                 //         $subscriber['id'] ?? null,
    //                 //         $subscriber['created_at'] ?? null
    //                 //     );
    //                 // }
    //             }
    //         } else {
    //             Log::error('ConvertKit subscription failed.', [
    //                 'email' => $email,
    //                 'response' => $response->json(),
    //             ]);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('ConvertKit API Exception', ['error' => $e->getMessage()]);
    //     }
    // }
    public function getSubscriberByEmail($transcript) {
        try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://api.convertkit.com/v3/forms/7916857/subscribe', [
                    'api_key'     => 'XmW1yc0npFVnNdJAhX_NNA',
                    'first_name'  => ucfirst($transcript->first_name),
                    'email'       => $transcript->email,
                    'birth_date'  => $transcript->birth_date,
                    'fields'      => [
                        'transcript_url' => route('transcript', ['slug' => $transcript->random_number]),
                    ],
                ]);
                $formId=7916857;
                $payLoad = ['first_name' => $transcript->first_name, 'email' => $transcript->email, 'birth_date'  => $transcript->birth_date];
                $jsonPayload = json_encode($payLoad);

                if ($response->successful()) {
                    $subscription = $response->json(); // Decode the JSON response
                    Log::info("ConvertKit response: " . json_encode($subscription, JSON_PRETTY_PRINT)); // Encode for logging
                    $transcript->convert_kit_response = json_encode($subscription, JSON_PRETTY_PRINT);
                    $transcript->save();
                    $convertKitResponse = json_encode($subscription, JSON_PRETTY_PRINT);
                    if (!empty($convertKitResponse)) {
                        if ($convertKitResponse) {
                            $this->saveSubscriber($convertKitResponse, $transcript, $formId, $jsonPayload);
                        }
                    }
                } else {
                    $errorData = [
                        'email' => $transcript->email,
                        'status_code' => $response->status(), // Add the HTTP status code
                        'response_body' => $response->body(), // Include the raw response body
                        'response_json' => $response->json(), //attempt to get JSON
                    ];
                    Log::error('ConvertKit subscription failed.', $errorData);
                }
            } catch (\Exception $e) {
                Log::error('ConvertKit API Exception: ' . $e->getMessage(), [
                    'email' => $transcript->email, // Include email for context
                    'trace' => $e->getTraceAsString(), // Include stack trace
                ]);
            }
    }

    // protected function saveSubscriber($name, $email, $state, $subscriberId, $created): bool
    // {
    //     // return Subscriber::updateOrCreate(
    //     //     ['id' => $subscriberId],
    //     //     [
    //     //         'subscriber_id' => $subscriberId,
    //     //         'name' => $name,
    //     //         'email' => $email,
    //     //         'state' => $state,
    //     //         'created_at' => $created,
    //     //     ]
    //     // ) ? true : false;
    //     try {
    //         Log::info('insert subscriber info');
    //         DB::table('subscribers')->insert([
    //             'name' => $transcript->first_name ?? 'ABC',
    //             'email' => $transcript->email ?? $subscriberId.'@example.com',
    //             'state' => $state,
    //             'created_at' => $created,
    //         ]);
    //         return true;
    //     } catch (Exception $e) {
    //         return false;
    //     }
    // }
    public function saveSubscriber($convertKitResponse, $transcript, $formId, $jsonPayload)
    {
        try {
                $data = json_decode($convertKitResponse);
                $convertKitData = $data->subscription;
                $convertKit = new ConvertKit();
                $convertKit->transcript_id = $transcript->id;
                $convertKit->convert_kit_response = $convertKitResponse;
                $convertKit->subscription_id = $convertKitData->id;
                $convertKit->subscriber_id = $data->subscriber->id;
                $convertKit->payload = $jsonPayload;
                $convertKit->full_name = $transcript->full_name;
                $convertKit->email = $transcript->email;
                $convertKit->form_id = $formId;
                $convertKit->save();
                return true;
        }catch(Exception $e){
            Log::info("Convert Kit Store Error:". $e->getMessage().'in Line:' . $e->getLine());
            return false;
        }
    }
}
