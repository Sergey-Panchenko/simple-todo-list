<template>
    <div class="row">
        <table class="table table-bordered">
            <tbody>
            <tr v-for="task in project.tasks">
                <td width="10%">
                    <div class="checkbox">
                        <label style="font-size: 2.5em">
                            <input type="checkbox">
                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                        </label>
                    </div>
                </td>
                <td width="70%">
                    <div class="input-group task-input">
                    <span class="input-group-addon add-icon">
                    </span>
                        <input type="text" class="form-control task-title" aria-describedby="basic-addon1"
                               :value="task.name" disabled>
                    </div>
                </td>
                <td width="20%" class="edit-task-buttons">
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-move" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
