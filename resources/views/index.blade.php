<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Todo List</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.0/css/iziModal.min.css">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
    <script src="http://code.jquery.com/jquery-3.0.0.js"
            integrity="sha256-jrPLZ+8vDxt2FnE1zvZXCkCcebI/C8Dt5xyaQBjxQIo="
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.0/js/iziModal.min.js"></script>
    <script src="https://unpkg.com/vue"></script>
</head>
<body>

<div class="container project" id="app">
    <div v-if="currentComponent == 'project'">
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
    var projects = <?php echo $projects; ?>;
</script>
<script src="{{ mix('/js/all.js') }}"></script>
</body>
</html>
