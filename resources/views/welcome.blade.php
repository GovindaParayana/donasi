<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <style>
        /* CSS untuk menu animasi */
        .menu {
            transition: max-height 0.3s ease-out, opacity 0.3s ease-out;
            max-height: 0; /* Menu tersembunyi secara default */
            opacity: 0; /* Memulai dengan transparan */
            overflow: hidden; /* Mencegah tampilan menu melebihi batas */
        }
        
        .menu.show {
            max-height: 200px; /* Sesuaikan dengan tinggi maksimum menu saat terbuka */
            opacity: 1; /* Menampilkan menu */
        }
        .text-about,.text-paraf, .card {
            opacity: 0;
        }
        .card {
            transform: scale(1);
            transition: transform 0.2s ease-out;
        }
        
        .card:hover {
            transform: scale(1.05); /* Optional backup in case JS fails */
        }

         /* CSS untuk Dropdown */
         .dropdown-content {
    display: none;
    position: absolute;
    right: 0; /* Mengatur posisi dropdown agar sesuai dengan tombol */
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 8px;
    padding: 10px 0; /* Memberikan sedikit padding pada bagian atas dan bawah */
}

.dropdown-content a, .dropdown-content form {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: flex;
    align-items: center;
    font-weight: bold;
}

.dropdown-content a:hover, .dropdown-content button:hover {
    background-color: #f1f1f1;
}

.logout-btn {
    background-color: #e53e3e;
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    text-align: center;
    cursor: pointer;
    width: 100%;
    margin-top: 5px;
    border: none;
}

.logout-btn:hover {
    background-color: #c53030;
}

.dropdown-toggle {
    cursor: pointer;
    color: #1a202c;
    font-weight: bold;
}


.toast {
    visibility: hidden;
    min-width: 250px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 8px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.5s ease-in-out, visibility 0.5s;
}

.toast.show {
    visibility: visible;
    opacity: 1;
}

    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>



<body>
    
    <header class="sticky inset-0 z-50 border-b border-slate-100 bg-white/80 backdrop-blur-lg">
        
        <nav class="relative px-10 py-4 flex justify-between items-center bg-white navbar shadow-md">
            <!-- Logo -->
            <a class="text-3xl font-bold leading-none" href="#">
            <!-- Logo SVG -->
        </a>
        <ul class="flex-col lg:flex lg:flex-row lg:space-x-6 lg:justify-center w-full lg:w-auto lg:static absolute top-full left-0 bg-white lg:bg-transparent p-4 lg:p-0">
            <li><a class="nav-item text-sm font-bold text-blue-600 border-b-2 border-blue-500" href="#">Home</a></li>
            <li><a class="nav-item text-sm text-gray-400 hover:text-gray-500" href="#aboutus">Tentang Kami</a></li>
            <li><a class="nav-item text-sm text-gray-400 hover:text-gray-500" href="#">Layanan</a></li>
            <li><a class="nav-item text-sm text-gray-400 hover:text-gray-500" href="#">Harga</a></li>
            <li><a class="nav-item text-sm text-gray-400 hover:text-gray-500" href="#">Kontak</a></li>
            </ul>

      
            <div class="text-sm font-bold text-gray-700">
                @if(Auth::check())
                    <div class="dropdown">
                        <span class="dropdown-toggle" onclick="toggleDropdown()">Selamat datang, {{ Auth::user()->name }}</span>
                        
                        <div id="dropdownMenu" class="dropdown-content">
                            <a href="{{ url('/reset-password') }}">
                                <i class="fas fa-lock mr-2"></i> Reset Password
                            </a>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Tampilkan Tombol Masuk dan Daftar jika pengguna belum login -->
                    <div class="flex items-center">
                        <a class="py-2 px-6 mx-2 bg-gray-50 hover:bg-gray-100 text-sm text-gray-900 font-bold rounded-xl transition duration-200" href="{{ url('/login') }}">Masuk</a>
                        <a class="py-2 px-6 bg-blue-500 hover:bg-blue-600 text-sm text-white font-bold rounded-xl transition duration-200" href="{{ url('/daftar') }}">Daftar</a>
                    </div>
                @endif
            </div>

            <div id="toast" class="toast">Welcome to home page!</div>

            

   
</nav>

 <!-- Menu Navigasi -->

<!-- Toggle Button for Mobile Menu -->
<button class="lg:hidden flex items-center px-3 py-2 border rounded text-gray-600 border-gray-600 hover:text-gray-900 hover:border-gray-900" onclick="toggleMenu()">
        <!-- Button SVG -->
    </button>
</nav>

    

    



<!-- navbar -->

