<template>
    <div>
        <div class="row">
            <div class="alert alert-danger" role="alert" v-for="error in errors">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span> {{error}}
            </div>
            <nav class="navbar navbar-default project">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <span class="navbar-brand glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <form class="navbar-form navbar-left">
                            <div class="form-group">
                                <input v-model="project.name" type="text" class="project-title form-control" :disabled="!project.edit">
                            </div>
                        </form>
                        <button v-if="project.edit" @click="projectUpdate(projectIndex)" type="button" class="btn btn-default navbar-btn navbar-right" aria-label="Left Align">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        </button>
                        <button v-if="!project.edit" @click="removeProject(projectIndex)" type="button"
                                class="btn btn-default navbar-btn navbar-right" aria-label="Left Align">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                        <button v-if="!project.edit" @click="projectEdit(projectIndex)" type="button" class="btn btn-default navbar-btn navbar-right" aria-label="Left Align">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </nav>
        </div>
        <create-task @create-task="handleCreateTask"></create-task>
        <div class="row">
            <table class="table table-bordered">
                <tbody class="sortable">
                <task @update-task="handleUpdateTask" @edit-task="handleEditTask" @remove-task="handleRemoveTask" v-for="(task, taskIndex) in project.tasks" :taskIndex="taskIndex"
                      v-bind:task="task" v-bind:key="task.id"></task>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            removeProject: function (projectIndex) {
                this.$emit('remove-project', projectIndex);
            },
            projectEdit: function (projectIndex) {
                this.$emit('edit-project', projectIndex);
            },
            projectUpdate: function (projectIndex) {
                this.$emit('update-project', projectIndex);
            },
            handleRemoveTask: function (taskIndex) {
                let task = this.project.tasks[taskIndex];
                let project = this.project
                axios.post('deleteTask', {
                    id: task.id,
                })
                    .then(function (response) {
                        project.tasks.splice(taskIndex, 1);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            handleEditTask: function (taskIndex) {
                Vue.set(this.project.tasks[taskIndex], 'edit', true);
            },
            handleUpdateTask: function (taskIndex) {
                let task = this.project.tasks[taskIndex];
                let project = this.project;
                axios.post('updateTask', {
                    id: task.id,
                    name: task.name,
                    is_completed: task.is_completed,
                })
                    .then(function (response) {
                        Vue.set(project.tasks[taskIndex], 'edit', false);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            handleCreateTask: function (taskName, deadline) {
                let project = this.project;
                let self = this;
                if ('tasks' in project) {
                }else{
                    project.tasks = [];
                }
                axios.post('createTask', {
                    name: taskName,
                    project_id: project.id,
                    deadline: deadline
                })
                    .then(function (response) {
                        project.tasks.unshift(response.data);
                        self.errors.splice(0, self.errors.length);
                    })
                    .catch(function (error) {
                        if (error.response) {
                            self.errors.splice(0, self.errors.length);
                            $.each(error.response.data, function (i, key) {
                                self.errors.push(key);
                            });
                        }
                    });
            }

        },
        data: function () {
          return {errors: []};
        },
        props: ['project', 'projectIndex']
    }
</script>
