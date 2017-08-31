@extends('layouts.app')
@section('app')
<div class="container project" id="app">
    <div v-if="currentComponent == 'project'">
        <div class="alert alert-danger" role="alert" v-for="error in errors">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span> @{{error}}
        </div>
        <nav class="navbar navbar-default project-navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">TODO LIST</a>
                </div>
                <div class="collapse navbar-collapse">
                    <p class="navbar-text navbar-user">
                        <span class="glyphicon glyphicon-user" aria-hidden="true">&nbsp;@{{user.name}}</span>
                    </p>
                    <button @click="logout()" type="button" class="btn btn-default btn-lg navbar-right btn-logout" aria-label="Left Align">
                        <span class="glyphicon glyphicon glyphicon-log-out" aria-hidden="true"></span> LOG OUT
                    </button>
                    <form class="navbar-form navbar-right" v-on:submit.prevent="createProject(projectName)">
                        <div class="input-group">
                            <input style="width: 540px" v-model="projectName" type="text" class="form-control"
                                   placeholder="Start typing here to create a project...">
                            <span class="input-group-addon add-icon">
                            <span @keyup.enter.prevent="createProject(projectName)"
                                  @click.prevent="createProject(projectName)" class="glyphicon glyphicon-plus"
                                  aria-hidden="true"></span>
                        </span>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <project
        @update-project="handleUpdateProject"
        @edit-project="handleEditProject"
        @remove-project="handleRemoveProject"
        v-for="(project, projectIndex) in projects"
        :project-index="projectIndex"
        v-bind:project="project"
        v-bind:key="project.id"></project>
    </div>
    <auth v-if="currentComponent == 'auth'" @logged="handleLogged"></auth>
</div>
<script>
    var user = <?php echo $user; ?>;
</script>
@endsection