</header>
<!-- hero Section -->
<section class=" hero-section justify-center h-screen w-full">
    <div class="container mx-auto px-8 lg:flex justify-center mt-28">
        <!-- Teks -->
        <div class="text-center lg:text-left lg:w-1/2 flex flex-col justify-center">
            <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold leading-none">Yuk Donasi</h1>
            <p class="text-xl lg:text-2xl mt-6 font-light">
                "Setiap donasi Anda dapat memberikan harapan baru bagi mereka yang membutuhkan. 
                Mari bersama-sama menciptakan perubahan dan menjadikan dunia lebih baik!"
            </p>
            <p class="mt-8 md:mt-12">
                <a href="{{ url('/login') }}"><button type="button" class="py-4 px-12 bg-blue-500 hover:bg-gray-50 rounded-lg text-white hover:text-blue-600 shadow-lg">Mulai Donasi</button></a>
            </p>
            <p class="mt-4 text-gray-600">Donasi Kita</p>
        </div>

        <!-- Gambar -->
        <div class="lg:w-1/2 lg:pl-10 flex justify-center items-center">
            <img src="https://i.pinimg.com/564x/de/37/98/de3798332176b0211f2973d08ed0f01a.jpg" 
            alt="Donasi" class="w-full h-auto rounded-full image-donasi">
        </div>
    </div>
</section>





<section id="aboutus" class="min-h-screen w-full flex items-center justify-center bg-blue-400 my-auto px-4 md:px-8">
    <div class="container pt-10 md:pt-20 lg:flex lg:justify-between items-center space-y-8 lg:space-y-0">
        <!-- Teks -->
        <div class="text-white lg:w-1/2 flex flex-col justify-center text-center lg:text-left">
            <h1 class="font-semibold text-3xl md:text-4xl lg:text-5xl xl:text-6xl">About Us</h1>
            <p class="font-light mt-4 text-base md:text-lg lg:text-xl leading-relaxed">
                "Kami adalah platform yang berkomitmen untuk memberikan solusi terbaik dalam bidang berdonasi secara online. 
                Dengan tim yang berpengalaman dan berdedikasi, kami fokus pada inovasi, kualitas, dan kepuasan pelanggan."
            </p>
        </div>

        <!-- Gambar -->
        <div class="lg:w-1/2 flex justify-center items-center">
            <img src="https://i.pinimg.com/564x/de/37/98/de3798332176b0211f2973d08ed0f01a.jpg" 
            alt="Donasi" class="w-2/3 md:w-1/2 lg:w-3/4 xl:w-full h-auto rounded-full">
        </div>
    </div>
</section>

{{-- footer --}}
<footer class="bg-white mx-8 pt-40 md:pt-20">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
              <a href="https://flowbite.com/" class="flex items-center">
                  <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                  <span class="self-center text-2xl font-semibold whitespace-nowrap ">Flowbite</span>
              </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
              <div>
                  <h2 class="mb-6 text-sm font-semibold  uppercase ">Resources</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="https://flowbite.com/" class="hover:underline">Flowbite</a>
                      </li>
                      <li>
                          <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold  uppercase ">Follow us</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                      </li>
                      <li>
                          <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
                      </li>
                  </ul>
              </div>
              <div>
                  <h2 class="mb-6 text-sm font-semibold  uppercase">Legal</h2>
                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                      <li class="mb-4">
                          <a href="#" class="hover:underline">Privacy Policy</a>
                      </li>
                      <li>
                          <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
      <div class="sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="" class="hover:underline">Flowbite™</a>. All Rights Reserved.
          </span>
          <div class="flex mt-4 sm:justify-center sm:mt-0">
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                    </svg>
                  <span class="sr-only">Facebook page</span>
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 16">
                        <path d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z"/>
                    </svg>
                  <span class="sr-only">Discord community</span>
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                    <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd"/>
                </svg>
                  <span class="sr-only">Twitter page</span>
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                  </svg>
                  <span class="sr-only">GitHub account</span>
              </a>
              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z" clip-rule="evenodd"/>
                </svg>
                  <span class="sr-only">Dribbble account</span>
              </a>
          </div>
      </div>
    </div>
</footer>
<script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdownMenu");
        dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
    }

    // Close dropdown if clicked outside
    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-toggle')) {
            var dropdownMenu = document.getElementById("dropdownMenu");
            if (dropdownMenu && dropdownMenu.style.display === "block") {
                dropdownMenu.style.display = "none";
            }
        }
    }
</script>

<script src="js/script.js"></script>

</body>

