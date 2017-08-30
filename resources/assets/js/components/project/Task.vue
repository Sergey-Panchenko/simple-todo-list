<template>
    <tr v-bind:class="{'is-completed-tr': task.is_completed}" class="ui-state-default" :id="task.id" style="background: #fff !important;
    color: #000 !important;">
        <td width="10%">

            <div class="checkbox">
                <label style="font-size: 2.5em">
                    <input @click="taskUpdate(taskIndex)" type="checkbox" v-model="task.is_completed"
                           :checked="task.is_completed">
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                </label>
            </div>
        </td>
        <td width="70%">
            <div class="input-group task-input">
                    <span class="input-group-addon add-icon">
                    </span>
                <input type="text" v-bind:class="{ 'is-completed': task.is_completed}" class="form-control task-title"
                       aria-describedby="basic-addon1"
                       v-model="task.name" :disabled="!task.edit">
            </div>
        </td>
        <td width="20%" class="edit-task-buttons">
            <span v-if="task.edit" @click="taskUpdate(taskIndex)"  class="edit glyphicon glyphicon-ok"></span>
            <span v-if="!task.edit" class="glyphicon glyphicon-move"></span>
            <span  v-if="!task.edit" @click="taskEdit(taskIndex)"  class="glyphicon glyphicon-pencil"></span>
            <span v-if="!task.edit" @click="removeTask(taskIndex)"   class="glyphicon glyphicon-trash"></span>
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
        props: ['task', 'taskIndex']
    }
</script>
