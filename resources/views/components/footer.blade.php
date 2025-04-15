<footer class="bg-foocolor py-10">
  <div class="container mx-auto px-6 lg:px-20">
    <!-- Main Footer Content -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Bagian Kiri -->
      <div class="flex flex-col items-start">
        <!-- Logo -->
        <img src="{{ asset('assets/logo/logo-typo.png') }}" alt="Logo nextEdu" class="h-9 mb-6">
        
        <!-- Deskripsi -->
        <p class="text-gray-600 text-sm mb-4 max-w-xs">
          Temukan jurusan anda dengan nextEdu hasil tepat dan sesuai.
        </p>
        
        <!-- Ikon Sosial -->
        <div class="flex space-x-4">
          <!-- Email -->
          <a href="mailto:official.nextedu@gmail.com" class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow-md hover:bg-gray-100" aria-label="Email">
            <img src="{{ asset('assets/icon/email.svg') }}" alt="Ikon Email">
          </a>
          
          <!-- Instagram -->
          <a href="https://www.instagram.com/nextedu.id?igsh=OTY5Y2d4dzA5YW5t" class="w-10 h-10 flex items-center justify-center rounded-full bg-purpleMain text-white hover:bg-indigo-700" aria-label="Instagram">
            <img src="{{ asset('assets/icon/instagram.svg') }}" alt="Ikon Instagram">
          </a>
        </div>
      </div>
      
      <!-- Bagian Perusahaan -->
      <div class="flex flex-col">
        <h3 class="font-bold text-gray-900 mb-4">nextEdu</h3>
        <ul class="text-gray-600 space-y-2">
          <li><a href="{{ url('/#tentang') }}" class="hover:text-indigo-600">Tentang Kami</a></li>
          <li><a href="/tesminatmu" class="hover:text-indigo-600">Tes Jurusan</a></li>
          <li><a href="/artikelPage" class="hover:text-indigo-600">Artikel</a></li>
          <li><a href="/privacy-policy" class="hover:text-indigo-600">Kebijakan Privasi</a></li>
        </ul>
      </div>
      
      <!-- Bagian Kontak -->
      <div class="flex flex-col">
        <h3 class="font-bold text-gray-900 mb-4">Kontak</h3>
        <ul class="text-gray-600 space-y-2">
          <li><a href="/faq" class="hover:text-indigo-600">Help/FAQ</a></li>
          <li class="flex items-start">
            <span>Jl. DI Panjaitan No.128, Kec. Purwokerto Sel., Kabupaten Banyumas, Jawa Tengah 53141</span>
          </li>
          <li><a href="mailto:official.nextedu@gmail.com" class="hover:text-indigo-600">official.nextedu@gmail.com</a></li>
        </ul>
      </div>
    </div>
    
    <!-- Garis Pembatas -->
    <hr class="my-8 border-gray-300">
    
    <!-- Copyright and Terms -->
    <div class="flex flex-col md:flex-row items-center justify-between text-gray-500 text-sm">
      <p>&copy; nextEdu 2025. All rights reserved.</p>
      <a href="#" class="hover:text-indigo-600 mt-2 md:mt-0">Terms & Conditions</a>
    </div>
  </div>
</footer>