<template>
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="navbar-brand glyphicon glyphicon-calendar" aria-hidden="true"></span>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <p class="navbar-text">{{project.name}}</p>
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

</template>

<script>
    export default {
        props: ['project']
    }
</script>
