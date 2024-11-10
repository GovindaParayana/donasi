<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body>

    <div id="login-container" class="flex items-center justify-center h-screen">
        <!-- Login Container -->
        <div class="min-w-fit flex-col border bg-white px-6 py-14 shadow-lg rounded-lg ">
            <div class="mb-8 flex justify-center">
                <h1 class="font-semibold text-4xl text-gradient-to-r text-blue-500">Donasi</h1>
            </div>
            <!-- Form login -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="flex flex-col text-sm rounded-md">
                    <input class="mb-5 rounded-lg border p-3 hover:outline-none focus:outline-none hover:border-blue-500" 
                           type="email" name="email" placeholder="Email" required />
                    <input class="border rounded-lg p-3 hover:outline-none focus:outline-none hover:border-blue-500" 
                           type="password" name="password" placeholder="Password" required />
                </div>
                <button class="mt-5 w-full border p-2 bg-gradient-to-r from-blue-300 bg-blue-500 text-white rounded-lg hover:bg-blue-800 hover:text-white scale-105 duration-300 shadow-lg" 
                        type="submit">Login</button>
            </form>
            <div class="mt-5 flex justify-between text-sm text-gray-600">
                <a href="{{ url('') }}" class="hover:text-blue-500">Kembali</a>
                <a href="{{ route('daftar') }}" class="hover:text-blue-500">Sign up</a>
            </div>
            <div class="mt-5 flex text-center text-sm text-gray-400">
                <p>
                    This site is protected by reCAPTCHA and the Google <br />
                    <a class="underline" href="">Privacy Policy</a> and <a class="underline" href="">Terms of Service</a> apply.
                </p>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script>
    // Animasi muncul saat halaman dimuat
    anime({
        targets: '#login-container',
        opacity: [0, 1],
        translateY: [20, 0],
        easing: 'easeOutExpo',
        duration: 1500,
    });
</script>
</html>
