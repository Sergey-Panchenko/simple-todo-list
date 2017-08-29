<template>
    <tr v-bind:class="{'is-completed-tr': task.is_completed}">
        <td width="10%">
            <div class="checkbox">
                <label style="font-size: 2.5em">
                    <input @click="taskUpdate(taskIndex)" type="checkbox" v-model="task.is_completed" :checked="task.is_completed">
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                </label>
            </div>
        </td>
        <td width="70%">
            <div class="input-group task-input">
                    <span class="input-group-addon add-icon">
                    </span>
                <input type="text" v-bind:class="{ 'is-completed': task.is_completed}" class="form-control task-title" aria-describedby="basic-addon1"
                       v-model="task.name" :disabled="!task.edit">
            </div>
        </td>
        <td width="20%" class="edit-task-buttons">
            <button v-if="task.edit" @click="taskUpdate(taskIndex)" type="button" class="btn btn-default navbar-btn edit" aria-label="Left Align">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            </button>
            <button v-if="!task.edit" type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-move" aria-hidden="true"></span>
            </button>
            <button v-if="!task.edit" @click="taskEdit(taskIndex)" type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            </button>
            <button v-if="!task.edit" @click="removeTask(taskIndex)" type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        methods: {
            removeTask: function (taskIndex) {
                this.$emit('remove-task', taskIndex);
            },
            taskUpdate: function (taskIndex) {
                this.$emit('update-task', taskIndex);
            },
            taskEdit: function (taskIndex) {
                this.$emit('edit-task', taskIndex);
            }
        },
        props: ['task','taskIndex']
    }
</script>
