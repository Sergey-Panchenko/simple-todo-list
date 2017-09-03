<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Todo List</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    {{--CSS Libraries--}}
    <link href="{{asset('css/libraries/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/libraries/iziToast.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{--CSS Libraries--}}
    <link href="{{asset('css/todo.css')}}" rel="stylesheet">

</head>
<body>
<div id="app">
    @include('components.main-navbar')
    {{--VUE component--}}
        <component :projects="projects" :is="currentView" ></component>
    {{--VUE component--}}
    <div class="modal fade" id="modal-add-project" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >Creating a new project!</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-tasks"></span>
                        </button>
                        </span>
                        <input v-model="projectName" type="text" class="form-control" placeholder="Start typing here to create a project...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                    <button @click="createProject" type="button" class="btn btn-primary">CREATE</button>
                </div>
            </div>
        </div>
    </div>
</div>


{{--JS Libraries--}}
<script src="{{asset('js/libraries/jquery.min.js')}}"></script>
<script src="{{asset('js/libraries/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/libraries/bootstrap.min.js')}}"></script>
<script src="{{asset('js/libraries/iziToast.min.js')}}"></script>
<script src="{{asset('js/libraries/vue.min.js')}}"></script>
{{--JS Libraries--}}
<script>
    var user = <?php echo $user; ?>;
</script>

<script src="{{ mix('/js/todo.js') }}"></script>
</body>
</html>
