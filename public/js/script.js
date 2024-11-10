// Menampilkan pesan notifikasi setelah login/logout
alert("Welcome to home page!");


function showToast(message) {
    const toast = document.getElementById("toast");
    toast.textContent = message;
    toast.classList.add("show");

    // Sembunyikan toast setelah 3 detik
    setTimeout(() => {
        toast.classList.remove("show");
    }, 3000);
}

// Panggil fungsi saat login/logout berhasil
showToast("Welcome to home page!");
