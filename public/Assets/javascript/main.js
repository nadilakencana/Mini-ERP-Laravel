const menu = document.getElementById('menu-lable');
const sidebar = document.getElementsByClassName('sidebar')[0];
// const toogle = document.getElementsById('menu-toogle');


menu.addEventListener('click', function(){
    sidebar.classList.toggle('hide');
    // toogle.classList.toggle('active');
    console.log('ok');
});

const btnRate = document.getElementById('btnRate');
const dropdown = document.getElementsByClassName('dropdown-list')[0];
if(btnRate){
    btnRate.addEventListener('click', function(){
        dropdown.classList.toggle('hide');
    });
}

// filter tanggal
const searchForm = document.querySelector(".date_search");
if( searchForm){
    searchForm.addEventListener("submit", function(event) {
        event.preventDefault();
        searchByDate();
    });
}


function searchByDate() {
    // Ambil tanggal yang dimasukkan oleh pengguna
    const searchDate = document.getElementById("date").value;
    console.log(searchDate);

    // Ambil semua baris tabel
    const tableRows = document.querySelectorAll("table tr.body-table");

    // Loop melalui setiap baris tabel, mulai dari baris kedua (indeks 1)
    for (let i = 1; i < tableRows.length; i++) {
      // Ambil nilai pada kolom tanggal (misalnya, kolom ketiga)
    const rowDate = tableRows[i].querySelectorAll("td")[2].textContent;
      // Jika nilai tanggal pada baris sama dengan tanggal yang dicari, tampilkan baris
      if (rowDate === searchDate) {
        tableRows[i].style.display = "";
      } else {
        // Jika tidak, sembunyikan baris
        tableRows[i].style.display = "none";
      }
    }
  }

  // Ambil form pencarian dan tambahkan event listener untuk memanggil fungsi searchByDate() saat form di-submit

// serach data table

// const Search = document.querySelector("#first");

// if(Search){
//     Search.addEventListener("click", function(event) {
//         event.preventDefault();
//         search();
//     });
// }


function search(){
   // Mendapatkan nilai input pencarian
  var input, filter, table, tr, td, i, txtValue;
  input = document.querySelector(".box-search");
  filter = input.innerText.toUpperCase();
    console.log(filter);
  // Mendapatkan tabel dan baris dalam tabel

   table = document.getElementById("data-table");
    console.log(table);
    tr = table.getElementsByClassName("body-table");

  for (var i = 0; i < tr.length; i++) {
    var cells = tr[i].getElementsByTagName("td");
    var match = false;
    // loop dari setiap cell yang ada
    for (var j = 0; j < cells.length; j++) {
      var cell = cells[j];
      if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
        match = true;
        break;
      }
    }
    tr[i].style.display = match ? "" : "none";
  }

}


// const Search2 = document.querySelector('#second');
// if(Search2){
//     Search2.addEventListener("click", function(event) {
//         event.preventDefault();
//         search2();
//     });
//     console.log(Search2, search2())
// }


function search2(){
       // Mendapatkan nilai input pencarian
  var input, filter, table, tr, td, i, txtValue;
  input = document.querySelector(".box-search");
  filter = input.innerText.toUpperCase();
    console.log(filter);
  // Mendapatkan tabel dan baris dalam tabel

   table = document.getElementById("data-table1");
    tr = table.getElementsByClassName("body-table");

  for (var i = 0; i < tr.length; i++) {
    var cells = tr[i].getElementsByTagName("td");
    var match = false;
    // loop dari setiap cell yang ada
    for (var j = 0; j < cells.length; j++) {
      var cell = cells[j];
      if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
        match = true;
        break;
      }
    }
    tr[i].style.display = match ? "" : "none";
  }

}
