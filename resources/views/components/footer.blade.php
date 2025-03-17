<footer class="bg-gray-100 py-10">
  <div class="container mx-auto px-6 lg:px-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Bagian Kiri -->
      <div>
        <p class="text-gray-600 text-lg mb-4">
          Temukan jurusan anda dengan nextEdu hasil tepat dan sesuai.
        </p>
        <div class="flex space-x-3">
          <!-- Facebook -->
          <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 hover:bg-gray-200" aria-label="Facebook">
            <img src="{{ asset('assets/icon/Facebook.svg') }}" alt="Ikon Facebook"> 
          </a>
          <!-- Instagram -->
          <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-purpleMain text-white hover:bg-indigo-700" aria-label="Instagram">
            <img src="{{ asset('assets/icon/instagram.svg') }}" alt="Ikon Instagram"> 
          </a>
          <!-- Twitter -->
          <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 hover:bg-gray-200" aria-label="Twitter">
            <img src="{{ asset('assets/icon/twitter.svg') }}" alt="Ikon Twitter"> 
          </a>
        </div>
      </div>

      <!-- Bagian Perusahaan -->
      <div>
        <h3 class="font-bold text-gray-900 mb-4">Perusahaan</h3>
        <ul class="text-gray-600 space-y-2">
          <li><a href="#" class="hover:text-indigo-600">Tentang Kami</a></li>
          <li><a href="#" class="hover:text-indigo-600">Tes Jurusan</a></li>
          <li><a href="#" class="hover:text-indigo-600">Artikel</a></li>
          <li><a href="#" class="hover:text-indigo-600">Kebijakan Privasi</a></li>
        </ul>
      </div>

      <!-- Bagian Kontak -->
      <div>
        <h3 class="font-bold text-gray-900 mb-4">Kontak</h3>
        <ul class="text-gray-600 space-y-2">
          <li class="flex items-center space-x-2">
            <img src="{{ asset('assets/icon/telp.svg') }}" alt="Ikon Telepon"> 
            <a href="tel:+6281234567890" class="hover:text-indigo-600">Help/FAQ</a>
          </li>
          <li class="flex items-center space-x-2">
            <img src="{{ asset('assets/icon/location.svg') }}" alt="Ikon Lokasi"> 
            <span>Jl. DI Panjaitan No.128, Kec. Purwokerto Sel., Kabupaten Banyumas, Jawa Tengah 53141</span>
          </li>
          <li class="flex items-center space-x-2">
            <img src="{{ asset('assets/icon/mail.svg') }}" alt="Ikon Email"> 
            <span><a href="mailto:official.nextedu@gmail.com" class="hover:text-indigo-600">official.nextedu@gmail.com</a></span>
          </li>
        </ul>
      </div>
    </div>

    <!-- Garis Pembatas -->
    <hr class="my-8 border-gray-300">

    <!-- Copyright -->
    <div class="flex flex-col md:flex-row justify-between text-gray-500 text-sm">
      <p>&copy; nextEdu 2025. All rights reserved.</p>
      <a href="#" class="hover:text-indigo-600">Terms & Conditions</a>
    </div>
  </div>
</footer>
