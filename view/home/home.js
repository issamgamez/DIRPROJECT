/* ----------- nav link --------------*/
var navlink = document.getElementById("nav_links");


function hide_menu(){
   navlink.style.right = "-200px" ;
}

function open_menu(){
    navlink.style.right = "0" ;
 }
/*------------- login -------------*/  
let modalBtns = [...document.querySelectorAll(".button")];
      modalBtns.forEach(function (btn) {
        btn.onclick = function () {
          let modal = btn.getAttribute("data-modal");
          document.getElementById(modal).style.display = "block";
        };
      });
      let closeBtns = [...document.querySelectorAll(".close")];
      closeBtns.forEach(function (btn) {
        btn.onclick = function () {
          let modal = btn.closest(".modal");
          modal.style.display = "none";
        };
      });
      window.onclick = function (event) {
        if (event.target.className === "modal") {
          event.target.style.display = "none";
        }
      };
 
  /*-------------- filter images----------------------- */
    document.getElementById('titleFilter').addEventListener('input', filterImages);

    function filterImages() {
        const filterValue = document.getElementById('titleFilter').value.toLowerCase();
        const images = document.querySelectorAll('.image-container');

        images.forEach(image => {
            const title = image.querySelector('img').getAttribute('data-title').toLowerCase();
            if (title.includes(filterValue)) {
                image.style.display = 'block';
            } else {
                image.style.display = 'none';
            }
        });
}