<!-- hero section -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Animasi gambar muncul dengan efek fade-in dan slide-in dari bawah
        anime({
            targets: '.hero-section', // Target elemen gambar dengan class 'image-donasi'
            opacity: [0, 1], // Mulai dari opacity 0 (transparan) ke opacity 1 (penuh)
            translateY: [100, 0], // Gambar muncul dari posisi bawah (50px ke atas 0px)
            duration: 2000, // Durasi animasi 1.5 detik
            easing: 'easeOutExpo', // Transisi halus keluar
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    anime({
        targets: '.navbar',
        opacity: [0, 1], // Mulai dari opacity 0 (transparan) ke opacity 1 (penuh)
        translateX: [100, 0], // Gambar muncul dari posisi bawah (50px ke atas 0px)
        duration: 2000, // Durasi animasi 1.5 detik
        easing: 'easeOutExpo',
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Animasi pertama: Gambar muncul dengan efek fade-in dan slide-in
        anime({
            targets: '.image-donasi', // Target elemen gambar dengan class 'image-donasi'
            opacity: [0, 1], // Mulai dari opacity 0 (transparan) ke opacity 1 (penuh)
            translateY: [50, 0], // Gambar muncul dari posisi bawah (50px ke atas 0px)
            duration: 1500, // Durasi animasi 1.5 detik
            easing: 'easeOutExpo', // Transisi halus keluar
            complete: function() {
                // Setelah animasi fade-in selesai, lanjutkan dengan animasi melayang
                anime({
                    targets: '.image-donasi', // Target elemen gambar dengan class 'image-donasi'
                    translateY: [0, -20], // Gambar bergerak vertikal dari posisi awal (0) ke atas (-20px)
                    duration: 2000, // Durasi animasi 2 detik
                    easing: 'easeInOutSine', // Transisi animasi lembut
                    direction: 'alternate', // Bergerak naik turun (melayang)
                    loop: true // Animasi berulang terus-menerus
                });
            }
        });
    });
</script>
<!-- hero section -->

<!-- navbar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script>
    function toggleMenu() {
        var menu = document.getElementById("menu");
        menu.classList.toggle("hidden");

        // Menambahkan atau menghapus kelas 'show' untuk animasi
        if (menu.classList.contains("hidden")) {
            menu.classList.remove("show");
        } else {
            menu.classList.add("show");
        }
    }
</script>
<!-- navbar -->
<script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdownMenu");
        dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
    }

    // Tutup dropdown jika diklik di luar
    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-toggle')) {
            var dropdownMenu = document.getElementById("dropdownMenu");
            if (dropdownMenu && dropdownMenu.style.display === "block") {
                dropdownMenu.style.display = "none";
            }
        }
    }
</script>

<script>
        // Fungsi untuk menjalankan animasi pada hover dan tetap permanen
        function initHoverAnimation() {
            const heroTitle = document.querySelector('.text-about');
            const heroText = document.querySelector('.text-paraf');
            const cards = document.querySelectorAll('.card');

            // Animasi untuk judul About Us saat di hover
            heroTitle.addEventListener('mouseenter', () => {
                anime({
                    targets: heroTitle,
                    opacity: [0, 1], // Muncul dari 0 menjadi 1
                    translateY: [-50, 0], // Geser dari atas ke bawah
                    duration: 1500,
                    easing: 'easeOutExpo',
                    autoplay: true
                });
                anime({
                    targets: heroText,
                    opacity: [0, 1], // Muncul dari 0 menjadi 1
                    translateY: [-50, 0], // Geser dari atas ke bawah
                    duration: 1500,
                    easing: 'easeOutExpo',
                    autoplay: true
                });
            }, { once: true }); // Animasi terjadi sekali

            // Animasi untuk card saat di hover
            cards.forEach((card, index) => {
                card.addEventListener('mouseenter', () => {
                    anime({
                        targets: card,
                        opacity: [0, 1], // Muncul dari 0 menjadi 1
                        translateY: [100, 0], // Geser dari bawah ke atas
                        delay: index * 200,  // Tunda tiap card agar muncul bergiliran
                        duration: 1200,
                        easing: 'easeOutExpo',
                        autoplay: true
                    });
                }, { once: true }); // Animasi terjadi sekali
            });
        }

        // Jalankan animasi saat halaman dimuat
        window.addEventListener('load', initHoverAnimation);
</script>

<script>
    // Mengambil semua elemen card
    const cards = document.querySelectorAll('.card > div');

    // Loop setiap card dan tambahkan event listener
    cards.forEach(card => {
        // Event ketika mouse masuk (hover)
        card.addEventListener('mouseenter', () => {
            anime({
                targets: card,
                scale: 1.1, // Card akan diperbesar
                duration: 500,
                easing: 'easeOutQuad',
                ShadowRoot:'1'
            });
        });

        // Event ketika mouse keluar dari card
        card.addEventListener('mouseleave', () => {
            anime({
                targets: card,
                scale: 1, // Mengembalikan card ke ukuran semula
                duration: 500,
                easing: 'easeOutQuad'
            });
        });
    });
</script>


<script>
    // JavaScript untuk memindahkan garis biru
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', function() {
            // Hapus kelas border biru dari semua item
            document.querySelectorAll('.nav-item').forEach(link => {
                link.classList.remove('text-blue-600', 'border-b-2', 'border-blue-500');
                link.classList.add('text-gray-400'); // Ubah kembali warna teks ke abu-abu
            });
            // Tambahkan kelas border biru pada item yang diklik
            this.classList.add('text-blue-600', 'border-b-2', 'border-blue-500');
            this.classList.remove('text-gray-400'); // Ubah warna teks ke biru
        });
    });
</script>

</html>