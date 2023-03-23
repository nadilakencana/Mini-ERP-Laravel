<div class="navbar">
    <div id="menu-toogle">
        <input type="checkbox" id="menu-checkbox">
        <label for="menu-checkbox" id="menu-lable">
            <div id="hamburger"></div>
        </label>
    </div>

    <div class="profile">
        <div class="seting">
            <img src="{{ asset('Assets/icon/🦆 icon _settings_.png') }}" alt="" srcset="">
        </div>
        <div class="name-admin">
            <p>{{ Auth()->user()->nama }}</p>
            <span>{{ Auth()->user()->role_admin->nama_role }}</span>
        </div>
        <div class="img-profile" id="profile-navbar">
            <img src="{{ asset('Assets/icon/user.png') }}" alt="" srcset="">
        </div>
        <div class="dropdown-list-profile off">
            <ul class="list">
                <li class="profile-list"> Profile </li>
                <li class="profile-list">
                    <img src="{{ asset('Assets/icon/account logout.png') }}" alt="" srcset="">
                    <p><a href="{{ route('logout') }}">LogOut</a> </p>
                </li>
            </ul>
       </div>
    </div>
</div>


<script>
    const profile = document.getElementById('profile-navbar');
    const profileDropdown = document.getElementsByClassName('dropdown-list-profile')[0];
    profile.addEventListener('click', function(){
        profileDropdown.classList.toggle('off');
    });
</script>

