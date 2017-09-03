window.Vue = require('vue');
window.axios = require('axios');
import bus from './bus';

Vue.component('registration', require('./components/auth/Registration.vue'));
Vue.component('login', require('./components/auth/Login.vue'));
Vue.component('home', require('./components/Home.vue'));
Vue.component('profile', require('./components/Profile.vue'));
Vue.component('project', require('./components/Project.vue'));
Vue.component('task', require('./components/Task.vue'));

const todoApp = new Vue({
    el: '#app',
    data: {
        user: user,
        projects: user.projects,
        view: 'profile',
        projectName: '',
    },
    methods: {
        handleLogged: function (data) {
            this.user = data;
            this.projects = data.projects;
        },
        logout: function () {
            let self = this;
            axios.post('/logout')
                .then(function (response) {
                    self.user = [];
                    self.projects = [];
                    self.showToast('success', {
                        title: 'OK',
                        message: 'Successfully logout!',
                        position: 'topLeft',
                        transitionIn: 'bounceInRight',
                    })
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        createProject: function () {
            let self = this;
            let dataToast = {
                title: 'OK',
                message: 'New project "' + self.projectName + '" was successfully created!',
                position: 'topLeft',
                transitionIn: 'bounceInRight',
            };
            axios.post('/createProject', {
                projectName: self.projectName,
            }).then(function (response) {
                self.projects.unshift(response.data);
                $('#modal-add-project').modal('hide');
                bus.$emit('create-project');
                self.showToast('success', dataToast);
                self.projectName = '';
                $(".project-list").animate({
                    scrollTop: 0
                }, 700);
            }).catch(function (error) {
                if (error.response) {
                    $.each(error.response.data, function (i, key) {
                        dataToast.message = key;
                        dataToast.title = '';
                        bus.$emit('show-toast', 'error', dataToast);
                    });
                }
            });
        },
        showToast: function (type, data) {
            data = Object.assign({
                timeout: 2500
            }, data);
            if (type == 'success') {
                iziToast.success(data);
            }
            if (type == 'info') {
                iziToast.info(data);
            }
            if (type == 'error') {
                iziToast.error(data);
            }
        }
    },
    mounted: function () {
        $('.add-project').click(function (e) {
            e.preventDefault();
            $('#modal-add-project').modal()
        });
    },
    created: function () {
        let self = this;
        bus.$on('show-toast', function (type, data) {
            self.showToast(type, data);
        });
        bus.$on('logged', function (data) {
            self.handleLogged(data);
        });
    },
    computed: {
        currentView: {
            get: function () {
                if (this.view == 'home') {
                    return 'home';
                }
                if (this.auth) {
                    return 'profile';
                } else {
                    if (this.view == 'login') {
                        return 'login';
                    }
                    if (this.view == 'registration') {
                        return 'registration';
                    }
                    return 'home';
                }
            },
            set: function (view) {
                this.view = view;
            }
        },
        auth: function () {
            return 'name' in this.user;
        }
    }

});

