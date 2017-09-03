<template>
    <div :data-id="task.id" class="row task-item" :class="{'important': !!task.is_important, 'completed': task.is_completed}">
        <div class="col-md-9 task-info">
            <div class="input-group">
                    <span class="input-group-btn">
                        <button class="sortable-move btn btn-default">
                            <span class="glyphicon glyphicon-move"></span>
                        </button>
                        <button type="button" class="btn btn-default">
                            <span v-if="task.is_completed" @click="switchStatus()"
                                  class="glyphicon glyphicon-check"></span>
                            <span v-else @click="switchStatus()" class="glyphicon glyphicon-unchecked"></span>
                        </button>

                    </span>
                <input v-model="task.name" type="text" class="form-control" :disabled="!statusEdit" :value="task.name">
            </div>
        </div>
        <div class="col-md-2 task-deadline">
            <div class="input-group">
                <input v-model="task.deadline" :disabled="!statusEdit" type="text" :id="task.id"
                       class="deadline form-control">
            </div>
        </div>
        <!--<div class="col-md-2 task-status">-->
        <!--<div class="input-group">-->
        <!--<span class="input-group-addon">-->
        <!--<input name="priority" type="radio" >-->
        <!--</span>-->
        <!--<span class="input-group-addon">-->
        <!--<input name="priority" type="radio">-->
        <!--</span>-->
        <!--</div>-->
        <!--</div>-->
        <div class="col-md-1 task-actions">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button v-if="statusEdit" @click="updateTask" type="button" class="end-edit btn btn-default"
                        aria-label="Left Align">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                </button>
                <button v-if="!statusEdit" @click="switchStatusEdit" type="button" class="btn btn-default"
                        aria-label="Left Align">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
                <button v-if="!statusEdit" @click="deleteTask(taskIndex)" type="button" class="btn btn-default"
                        aria-label="Left Align">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </button>
            </div>
        </div>


    </div>

</template>

<script>
    import bus from '../bus';
    export default {
        data: function () {
            return {
                statusEdit: false,
            }
        },
        methods: {
            switchStatusEdit: function () {
                this.statusEdit = !this.statusEdit;
            },
            switchStatus: function () {
                let self = this;
                let dataToast = {
                    title: 'OK',
                    message: 'Status of the task was updated!',
                    position: 'topLeft',
                    transitionIn: 'bounceInRight',
                };
                axios.post('updateTask', {
                    id: self.task.id,
                    name: self.task.name,
                    deadline: self.task.deadline,
                    is_completed: !self.task.is_completed,
                }).then(function (response) {
                    self.task.is_completed = !self.task.is_completed;
                    bus.$emit('show-toast', 'info', dataToast);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            deleteTask: function (taskIndex) {
                let self = this;
                let dataToast = {
                    title: 'OK',
                    message: 'Successfully deleted record!',
                    position: 'topLeft',
                    transitionIn: 'bounceInRight',
                };
                axios.post('deleteTask', {
                    id: self.task.id,
                }).then(function (response) {
                    self.$emit('task-delete', taskIndex);
                    bus.$emit('show-toast', 'success', dataToast);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            updateTask: function () {
                let self = this;
                let dataToast = {
                    title: 'OK',
                    message: 'Task was updated!',
                    position: 'topLeft',
                    transitionIn: 'bounceInRight',
                };
                axios.post('updateTask', {
                    id: self.task.id,
                    name: self.task.name,
                    deadline: self.task.deadline,
                    is_completed: self.task.is_completed,
                }).then(function (response) {
                    self.switchStatusEdit();
                    bus.$emit('show-toast', 'info', dataToast);
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
        props: ['task', 'taskIndex'],
        mounted: function () {
            let self = this;
            $('#' + self.task.id + '.deadline').datepicker({
                onSelect: function (dateText) {
                    self.task.deadline = dateText;
                },
                dateFormat: 'yy-mm-dd',
            });
            $('#sortable').sortable({
                delay: 150,
                axis: "y",
                cancel: "input",
                classes: {
                    "ui-icon-arrowthick-2-n-s": "sortable-move",
                    "ui-state-default": "task-item",
                },
                update: function (event, ui) {
                    let newOrder = [];
                    $('#sortable .task-item').each(function () {
                        let id = $(this).data('id');
                        newOrder.push(id);
                    });
                    axios.post('/sortTask', {
                        order: newOrder,
                    }).then(function (response) {
                        bus.$emit('show-toast', 'success', {
                            title: 'OK',
                            message: 'Sorting was successful!',
                            position: 'topLeft',
                            transitionIn: 'bounceInRight',
                        });
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            });
        }
    }
</script>
