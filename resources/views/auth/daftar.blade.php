<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div id="signup-container" class="flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
        <!-- Signup Container -->
        <div class="w-full max-w-md bg-white px-6 py-10 shadow-lg rounded-lg border">
            <div class="mb-8 flex justify-center">
                <h1 class="font-semibold text-3xl sm:text-4xl text-gradient-to-r text-blue-500">Daftar</h1>
            </div>
            <!-- Form Registrasi -->
            <form action="{{ route('daftar') }}" method="POST">
                @csrf
                <div class="flex flex-col text-sm space-y-3">
                    <input class="rounded-lg border p-3 hover:outline-none focus:outline-none hover:border-blue-500" 
                           type="text" name="name" placeholder="Nama Lengkap" required />
                    <input class="rounded-lg border p-3 hover:outline-none focus:outline-none hover:border-blue-500" 
                           type="email" name="email" placeholder="Email" required />
                    <input class="rounded-lg border p-3 hover:outline-none focus:outline-none hover:border-blue-500" 
                           type="tel" name="phone" placeholder="No. Telepon" required />
                    <input class="rounded-lg border p-3 hover:outline-none focus:outline-none hover:border-blue-500" 
                           type="password" name="password" placeholder="Password" required />
                    <input class="rounded-lg border p-3 hover:outline-none focus:outline-none hover:border-blue-500" 
                           type="password" name="password_confirmation" placeholder="Konfirmasi Password" required />
                </div>
                <button class="mt-5 w-full border p-2 bg-gradient-to-r from-blue-300 bg-blue-500 text-white rounded-lg hover:bg-blue-800 hover:text-blue-200 scale-105 duration-300 shadow-lg" 
                        type="submit">Daftar</button>
            </form>
            <div class="mt-5 flex justify-between text-sm text-gray-600">
                <a href="{{ url('') }}" class="hover:text-blue-500">Kembali</a>
                <a href="{{ route('login') }}" class="hover:text-blue-500">Sudah punya akun? Masuk</a>
            </div>
            <div class="mt-5 flex justify-center text-sm text-gray-400 text-center">
                <p>
                    This site is protected by reCAPTCHA and the Google <br />
                    <a class="underline" href="#">Privacy Policy</a> and <a class="underline" href="#">Terms of Service</a> apply.
                </p>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script>
    // Animasi muncul saat halaman dimuat
    anime({
        targets: '#signup-container',
        opacity: [0, 1],
        translateY: [20, 0],
        easing: 'easeOutExpo',
        duration: 1500,
    });
</script>
</html>
