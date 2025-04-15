@extends('pages.adminDashboard')

@section('content')
<div class="w-full mx-auto p-2">
  <div class="bg-white rounded border border-[#BBBBBB] shadow-sm">
    <div class="p-3 border-b">
      <h1 class="font-medium text-lg text-slate-800">Data Tabel</h1>
    </div>

    <div class="bg-white relative">
      @if (count($jurusanRelations ?? []))
        <div class="overflow-x-scroll custom-scrollbar" style="width: 100%;">
          <table style="min-width: 100%; table-layout: auto;">
            <thead>
              <tr class="bg-indigo-700 text-white">
                <th class="sticky left-0 z-20 bg-indigo-700 w-16 px-2 py-2 text-center text-sm border-r border-indigo-600">Kode</th>
                <th class="sticky left-16 z-20 bg-indigo-700 w-48 px-2 py-2 text-left text-sm border-r border-indigo-600">Nama Jurusan</th>
                @foreach ($pertanyaanInfo as $pertanyaan)
                  <th class="whitespace-nowrap w-12 px-1 py-2 text-center text-sm border-r border-indigo-600">{{ $pertanyaan['pertanyaan_code'] }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach ($jurusanRelations as $jurusan)
                <tr class="border-b hover:bg-gray-50">
                  <td class="sticky left-0 z-10 bg-white w-16 px-2 py-3 text-center text-sm border-r">{{ $jurusan['id'] }}</td>
                  <td class="sticky left-16 z-10 bg-white w-48 px-2 py-3 text-left text-sm border-r whitespace-normal">{{ $jurusan['name'] }}</td>
                  @foreach ($jurusan['rules'] as $rule)
                    <td class="px-1 py-3 text-center text-sm border-r">{{ $rule ? '✓' : '-' }}</td>
                  @endforeach
                  <td class="px-2 py-3 text-center">
                    <a href="/rules/{{ $jurusan['id'] }}/edit" class="inline-block text-indigo-700 hover:text-indigo-900">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        
        <div class="flex items-center justify-between py-2 px-3 border-t bg-gray-50">
          <div class="flex items-center gap-2">
            <span class="text-xs text-gray-500 italic">
              Geser ke kanan untuk melihat semua pertanyaan
            </span>
            <div class="text-xs px-2 py-1 bg-gray-200 rounded-full hidden md:block">
              <span id="visible-columns">0</span>/<span id="total-columns">{{ count($pertanyaanInfo) }}</span> kolom terlihat
            </div>
          </div>
          <div class="flex gap-1">
            <button id="scroll-left" class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs hover:bg-indigo-200">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
            </button>
            <button id="scroll-right" class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs hover:bg-indigo-200">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </button>
          </div>
        </div>
        
      @else
        <div class="py-4 px-3">
          <p class="text-center text-sm font-light text-gray-600">
            There is no Rules.
          </p>
        </div>
      @endif
    </div>
  </div>
</div>

<style>
  /* Memastikan scrollbar selalu ditampilkan */
  .custom-scrollbar {
    width: 100%;
    overflow-x: scroll !important; 
    position: relative;
    scrollbar-width: thin;
    scrollbar-color: #818cf8 #e0e7ff;
    -webkit-overflow-scrolling: touch;
  }
  
  /* Modifikasi untuk style scrollbar */
  .custom-scrollbar::-webkit-scrollbar {
    height: 10px !important;
    display: block !important;
  }
  
  .custom-scrollbar::-webkit-scrollbar-track {
    background: #e0e7ff;
    border-radius: 4px;
    display: block !important;
  }
  
  .custom-scrollbar::-webkit-scrollbar-thumb {
    background: #818cf8;
    border-radius: 4px;
    border: 1px solid #e0e7ff;
    display: block !important;
  }
  
  .custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #6366f1;
  }
  
  /* Fixed styling for sticky columns */
  .sticky {
    position: sticky;
    background-clip: padding-box;
  }
  
  /* Shadow effects for better visual separation */
  th.sticky.left-0, td.sticky.left-0 {
    box-shadow: 2px 0 5px -2px rgba(0,0,0,0.15);
  }
  
  th.sticky.left-16, td.sticky.left-16 {
    box-shadow: 2px 0 5px -2px rgba(0,0,0,0.15);
  }
  
  /* Handle row hover effects properly with sticky columns */
  tr:hover td.sticky {
    background-color: #f9fafb; /* match hover color */
  }
  
  /* Ensure consistent table cell sizing */
  th, td {
    min-width: 3rem;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const scrollContainer = document.querySelector('.custom-scrollbar');
    const scrollLeftBtn = document.getElementById('scroll-left');
    const scrollRightBtn = document.getElementById('scroll-right');
    const visibleColumnsElement = document.getElementById('visible-columns');
    const totalColumnsElement = document.getElementById('total-columns');
    
    // Memastikan tabel memiliki width minimum yang memaksa scrollbar muncul
    const tableElement = scrollContainer.querySelector('table');
    const headerCells = scrollContainer.querySelectorAll('th');
    
    // Hitung total minimum width berdasarkan header
    let minWidth = 0;
    headerCells.forEach(cell => {
      // Width minimal per cell + padding
      minWidth += 50;
    });
    
    // Set minimum width pada tabel jika perlu
    if (minWidth > scrollContainer.clientWidth) {
      tableElement.style.minWidth = minWidth + 'px';
    } else {
      // Jika tidak cukup kolom, tetapkan minimal width yang lebih besar dari container
      tableElement.style.minWidth = (scrollContainer.clientWidth + 200) + 'px';
    }
    
    // Paksa scrollbar muncul dengan CSS
    scrollContainer.style.overflowX = 'scroll';
    
    if (scrollContainer && scrollLeftBtn && scrollRightBtn) {
      // Smooth scroll functionality
      scrollLeftBtn.addEventListener('click', function() {
        scrollContainer.scrollBy({
          left: -150,
          behavior: 'smooth'
        });
      });
      
      scrollRightBtn.addEventListener('click', function() {
        scrollContainer.scrollBy({
          left: 150,
          behavior: 'smooth'
        });
      });
      
      // Update visible columns counter and button states
      function updateScrollInfo() {
        const containerWidth = scrollContainer.clientWidth;
        const totalWidth = scrollContainer.scrollWidth;
        const scrollPosition = scrollContainer.scrollLeft;
        
        // Calculate approximately how many columns are visible
        // Assuming each column is roughly 48px wide (12 + padding)
        const visibleWidth = containerWidth - 76; // Subtracting width of fixed columns
        const approxColumnsVisible = Math.floor(visibleWidth / 48);
        
        if (visibleColumnsElement) {
          visibleColumnsElement.textContent = Math.min(approxColumnsVisible, 
            parseInt(totalColumnsElement.textContent));
        }
        
        // Update button states
        const isAtStart = scrollPosition === 0;
        const isAtEnd = Math.ceil(scrollPosition + containerWidth) >= totalWidth;
        
        scrollLeftBtn.disabled = isAtStart;
        scrollLeftBtn.classList.toggle('opacity-50', isAtStart);
        scrollRightBtn.disabled = isAtEnd;
        scrollRightBtn.classList.toggle('opacity-50', isAtEnd);
      }
      
      // Initial update and add event listener
      updateScrollInfo();
      scrollContainer.addEventListener('scroll', updateScrollInfo);
      window.addEventListener('resize', updateScrollInfo);
      
      // Add keyboard shortcuts (arrow keys) when the table has focus
      scrollContainer.tabIndex = 0; // Make it focusable
      scrollContainer.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
          scrollContainer.scrollBy({
            left: -50,
            behavior: 'smooth'
          });
          e.preventDefault();
        } else if (e.key === 'ArrowRight') {
          scrollContainer.scrollBy({
            left: 50,
            behavior: 'smooth'
          });
          e.preventDefault();
        }
      });
    }
  });
</script>
@endsection