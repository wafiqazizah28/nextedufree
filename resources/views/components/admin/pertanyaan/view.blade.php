@extends('pages.adminDashboard')

@section('content')
  <div class="flex justify-between items-center mb-4">
    <button class="rounded-lg bg-purpleMain py-2.5 px-5 text-white hover:bg-purple-800 transition-all duration-300 focus:ring-2 focus:ring-purple-300 ">
      <a href="/pertanyaan/create" class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Data
      </a>
    </button>

    <button id="exportPDF" class="rounded-lg bg-[#226847] py-2.5 px-5 text-white transition-all duration-300 focus:ring-2 focus:ring-red-300 ">
      <div class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        Export PDF
      </div>
    </button>
  </div>

  <div class="w-full bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
    <div class="p-6">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
        <h1 class="text-2xl font-semibold text-purpleMain mb-4 md:mb-0">Tabel Data Pertanyaan</h1>
        <form action="/pertanyaan" method="get" class="w-full md:w-auto">
          <div class="flex">
            <input type="text" id="search" name="search" placeholder="Cari pertanyaan"
              class="rounded-l-lg border border-gray-300 bg-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purpleMain" />
            <button type="submit"
              class="rounded-r-lg bg-purpleMain px-4 py-2 text-white hover:bg-purple-800 transition-all duration-300">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </div>
        </form>
      </div>

      @if ($pertanyaanList->count())
        <div class="overflow-x-auto">
          <table id="pertanyaanTable" class="w-full min-w-full border border-gray-300">
           
            <thead class="bg-purpleMain text-white">
              <tr>
                <th class="px-6 py-3 text-left  tracking-wider border border-gray-300">No</th>
                <th class="px-6 py-3 text-left tracking-wider border border-gray-300">Kode Pertanyaan</th>
                <th class="px-6 py-3 text-left  tracking-wider border border-gray-300">Pertanyaan</th>
                <th class="px-6 py-3 text-center   tracking-wider border border-gray-300">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($pertanyaanList as $pertanyaan)
                <tr class="hover:bg-gray-50">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 border border-gray-300">
                    {{ $loop->iteration }}
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-700 border border-gray-300">
                    {{ $pertanyaan->pertanyaan_code }}
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-700 border border-gray-300">
                    {{ $pertanyaan->pertanyaan }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium border border-gray-300">
                    <div class="flex justify-center space-x-2">
                      <a href="/pertanyaan/{{ $pertanyaan->id }}/edit" class="text-purpleMain hover:text-purple-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </a>
                      <form action="/pertanyaan/{{ $pertanyaan->id }}" method="post" onsubmit="return confirm('Kamu Yakin?')" class="inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                          </svg>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
            
          </table>
        </div>

        <div class="mt-4">
          {{ $pertanyaanList->links() }}
        </div>
      @else
        <div class="bg-white p-6 text-center rounded-lg border border-gray-200">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada pertanyaan.</h3>
          <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan pertanyaan baru.</p>
        </div>
      @endif
    </div>
  </div>

  <!-- Tambahkan script jsPDF untuk export PDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
  
  <script>
  document.addEventListener('DOMContentLoaded', function() {
  // Setup PDF export button
  document.getElementById('exportPDF').addEventListener('click', function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    
    // Add title
    doc.setFontSize(18);
    doc.text('Data Pertanyaan NextEdu', 14, 22);
    
    // Add timestamp
    doc.setFontSize(10);
    const now = new Date();
    const dateString = now.toLocaleDateString('id-ID', { 
      day: 'numeric', 
      month: 'long', 
      year: 'numeric' 
    });
    doc.text(`Diekspor pada: ${dateString}`, 14, 30);
    
    // Fetch all data using AJAX instead of just getting what's on the page
    fetch('/api/pertanyaan/all')
      .then(response => response.json())
      .then(data => {
        // Create table data
        const tableData = [];
        const tableHeaders = ['No', 'Kode Pertanyaan', 'Pertanyaan'];
        
        // Process all data
        data.forEach((item, index) => {
          tableData.push([
            (index + 1).toString(),
            item.pertanyaan_code,
            item.pertanyaan
          ]);
        });
        
        // Generate table
        doc.autoTable({
          head: [tableHeaders],
          body: tableData,
          startY: 35,
          styles: {
            fontSize: 10,
            cellPadding: 3
          },
          headStyles: {
            fillColor: [87, 73, 195],
            textColor: [255, 255, 255],
            fontStyle: 'bold'
          },
          alternateRowStyles: {
            fillColor: [240, 240, 240]
          }
        });
        
        // Add footer with page numbers
        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
          doc.setPage(i);
          doc.setFontSize(10);
          doc.text(`Halaman ${i} dari ${pageCount}`, doc.internal.pageSize.width / 2, doc.internal.pageSize.height - 10, { align: 'center' });
        }
        
        // Save the PDF
        doc.save('data-pertanyaan.pdf');
      })
      .catch(error => {
        console.error('Error fetching data:', error);
        alert('Terjadi kesalahan saat mengambil data.');
      });
  });
});
  </script>
@endsection