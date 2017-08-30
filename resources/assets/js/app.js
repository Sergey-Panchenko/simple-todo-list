window.Vue = require('vue');
window.axios = require('axios');
Vue.component('project', require('./components/Project.vue'));
Vue.component('create-task', require('./components/project/CreateTask.vue'));
Vue.component('task', require('./components/project/Task.vue'));
Vue.component('login', require('./components/Login.vue'));
Vue.component('register', require('./components/Register.vue'));
Vue.component('auth', require('./components/Auth.vue'));

var app = new Vue({
    el: '#app',
    data: {
        user: user,
        projects: projects,
        projectName: '',
    },
    methods: {
        logout: function () {
            this.user = {};
            axios.post('/logout')
                .then(function (response) {

                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        handleLogged: function(user) {
            this.user = user;
        },
        createProject: function (projectName) {
            axios.post('/createProject', {
                projectName: projectName,
            })
                .then(function (response) {
                    this.projects.unshift(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
            this.projectName = '';

        },
        handleRemoveProject: function (projectIndex) {
            let project = this.projects[projectIndex];
            axios.post('/deleteProject', {
                id: project.id,
            })
                .then(function (response) {
                    this.projects.splice(projectIndex, 1);
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        handleEditProject: function (projectIndex) {
            Vue.set(this.projects[projectIndex], 'edit', true);
        },
        handleUpdateProject: function (projectIndex) {
            let project = this.projects[projectIndex];
            axios.post('/updateProject', {
                id: project.id,
                name: project.name
            })
                .then(function (response) {
                    Vue.set(this.projects[projectIndex], 'edit', false);
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
    computed: {
        currentComponent: {
            get: function () {
                if (!this.user.name) {
                    return 'auth';
                }
                return 'project';
            },
        }
    }
});

$(".sortable").sortable({
    delay: 150,
    axis: "y",
    cursor: "move",
    classes: {
        "ui-icon-arrowthick-2-n-s": "glyphicon-move",
    },
    update: function (event, ui) {
        let newOrder = [];
        $('.sortable tr').each(function () {
            let id = $(this).attr("id");
            newOrder.push(id);
        });
        axios.post('/sortTask', {
            order: newOrder,
        })
        .then(function (response) {
        })
        .catch(function (error) {
            console.log(error);
        });
    }
});
