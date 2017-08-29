window.Vue = require('vue');
window.axios = require('axios');
// var dataProjects;
// $.ajax({
//     url: '/projects',
//     type: 'get',
//     dataType: 'json',
//     async: false,
//     success: function (result) {
//         dataProjects = result;
//     }
// });
// var app = new Vue({
//     el: '#project',
//     data: {
//         projects: dataProjects
//     },
// });

// app.projects = {name:'ewewewe'};
// console.log(app);

// Vue.component('child', require('./components/Child.vue'));
// new Vue({
//     el: '#projects',
//     // опции
// });
// var app = new Vue({
//     el: '#app-3',
//     data: {
//         projects: projects,
//     },
//     methods: {
//         removeTask: function (projectIndex, taskIndex) {
//             // this.projects[projectIndex].tasks[taskIndex];
//             this.projects[projectIndex].tasks.splice(taskIndex, 1)
//             console.log(this.projects[projectIndex].tasks[taskIndex]);
//             console.log('projectIndex ' + projectIndex);
//             console.log('taskIndex ' + taskIndex);
//         }
//     }
// });
Vue.component('project', require('./components/Project.vue'));
Vue.component('project-nav-bar', require('./components/project/NavBar.vue'));
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


