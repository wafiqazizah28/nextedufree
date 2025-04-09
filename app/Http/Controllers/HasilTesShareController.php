<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
use App\Models\Jurusan;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class HasilTesShareController extends Controller
{
    /**
     * Generate a shareable image for the test result
     *
     * @param HasilTes $hasilTes
     * @return JsonResponse
     */
    public function generateShareImage(HasilTes $hasilTes): JsonResponse
    {
        try {
            // Find related jurusan
            $jurusan = Jurusan::where('jurusan', $hasilTes->hasil)->first();
            
            // Create a blank canvas (1080x1080 is ideal for Instagram)
            $img = Image::canvas(1080, 1080, '#ffffff');
            
            // Add gradient background
            $img->rectangle(0, 0, 1080, 1080, function ($draw) {
                $draw->gradient('#8a2be2', '#4169e1', 'diagonal');
                $draw->fill(true);
            });
            
            // Add semi-transparent overlay for better text readability
            $img->rectangle(50, 50, 1030, 1030, function ($draw) {
                $draw->background('rgba(255, 255, 255, 0.85)');
                $draw->fill(true);
            });
            
            // Add logo/watermark at the top
            $logoPath = public_path('images/logo.png'); // Make sure to have a logo image
            if (file_exists($logoPath)) {
                $logo = Image::make($logoPath)->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->insert($logo, 'top', 0, 80);
            }
            
            // Add decorative elements (consider adding these to your assets)
            $elementPath = public_path('images/decoration.png');
            if (file_exists($elementPath)) {
                $element = Image::make($elementPath)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->insert($element, 'bottom-right', 50, 50);
            }
            
            // Add jurusan image if available
            if ($jurusan && $jurusan->gambar) {
                $jurusanImagePath = storage_path('app/public/' . $jurusan->gambar);
                if (file_exists($jurusanImagePath)) {
                    $jurusanImg = Image::make($jurusanImagePath)->resize(250, 250, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->insert($jurusanImg, 'top', 0, 200);
                }
            }
            
            // Add headline text
            $img->text('HASIL TES JURUSAN', 540, 400, function ($font) {
                $font->file(public_path('fonts/Poppins-Bold.ttf')); // Make sure to have this font
                $font->size(60);
                $font->color('#333333');
                $font->align('center');
            });
            
            // Add result text (larger and highlighted)
            $img->text($hasilTes->hasil, 540, 500, function ($font) {
                $font->file(public_path('fonts/Poppins-ExtraBold.ttf'));
                $font->size(80);
                $font->color('#8a2be2');
                $font->align('center');
            });
            
            // Add description if available
            if ($jurusan && $jurusan->deskripsi) {
                // Wrap text to fit within the image
                $description = wordwrap($jurusan->deskripsi, 60, "\n", true);
                $lines = explode("\n", $description);
                
                // Limit to 4 lines and add ellipsis if longer
                if (count($lines) > 4) {
                    $lines = array_slice($lines, 0, 4);
                    $lines[3] = $lines[3] . '...';
                }
                
                $description = implode("\n", $lines);
                
                $img->text($description, 540, 620, function ($font) {
                    $font->file(public_path('fonts/Poppins-Regular.ttf'));
                    $font->size(30);
                    $font->color('#555555');
                    $font->align('center');
                    $font->valign('top');
                });
            }
            
            // Add call to action
            $img->text('Temukan jurusan terbaikmu di:', 540, 900, function ($font) {
                $font->file(public_path('fonts/Poppins-SemiBold.ttf'));
                $font->size(30);
                $font->color('#333333');
                $font->align('center');
            });
            
            // Add website URL
            $img->text(config('app.url'), 540, 950, function ($font) {
                $font->file(public_path('fonts/Poppins-Bold.ttf'));
                $font->size(40);
                $font->color('#8a2be2');
                $font->align('center');
            });
            
            // Save the image to a temporary file - save as PNG instead of JPG
            $filename = 'hasil_tes_' . $hasilTes->id . '_' . time() . '.png';
            $path = 'public/share_images/' . $filename;
            Storage::put($path, $img->encode('png'));
            
            // Return success response with image URL
            return response()->json([
                'success' => true,
                'imageUrl' => Storage::url($path)
            ]);
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}