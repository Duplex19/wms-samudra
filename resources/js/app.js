import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    const darkModeToggle = document.getElementById("darkModeToggle");
    const darkIcon = document.getElementById("darkIcon");
    const lightIcon = document.getElementById("lightIcon");

    // Cek preferensi pengguna dari localStorage
    const currentTheme = localStorage.getItem("theme") || "light";

    // Terapkan tema saat ini
    if (currentTheme === "dark") {
        document.documentElement.setAttribute("data-bs-theme", "dark");
        darkIcon.classList.remove("d-none");
        lightIcon.classList.add("d-none");
    } else {
        document.documentElement.setAttribute("data-bs-theme", "light");
        darkIcon.classList.add("d-none");
        lightIcon.classList.remove("d-none");
    }

    // Toggle tema saat tombol diklik
    darkModeToggle.addEventListener("click", function () {
        if (document.documentElement.getAttribute("data-bs-theme") === "dark") {
            document.documentElement.setAttribute("data-bs-theme", "light");
            localStorage.setItem("theme", "light");
            darkIcon.classList.add("d-none");
            lightIcon.classList.remove("d-none");
        } else {
            document.documentElement.setAttribute("data-bs-theme", "dark");
            localStorage.setItem("theme", "dark");
            darkIcon.classList.remove("d-none");
            lightIcon.classList.add("d-none");
        }
    });

    // Deteksi preferensi sistem
    const prefersDark = window.matchMedia("(prefers-color-scheme: dark)");

    prefersDark.addEventListener("change", (e) => {
        if (e.matches) {
            document.documentElement.setAttribute("data-bs-theme", "dark");
            localStorage.setItem("theme", "dark");
            darkIcon.classList.remove("d-none");
            lightIcon.classList.add("d-none");
        } else {
            document.documentElement.setAttribute("data-bs-theme", "light");
            localStorage.setItem("theme", "light");
            darkIcon.classList.add("d-none");
            lightIcon.classList.remove("d-none");
        }
    });
});
