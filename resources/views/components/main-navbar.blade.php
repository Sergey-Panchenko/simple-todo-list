<nav class="navbar" id="main-navbar">
    <div class="container-fluid">

        <div class="navbar-header" @click="currentView = 'home'">
            <span class="navbar-brand glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
            <span class="navbar-brand" href="#">
                TODO LIST
            </span>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" v-if="!auth">
                <li>
                    <a @click="currentView = 'login'">
                        <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp; LOGIN
                    </a>
                </li>
                <li>
                    <a @click="currentView = 'registration'">
                        <span class="glyphicon glyphicon-road" aria-hidden="true"></span>&nbsp; REGISTRATION
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right" v-show="auth">
                <li>
                    <a @click="currentView = 'profile'" class="user-profile">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp; @{{ user.name }}
                    </a>
                </li>
                <li>
                    <a class="add-project">
                        <span  class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp; ADD PROJECT
                    </a>
                </li>
                <li>
                    <a @click="logout">
                        <span class="glyphicon glyphicon-log-out"></span> LOGOUT
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
