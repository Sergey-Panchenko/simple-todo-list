window.Vue = require('vue');
window.axios = require('axios');
Vue.component('project', require('./components/Project.vue'));
Vue.component('create-task', require('./components/project/CreateTask.vue'));
Vue.component('task', require('./components/project/Task.vue'));

var app = new Vue({
    el: '#app',
    data: {
        projects: projects,
        projectName: '',
    },
    methods: {
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
    }
});


