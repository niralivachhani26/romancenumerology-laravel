<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\GptPromptPdfContent;
use Illuminate\Support\Facades\Log;

class GenerateSoulSketchPdfContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $chapterKey;
    protected $chapterTitle;
    protected $soulmateNumber;
    protected $transcriptId;
    /**
     * Create a new job instance.
     *
     * @param string $chapterKey
     * @param string $chapterTitle
     * @param int $soulmateNumber // Add this if it's dynamic
     * @return void
     */
    public function __construct($chapterKey, $chapterTitle, $soulmateNumber = 7, $transcriptId)
    {
        $this->chapterKey = $chapterKey;
        $this->chapterTitle = $chapterTitle;
        $this->soulmateNumber = $soulmateNumber;
        $this->transcriptId = $transcriptId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         try {
            $query = "
                You are a Love Numerology Psychic and Professional Relationship Writer with deep spiritual insight and a refined, emotionally intelligent writing style. You specialize in numerological soulmate readings.

                Please write a 500-word chapter for a Soulmate Number {$this->soulmateNumber} eBook. The tone should be soulful, warm, educational, and intuitive. Use storytelling, emotional depth, spiritual insight, and relationship wisdom.

                Chapter Title: \"{$this->chapterTitle}\"

                Begin the chapter content now:
            ";

            // It's highly recommended to store your API key in your .env file
            // and access it via config('services.openai.key')
            $response = Http::withToken(env('OPENAI_API_KEY_CHAT'))->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $query,
                    ]
                ],
                'max_tokens' => 2000, // 500 words ≈ 1500–2000 tokens
                'temperature' => 0.7,
            ]);

            // Check for API errors
            if ($response->failed()) {
                Log::error("OpenAI API error for chapter '{$this->chapterTitle}': " . $response->body());
                // You might want to re-throw an exception or handle it differently
                return;
            }

            $gpt_data = $response->json(); // Directly get JSON as array
            $content = $gpt_data['choices'][0]['message']['content'] ?? null;

            if ($content) {
                // Save to DB
                $soulSketchPdfContent = new GptPromptPdfContent();
                $soulSketchPdfContent->transcript_id = $this->transcriptId;
                $soulSketchPdfContent->number = $this->soulmateNumber;
                $soulSketchPdfContent->chapter = $this->chapterTitle;
                $soulSketchPdfContent->description = $content;
                $soulSketchPdfContent->save();
            } else {
                Log::warning("No content received from OpenAI for chapter: {$this->chapterTitle}");
            }

        } catch (\Exception $e) {
            Log::info("$this->transcriptId");
            Log::error("Error generating or saving chapter '{$this->chapterTitle}': " . $e->getMessage() . ' in line: ' . $e->getLine());
            // Optionally, release the job back to the queue for retry:
            // $this->release(60); // Release back to queue in 60 seconds
        }
    }
}
