<template>
    <div class="row create-task">
        <form>
            <div class="input-group">
                <span class="input-group-addon add-icon">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </span>
                <input @keyup.enter.prevent="addTask(taskName, deadline)"  v-model="taskName" type="text" class="form-control task-name" placeholder="Start typing here to create a task...">
                <div class="input-group date" data-provide="datepicker">
                    <input v-model="deadline" data-date-format="dd/mm/yyyy" type="text" class="form-control datepicker" placeholder="Deadline">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
                <span class="input-group-btn">
                    <button @click="addTask(taskName, deadline)" class="btn btn-default add-task" type="button">Add task</button>
                </span>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {taskName:'', deadline: ''}
        },
        mounted: function() {
            var vm = this;
            $('.datepicker').datepicker({
                onSelect: function(dateText) {
                    vm.deadline = dateText;
                },
                dateFormat: 'yy-mm-dd',
            });
        },
        props: ['project'],
        methods: {
            addTask: function (taskName, deadline) {
                this.$emit('create-task', taskName, deadline);
                this.taskName = '';
                this.deadline = '';
            }
        }
    }

</script>
