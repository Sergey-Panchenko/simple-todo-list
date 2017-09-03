window.Vue = require('vue');
window.axios = require('axios');
Vue.component('project', require('./components/Project.vue'));
Vue.component('create-task', require('./components/project/CreateTask.vue'));
Vue.component('task', require('./components/project/Task.vue'));
Vue.component('login', require('./components/Login.vue'));
Vue.component('register', require('./components/Register.vue'));
Vue.component('auth', require('./components/Auth.vue'));

const app = new Vue({
    el: '#app',
    data: {
        user: user,
        projects: user.projects,
        projectName: '',
        errors: [],
    },
    methods: {
        logout: function () {
            this.user = {};
            this.projects = {};
            axios.post('/logout')
                .then(function (response) {

                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        handleLogged: function (user) {
            this.user = user.user;
            this.projects = user.projects;
        },
        createProject: function (projectName) {
            let self = this;

            axios.post('/createProject', {
                projectName: projectName,
            })
                .then(function (response) {
                    self.projects.unshift(response.data);
                    self.errors.splice(0, self.errors.length);
                    self.projectName = '';
                })
                .catch(function (error) {
                    if (error.response) {
                        self.errors.splice(0, self.errors.length);
                        $.each(error.response.data, function (i, key) {
                            self.errors.push(key);
                        });
                    }
                });
        },
        handleRemoveProject: function (projectIndex) {
            let project = this.projects[projectIndex];
            let self = this;
            axios.post('/deleteProject', {
                id: project.id,
            })
                .then(function (response) {
                    self.projects.splice(projectIndex, 1);
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        handleEditProject: function (projectIndex) {
            Vue.set(this.projects[projectIndex], 'edit', true);
        },
        handleUpdateProject: function (projectIndex) {
            let self = this;
            let project = this.projects[projectIndex];
            axios.post('/updateProject', {
                id: project.id,
                name: project.name
            })
                .then(function (response) {
                    Vue.set(self.projects[projectIndex], 'edit', false);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
    computed: {
        currentComponent: {
            get: function () {
                if ($.isEmptyObject(this.user)) {
                    return 'auth';
                }
                return 'project';
            },
        }
    }
});

