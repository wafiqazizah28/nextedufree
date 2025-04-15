<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\HasilTes;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;
use App\Models\SaranPekerjaan;
use App\Models\Artikel;
use App\Models\Rule;
use App\Models\Pertanyaan;
use App\Models\Testimoni;
use App\Models\Sekolah; // Tambahkan model Sekolah
use App\Models\User;
use Illuminate\Support\Facades\Schema; // Tambahkan ini di atas
use Illuminate\Support\Facades\Log; // Import Log facade
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;


class AppController extends Controller
{
    public function index()
    {
        $users = User::all();
        $jurusanList = Jurusan::all();
        $artikelList = Artikel::all();
        $hasilTes = HasilTes::all();
        $testimonis = Testimoni::with('user')->get();

        return view('pages.home', [
            'users' => $users,
            'jurusanList' => $jurusanList,
            'artikelList' => $artikelList,
            'hasilTes' => $hasilTes,
            'testimonis' => $testimonis // Kirim testimoni ke view
        ]);
    }
// In AppController.php
 

// Add this method to your AppController class
// In App\Http\Controllers\AppController.php

  

public function storeTestimoni(Request $request)
{
    // Debugging - log the request data
    \Log::info('Testimonial submission attempt', [
        'user_id' => Auth::id(),
        'hasil' => $request->hasil,
        'testimoni' => $request->testimoni
    ]);
    
    $request->validate([
        'testimoni' => 'required|string',
        'hasil' => 'required|exists:hasil_tes,id',
    ]);
    
    // Check if user already submitted a testimoni for this specific hasil
    $existingTestimoni = Testimoni::where('user_id', Auth::id())
                               ->where('hasil', $request->hasil)
                               ->first();
    
    if ($existingTestimoni) {
        return redirect()->back()->with('error', 'Anda sudah memberikan testimoni untuk hasil tes ini.');
    }
    
    try {
        // Create the testimoni record
        $testimoni = new Testimoni();
        $testimoni->user_id = Auth::id();
        $testimoni->hasil = $request->hasil;
        $testimoni->testimoni = $request->testimoni;
        $testimoni->save();
        
        return redirect()->back()->with('success', 'Testimoni berhasil dikirim');
    } catch (\Exception $e) {
        \Log::error('Testimoni Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    public function tanyaJurpan()
    {
        return view('pages.tanyaJurpan'); // Pastikan file Blade ini ada di resources/views/pages/
    }



    public function hasilTes()
    {
        
        $jurusanList = Jurusan::all();
        $pertanyaanList = Pertanyaan::all();
        $saranPekerjaan = SaranPekerjaan::all(); // Ganti dari "solutions"
        $artikelList = Artikel::all(); // Ganti dari "medicines"

        return view('pages.tesMinatmu', [
            "pertanyaanList" => $pertanyaanList,
            "jurusanList" => $jurusanList,
            "saranPekerjaan" => $saranPekerjaan,
            "artikelList" => $artikelList,
        ]);
    }

    public function filterByKategori(Request $request)
    {
        $kategoriId = $request->kategori;

        // Handle the 'all' case
        if ($kategoriId === 'all') {
            $artikelList = Artikel::all();
        } else {
            $artikelList = Artikel::where('kategori_id', $kategoriId)->get();
        }

        // Make sure we include all the necessary fields
        $artikelList = $artikelList->map(function ($artikel) {
            return [
                'id' => $artikel->id,
                'kategori_id' => $artikel->kategori_id,
                'judul' => $artikel->judul,
                'img' => $artikel->img, // Return the raw image path
                'sinopsis' => $artikel->sinopsis,
                'link' => $artikel->link, // Use the original link
                'created_at' => $artikel->created_at,
                'updated_at' => $artikel->updated_at
            ];
        });

        return response()->json($artikelList);
    }
    public function showDetail($id)
    {
        $hasilTes = HasilTes::with('user')->findOrFail($id);

        // Pastikan user hanya bisa melihat hasil tes miliknya sendiri
        // Pastikan user hanya bisa melihat hasil tes miliknya sendiri
        if (auth()->id() !== $hasilTes->user_id && auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke hasil tes ini.');
        }

        $jurusanList = Jurusan::all();
        $jurusan = null;

        foreach ($jurusanList as $j) {
            if (strtolower($j->jurusan) == strtolower($hasilTes->hasil)) {
                $jurusan = $j;
                break;
            }
        }

        $saranPekerjaanList = [];
        $sekolahList = [];

        if ($jurusan) {
            $saranPekerjaanList = SaranPekerjaan::where('jurusan_id', $jurusan->id)->get();
            $sekolahList = Sekolah::where('jurusan_id', $jurusan->id)->orderBy('nama', 'asc')->get();
        }

        return view('pages.hasilTes', [
            'testDetail' => $hasilTes,
            'jurusan' => $jurusan,
            'jurusanList' => $jurusanList,
            'saranPekerjaanList' => $saranPekerjaanList,
            'sekolahList' => $sekolahList
        ]);
    }
    public function artikel()
    {
        $artikelList = Artikel::query();
        $kategoriList = Kategori::all(); // Get all categories

        if (request('kategori') && request('kategori') !== 'all') {
            $artikelList->where('kategori_id', request('kategori'));
        }

        if (request('search')) {
            $artikelList->where('judul', 'like', '%' . request('search') . '%');
        }

        return view('pages.artikelPage', [
            'artikelList' => $artikelList->paginate(8)->withQueryString(),
            'kategoriList' => $kategoriList
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->query('query');

        if (!$query) {
            return response()->json([], 200);
        }

        $artikelList = Artikel::where('judul', 'like', "%$query%")
            ->orWhere('sinopsis', 'like', "%$query%")
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($artikelList);
    }
    public function logicRelation()
    {
        $jurusanList = Jurusan::all();
        $pertanyaanList = Pertanyaan::all();
        $rules = Rule::all();

        $jurusanRelation = [];

        foreach ($jurusanList as $index => $jurusan) {
            $jurusanRelation[$index] = [
                'id' => $jurusan->id,
                'name' => $jurusan->jurusan,
                'rules' => []
            ];

            foreach ($pertanyaanList as $pertanyaan) {
                $ruleValue = 0;

                foreach ($rules as $rule) {
                    if ($rule->pertanyaan_id == $pertanyaan->id && $rule->jurusan_id == $jurusan->id) {
                        $ruleValue = $rule->rule_value;
                        break;
                    }
                }

                $jurusanRelation[$index]['rules'][] = $ruleValue ?: 0;
            }
        }

        return view('components.admin.rules.view', [
            'jurusanRelations' => $jurusanRelation,
            'pertanyaanInfo' => $pertanyaanList,
            'jurusanInfo' => $jurusanList,
            'artikelInfo' => Artikel::all(),
            'usersInfo' => User::all()
        ]);
    }

    public function edit(int $id)
    {
        $pertanyaanList = Pertanyaan::all();
        $rules = Rule::all();
        $jurusan = Jurusan::find($id); // Menggunakan Eloquent untuk mengambil satu jurusan

        if (!$jurusan) {
            return redirect()->back()->with('error', 'Jurusan selinear dengan SMA!');
        }

        $jurusanDetail = [
            "id" => $jurusan->id,
            "jurusan_code" => $jurusan->jurusan_code,
            "name" => $jurusan->jurusan,
            "rules" => [],
        ];

        foreach ($pertanyaanList as $pertanyaan) {
            $rule = collect($rules)->firstWhere(fn($r) => $r->pertanyaan_id == $pertanyaan->id && $r->jurusan_id == $jurusan->id);
            $jurusanDetail['rules'][] = $rule->rule_value ?? 0;
        }

        return view('components.admin.rules.edit', [
            'jurusanDetail' => $jurusanDetail,
            'jurusanList' => Jurusan::all(), // Perbaiki nama variabel untuk daftar semua jurusan
            'pertanyaanList' => $pertanyaanList,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->data;

        foreach ($data as $item) {
            Rule::updateOrCreate(
                [
                    'jurusan_id' => $item['jurusanId'],
                    'pertanyaan_id' => $item['pertanyaanId'],
                ],
                [
                    'rule_value' => $item['value']
                ]
            );
        }

        return response()->json([
            'status' => 200,
            'message' => 'Rule base updated successfully',
        ], 200);
    }


    public function forwardChaining(Request $request, string $id)
    {
        $userData = $request->data;
        $rules = Rule::all();
        $jurusanList = Jurusan::all();
    
        // Sort user data by pertanyaanId for consistent comparison
        usort($userData, function ($a, $b) {
            return $a['pertanyaanId'] - $b['pertanyaanId'];
        });
    
        // Convert user data to associative array for easier lookup
        $userAnswers = [];
        foreach ($userData as $item) {
            $userAnswers[$item['pertanyaanId']] = $item['value'];
        }
    
        $result = 'Tidak Diketahui'; // Default result if no matching jurusan found
        $bestMatch = null;
        $highestMatchCount = 0;
    
        // Evaluate each jurusan separately
        foreach ($jurusanList as $jurusan) {
            // Get rules specific to this jurusan
            $jurusanRules = $rules->where('jurusan_id', $jurusan->id);
    
            if ($jurusanRules->isEmpty()) {
                continue; // Skip jurusan with no rules
            }
    
            $matchedRules = 0;
            $totalRules = $jurusanRules->count();
    
            // Check how many rules match with user data
            foreach ($jurusanRules as $rule) {
                $pertanyaanId = $rule->pertanyaan_id;
    
                // If user answered this question and the answer matches rule value
                if (isset($userAnswers[$pertanyaanId]) && $userAnswers[$pertanyaanId] == $rule->rule_value) {
                    $matchedRules++;
                }
            }
    
            // Calculate match percentage
            $matchPercentage = $totalRules > 0 ? ($matchedRules / $totalRules) * 100 : 0;
    
            // If all rules for this jurusan match (perfect match)
            if ($matchedRules == $totalRules && $totalRules > 0) {
                $result = $jurusan->jurusan;
                $bestMatch = $jurusan;
                break; // Found perfect match, no need to check other jurusan
            }
            // Track the best partial match (for fallback if no perfect match)
            elseif ($matchedRules > $highestMatchCount) {
                $highestMatchCount = $matchedRules;
                $bestMatch = $jurusan;
            }
        }
    
        // If no perfect match but we have a best match with over 70% matching rules
        if ($result == 'Tidak Diketahui' && $bestMatch && ($highestMatchCount / $rules->where('jurusan_id', $bestMatch->id)->count()) >= 0.7) {
            $result = $bestMatch->jurusan;
        }
    
        // Log the test result for debugging (optional)
        \Log::info("Forward Chaining result for user $id: $result");
    
        // Save test result to database
        $testResult = HasilTes::create([
            'user_id' => $id,
            'hasil' => $result
        ]);
    
        return response()->json([
            'status' => 200,
            'testId' => $testResult->id, // Add this line to return the test ID
            'redirect' => url('/hasiltes/' . $testResult->id) // Update redirect URL to include the test ID
        ]);
    }
}
