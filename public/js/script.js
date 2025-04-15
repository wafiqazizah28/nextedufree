// navbar Fixed
window.onscroll = function () {
    const header = document.querySelector("header");
    const fixedNav = header.offsetTop;

    if (window.pageYOffset > fixedNav) {
        header.classList.add("navbar-fixed");
    } else {
        header.classList.remove("navbar-fixed");
    }
};

    // Fungsi untuk mengatur navbar saat page load
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('navbar');
        // Tambahkan kelas transparent saat awal load
        navbar.classList.add('navbar-default');
    });
    
    // Fungsi untuk mengatur navbar fixed dan transparan saat scrolling
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        const navLinks = navbar.querySelectorAll('a');
        
        if (window.pageYOffset > 10) {
            navbar.classList.add('navbar-fixed');
            navbar.classList.remove('navbar-transparent');
        } else {
            navbar.classList.remove('navbar-fixed');
            navbar.classList.add('navbar-default');
        }
    });
    
    



// // button di home
// const pilihan1 = document.querySelector("#pilihan1");
// const pilihan2 = document.querySelector("#pilihan2");
// const pilihan3 = document.querySelector("#pilihan3");

// pilihan1.addEventListener("click", function () {
//     pilihan1.classList.add("aktif");
//     pilihan2.classList.remove("aktif");
//     pilihan3.classList.remove("aktif");
// });

// pilihan2.addEventListener("click", function () {
//     pilihan1.classList.remove("aktif");
//     pilihan2.classList.add("aktif");
//     pilihan3.classList.remove("aktif");
// });

// pilihan3.addEventListener("click", function () {
//     pilihan1.classList.remove("aktif");
//     pilihan2.classList.remove("aktif");
//     pilihan3.classList.add("aktif");
// });



// async function loadJSON() {
//     try {
//         const response = await fetch("part1.json");
//         if (response.ok) {
//             const data = await response.json();
//             console.log(data);
//         } else {
//             throw new Error("Error");
//         }
//     } catch (error) {
//         console.log(error);
//     }
// }

// loadJSON();
