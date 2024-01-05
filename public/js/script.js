const sidebar = document.getElementById("sidebar");
const content = document.getElementById("content");
const toggleSidebar = document.getElementById("toggleSidebar");
const sidebarBackdrop = document.getElementById("sidebarBackdrop");

// ========================================================================================================

if (window.innerWidth > 992) {
  var showSidebar = false;
  toggleSidebarState();
} else {
  var showSidebar = true;
  toggleSidebarState();
}

function toggleSidebarState() {
  if (showSidebar) {
    // if (window.innerWidth > 576) {
    //   document.body.classList.remove('sidebar-true');
    //   document.body.classList.add('sidebar-false');
    // } else {
    //   document.body.classList.add('sidebar-true');
    //   document.body.classList.remove('sidebar-false');
    // }

    // TRUE tutup
    document.body.classList.remove('sidebar-true');
    document.body.classList.add('sidebar-false');
    if (window.innerWidth < 992) {
      sidebarBackdrop.style.display = "none";
      sidebarBackdrop.style.backgroundColor = "rgba(0, 0, 0, 0)";
    }
  } else {
    // sidebar.style.left = "0px";
    // content.style.marginLeft = "256px";
    // FALSE buka
    document.body.classList.remove('sidebar-false');
    document.body.classList.add('sidebar-true');
    if (window.innerWidth < 992) {
      sidebarBackdrop.style.display = "block";
      sidebarBackdrop.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
    } else {
      sidebarBackdrop.style.display = "none";
    }
  }
}

sidebarBackdrop.addEventListener('click', function () {
  showSidebar = true;
  toggleSidebarState();
});

toggleSidebar.addEventListener('click', function () {
  showSidebar = !showSidebar;
  toggleSidebarState();
});

// Panggil toggleSidebarState saat halaman dimuat
toggleSidebarState();

// Tambahkan event listener untuk mengubah perilaku saat lebar jendela berubah
window.addEventListener('resize', function () {
  if (window.innerWidth > 992) {
    showSidebar = true;
    toggleSidebarState();
  } else {
    showSidebar = true;
    toggleSidebarState();
  }
});



// ========================================================================================================

(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
  })()

setTimeout(function() {
  var alertElement = document.querySelector('.alert');
  if (alertElement) {
      alertElement.remove();
  }
}, 5000); // Menghilangkan setelah 5 detik (5000 ms)


// ========================================================================================================

// document.addEventListener('DOMContentLoaded', function() {
//   // Mendapatkan semua elemen input
//   var inputElements = document.querySelectorAll('input');

//   // Iterasi melalui setiap elemen input
//   inputElements.forEach(function(inputElement) {
//       // Mendapatkan nama input
//       var inputName = inputElement.name;

//       // Mengisi nilai input dari localStorage jika ada
//       if (localStorage.getItem(inputName)) {
//           inputElement.value = localStorage.getItem(inputName);
//       }

//       // Menyimpan nilai input ke dalam localStorage saat input berubah
//       inputElement.addEventListener('input', function() {
//           localStorage.setItem(inputName, inputElement.value);
//       });
//   });
// });

// ========================================================================================================

document.addEventListener('DOMContentLoaded', function() {
  // Mendapatkan semua elemen input
  const elemetLoading = document.getElementById('loadingNice');
  const elemetLoading2 = document.getElementById('loadingEffect');

  elemetLoading.style.display = 'block';

  elemetLoading2.style.opacity = 1;
  elemetLoading2.style.backgroundColor = 'rgba(0, 0, 0, 0.75)';
  elemetLoading2.style.transition = '0.5s';

  setTimeout(function() {
    elemetLoading2.style.opacity = 0;
    elemetLoading2.style.backgroundColor = 'rgba(0, 0, 0, 0)';
    elemetLoading2.style.transition = '0.5s';
  }, 500)
  
  setTimeout(function() {
    elemetLoading.style.display = 'none';
    
  }, 1000);
});