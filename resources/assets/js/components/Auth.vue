<template>
    <div>
        <nav class="navbar navbar-default auth-navbar">
            <div class="container-fluid">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <button @click="switchView('login')" type="button" class="btn btn-warning">LOGIN</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button @click="switchView('register')" type="button" class="btn btn-primary">REGISTER</button>
                    </div>
                </div>
            </div>
        </nav>
        <component :is="currentView" @logged="handleLogged"></component>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {currentView: 'login'}
        },
        methods: {
            switchView: function (viewName) {
                this.currentView = viewName;
            },
            handleLogged: function (user) {
                this.$emit('logged', user);
            }
        }
    }
</script>
