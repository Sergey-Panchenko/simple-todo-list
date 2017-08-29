<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Todo List</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="/css/main.css">

    {{--Scripts--}}
    <script src="http://code.jquery.com/jquery-3.0.0.js"
            integrity="sha256-jrPLZ+8vDxt2FnE1zvZXCkCcebI/C8Dt5xyaQBjxQIo="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue"></script>
</head>
<body>
<div class="container project" id="project">
    <div class="page-header center">
        <h3>TODO LIST </h3>
    </div>
    <div v-for="project in projects">
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <span class="navbar-brand glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <p class="navbar-text">@{{project.name}}</p>
                        <button type="button" class="btn btn-default navbar-btn navbar-right" aria-label="Left Align">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-default navbar-btn navbar-right" aria-label="Left Align">
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
                    <input type="text" class="form-control task-name" placeholder="Start typing here to create a task"
                           aria-describedby="basic-addon1">
                    <span class="input-group-btn">
                    <button class="btn btn-default add-task" type="button">Add task</button>
                </span>
                </div>
            </form>
        </div>
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
    </div>


</div>


<script src="{{ mix('/js/all.js') }}"></script>
</body>
</html>
