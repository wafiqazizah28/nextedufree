<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;
use App\Models\SaranPekerjaan;
use App\Models\Artikel;
use App\Models\Rule;
use App\Models\Pertanyaan;
use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Support\Facades\Schema; // Tambahkan ini di atas
use Illuminate\Support\Facades\Log; // Import Log facade
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'hasilTes', 'artikel', 'tanyaJurpan', 'forwardChaining', 'forwardChainingGuest']);
    }

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
    
        return view('pages.tesminatmu', [
            "pertanyaanList" => $pertanyaanList,
            "jurusanList" => $jurusanList,
            "saranPekerjaan" => $saranPekerjaan,
            "artikelList" => $artikelList,
        ]);
    }
    
    public function artikel()
{
    $artikelList = Artikel::query(); // Query Builder
    $jurusanList = Jurusan::all(); 

    // Pastikan hanya mengurutkan berdasarkan kategori_id jika ada
    if (Schema::hasColumn('artikel', 'kategori_id')) {
        $artikelList->orderBy('kategori_id', 'asc');
    }

    // Filter berdasarkan pencarian jika ada request
    if (request('search')) {
        $artikelList->where('name', 'like', '%' . request('search') . '%');
    }

    return view('pages.artikelPage', [
        'artikelList' => $artikelList->paginate(perPage: 8)->withQueryString(),
        'jurusanList' => $jurusanList
    ]);
}

    
    
    
    public function about()
    {
        return view('pages.about');
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
        ]);
    }
    
    public function edit(int $id)
{
    $pertanyaanList = Pertanyaan::all();
    $rules = Rule::all();
    $jurusan = Jurusan::find($id); // Menggunakan Eloquent untuk mengambil satu jurusan

    if (!$jurusan) {
        return redirect()->back()->with('error', 'Jurusan tidak ditemukan!');
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
    HasilTes::create([
        'user_id' => $id,
        'hasil' => $result
    ]);
    
    return response()->json([
        'status' => 200,
        'redirect' => url('/hasiltes')
    ]);
}
public function hasilTes()
{
    $userId = auth()->id(); // Ambil ID user yang login
    $hasilTes = HasilTes::where('user_id', $userId)->latest()->first(); // Ambil hasil tes terbaru

    if (!$hasilTes) {
        return view('hasil_tes', ['hasilTes' => null]); // Kalau belum ada hasil tes
    }

    $jurusan = Jurusan::where('nama_jurusan', $hasilTes->hasil)->first(); // Cocokkan hasil tes dengan jurusan

    $saranPekerjaan = SaranPekerjaan::where('jurusan_id', $jurusan->id)->get(); // Ambil pekerjaan dari jurusan

    return view('hasil_tes', [
        'hasilTes' => $hasilTes,
        'jurusan' => $jurusan,
        'saranPekerjaan' => $saranPekerjaan
    ]);
}
}