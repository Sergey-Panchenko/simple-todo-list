<template>
    <div class="row create-task">
        <form>
            <div class="input-group">
                <span class="input-group-addon add-icon">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </span>
                <input @keyup.enter.prevent="addTask(taskName)"  v-model="taskName" type="text" class="form-control task-name" placeholder="Start typing here to create a task..."
                       aria-describedby="basic-addon1">
                <span class="input-group-btn">
                    <button @click="addTask(taskName)" class="btn btn-default add-task" type="button">Add task</button>
                </span>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {taskName:''}
        },
        props: ['project'],
        methods: {
            addTask: function (taskName) {
                this.$emit('create-task', taskName);
            }
        }
    }

</script>
