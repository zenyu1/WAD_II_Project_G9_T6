
const app = Vue.createApp({
    
});
// DO NOT EDIT - start
app.component('include-navbar',{
    template: ` 
        <div><nav class="navbar navbar-expand-md">
            <div class="container-fluid">
                <a href="home.html" class="navbar-brand">SmilingAcrossLocal<span style="font-size: 11px;"> SG</span></a> 
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                                   data-bs-target="#navbarNav" aria-controls="navbarNav"
                                   aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li id="profile" class="nav-item active"> 
                            <a id="UserName" class="nav-link" aria-current="page" href="profileSettings.html"></a>
                        </li>
                        <li id="signout" class="nav-item active"> 
                            <a class="nav-link" aria-current="page" href="signout.html">Sign Out</a>
                        </li>
                        <li id="LoginSignUp" class="nav-item active"> 
                            <a class="nav-link" aria-current="page" href="login-signup.html">LOGIN/SIGNUP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="home.html">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="KaiWei.php">ATTRACTIONS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="DongHyun.php">MAPS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="zenyu.php">TRAVEL HISTORY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="FangTing.php">REWARDS</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav></div>
    `    
});

const vm = app.mount("#navdiv");