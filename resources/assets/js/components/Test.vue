<template>
    <div>
        <div v-for="project in projects">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <span class="navbar-brand glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <p class="navbar-text">{{project.name}}</p>
                            <button type="button" class="btn btn-default navbar-btn navbar-right"
                                    aria-label="Left Align">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-default navbar-btn navbar-right"
                                    aria-label="Left Align">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row create-task">
                <form>
                    <div class="input-group">
                <span class="input-group-addon add-icon">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </span>
                        <input type="text" class="form-control task-name"
                               placeholder="Start typing here to create a task"
                               aria-describedby="basic-addon1">
                        <span class="input-group-btn">
                    <button class="btn btn-default add-task" type="button">Add task</button>
                </span>
                    </div>
                </form>
            </div>
            <child :tasks="project.tasks"></child>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                lists: ['name-1', 'name-2', 'name-3'],
                title: 'tile parent',
                dataArr: [{'foo': 'bar'}],
                projects: projects,
            }
        }
    }
</script>
