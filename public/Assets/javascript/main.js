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

// let print = document.querySelector('.btn-print');
// let list_action = document.getElementsByClassName('dropdown-print-action')[0];

// forEach(function(print){
//     print.addEventListener('click', function(){
//         list_action.classList.toggle('off');
//     });
// });



