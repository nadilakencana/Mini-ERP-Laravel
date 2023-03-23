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

// const profile = document.getElementById('profile-navbar');
// const profileDropdown = document.getElementsByClassName('dropdown-list-profile')[0];
// profile.addEventListener('click', function(){
//     profileDropdown.classList.toggle('off');
// });
