<template>
    <div class="col-md-8">
        <nav class="navbar" id="project-navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="navbar-brand glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                </div>
                <div class="collapse navbar-collapse">
                    <form class="navbar-form navbar-left">
                        <div class="form-group">
                            <input v-model="project.name"
                                   :disabled="!statusEdit"
                                   type="text" class="form-control"
                            >
                        </div>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li v-if="!statusEdit">
                            <a @click="deleteProject">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li v-if="!statusEdit">
                            <a @click="switchStatus">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li v-if="statusEdit" class="end-edit">
                            <a @click="updateProjects">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            </a>
                        </li>
                        <li>
                            <a class="add-task">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;&nbsp;Task
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>
        <div id="sortable">

            <task @task-delete="handleTaskDelete()"
                  v-for="(task, taskIndex) in project.tasks"
                  :taskIndex="taskIndex"
                  :task="task"
                  :key="task.id"></task>
        </div>

        <div class="modal fade bs-example-modal-lg" id="modal-add-task" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Creating a new task!</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="task-name">Name</label>
                                <input v-model="newTask.name" type="text" class="form-control" id="task-name"
                                       placeholder="Start typing here to create a task ...">
                            </div>
                            <div class="form-group">
                                <label for="deadline">Deadline</label>
                                <input v-model="newTask.deadline" data-format="Y-m-d" data-large-mode="true"
                                       data-min-year="2000" data-max-year="2090" data-large-default="true"
                                       type="text" class="form-control" id="deadline">
                            </div>
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <select v-model="newTask.is_important" class="form-control" id="priority">
                                    <option value="0">Default</option>
                                    <option value="1">Important</option>
                                </select>
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                        <button @click="createTask" type="button" class="btn btn-primary">CREATE</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


</template>

<script>
    import bus from '../bus';
    export default {
        data: function () {
            return {
                newTask: {
                    name: '',
                    deadline: '',
                    is_important: 0
                },
                statusEdit: false,
            }
        },
        methods: {
            switchStatus: function () {
                this.statusEdit = !this.statusEdit;
            },
            updateProjects: function () {
                let self = this;
                let dataToast = {
                    title: 'OK',
                    message: 'Project successfully updated!',
                    position: 'topLeft',
                    transitionIn: 'bounceInRight',
                };
                axios.post('/updateProject', {
                    id: self.project.id,
                    name: self.project.name
                })
                    .then(function (response) {
                        self.switchStatus();
                        bus.$emit('show-toast', 'success', dataToast);
                    })
                    .catch(function (error) {
                        if (error.response) {
                            $.each(error.response.data, function (i, key) {
                                dataToast.message = key;
                                dataToast.title = '';
                                bus.$emit('show-toast', 'error', dataToast);
                            });
                        }
                    });
            },
            handleTaskDelete: function (taskIndex, projectId) {
                this.project.tasks.splice(taskIndex, 1);
            },
            deleteProject: function () {
                let self = this;
                let dataToast = {
                    title: 'OK',
                    message: 'Project successfully deleted!',
                    position: 'topLeft',
                    transitionIn: 'bounceInRight',
                };
                axios.post('deleteProject', {
                    id: self.project.id,
                }).then(function (response) {
                    self.$emit('project-delete', self.currentProjectIndex);
                    bus.$emit('show-toast', 'success', dataToast);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            createTask: function () {
                let self = this;
                let dataToast = {
                    title: 'OK',
                    message: 'New task "' + self.newTask.name + '" was successfully created!',
                    position: 'topLeft',
                    transitionIn: 'bounceInRight',
                };
                axios.post('createTask', {
                    name: self.newTask.name,
                    project_id: self.project.id,
                    deadline: self.newTask.deadline,
                    is_important: self.newTask.is_important
                }).then(function (response) {
                    self.project.tasks.unshift(response.data);
                    $('#modal-add-task').modal('hide');
                    bus.$emit('show-toast', 'success', dataToast);
                    self.newTask.name = '';
                    self.newTask.deadline = '';
                    self.newTask.is_important = 0;
//                    self.errors.splice(0, self.errors.length);
                }).catch(function (error) {
                    if (error.response) {
                        $.each(error.response.data, function (i, key) {
                            dataToast.message = key;
                            dataToast.title = '';
                            bus.$emit('show-toast', 'error', dataToast);
                        });
                    }
                });
            }
        },
        props: ['project', 'currentProjectIndex'],
        created: function () {
        },
        mounted: function () {

            let self = this;
            $('.add-task').click(function (e) {
                e.preventDefault();
                $('#modal-add-task').modal()
            });
            $('#deadline').datepicker({
                onSelect: function (dateText) {
                    self.newTask.deadline = dateText;
                },
                dateFormat: 'yy-mm-dd',
            });
        }

    }
</script>
