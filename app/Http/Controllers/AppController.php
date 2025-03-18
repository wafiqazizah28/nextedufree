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
    
        return view('pages.tesMinatmu', [
            "pertanyaanList" => $pertanyaanList,
            "jurusanList" => $jurusanList,
            "saranPekerjaan" => $saranPekerjaan,
            "artikelList" => $artikelList,
        ]);
    }
    
    public function artikel()
    {
        $artikelList = Artikel::orderBy('jurusan_id');
        $jurusanList = Jurusan::all();
    
        if (request('search')) {
            $artikelList->where('name', 'like', '%' . request('search') . '%');
        }
    
        return view('pages.artikelPage', [
            'artikelList' => $artikelList->paginate(8)->withQueryString(),
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
        $data = $request->data;
        $rules = Rule::all();
        $jurusanList = Jurusan::all(); // Ubah variabel agar lebih jelas
    
        usort($data, function ($a, $b) {
            return $a['pertanyaanId'] - $b['pertanyaanId'];
        });
    
        $result = 'salah jurusan';
    
        foreach ($jurusanList as $jurusan) {
            $test = [];
    
            // Ambil aturan yang sesuai dengan jurusan saat ini
            foreach ($rules as $rule) {
                if ($jurusan->id == $rule->jurusan_id) {
                    $test[] = [
                        'pertanyaanId' => $rule->pertanyaan_id,
                        'value' => $rule->rule_value
                    ];
                }
            }
    
            // Periksa apakah semua aturan cocok dengan data pengguna
            $stats = 'berhasil';
            for ($k = 0; $k < count($test); $k++) {
                if (
                    !isset($data[$k]) || // Hindari error jika indeks tidak ada
                    $test[$k]['pertanyaanId'] != $data[$k]['pertanyaanId'] ||
                    $test[$k]['value'] != $data[$k]['value']
                ) {
                    $stats = 'gagal';
                    break;
                }
            }
    
            if ($stats == 'berhasil') {
                $result = $jurusan->jurusan;
                break;
            }
        }
    
        // Simpan hasil tes
        HasilTes::create([
            'user_id' => $id,
            'hasil' => $result // Ganti 'result' dengan 'hasil' sesuai dengan nama kolom di database
        ]);
        
        return response()->json([
            'status' => 200,
            'user_id' => $id,
            'stats' => $stats,
            'result' => $result,
            'test' => $test,
            'data' => $data
        ], 200);
    }
    

}