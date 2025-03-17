<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GenerativeAIService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.genai.api_key');
    }

    public function generateText($prompt)
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$this->apiKey}";
    
        // Modifikasi prompt agar hanya menjawab tentang jurusan
        $modifiedPrompt = "Jawablah hanya jika pertanyaannya berkaitan dengan pemilihan jurusan atau bidang studi pendidikan. 
        Jika pertanyaannya tidak relevan, katakan 'Maaf, Jurpan hanya bisa menjawab pertanyaan seputar jurusan.'. 
        Pertanyaan: " . $prompt;
    
        $response = Http::post($url, [
            'contents' => [['parts' => [['text' => $modifiedPrompt]]]]
        ]);
    
        return $response->json();
    }
    
}
