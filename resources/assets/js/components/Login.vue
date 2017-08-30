<template>
    <form>
        <div class="alert alert-danger" role="alert" v-for="error in errors">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span> {{error}}
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input v-model="userEmail" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input v-model="userPassword" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button @click.prevent="login()" type="submit" class="btn btn-default">Submit</button>
    </form>
</template>

<script>
    export default {
        data: function () {
          return {userEmail: '', userPassword: '', errors: []}
        },
        methods: {
            login: function () {
                let self = this;
                let errors = this.errors;
                axios.post('login', {
                    email: this.userEmail,
                    password: this.userPassword,
                })
                    .then(function (response) {
                        self.$emit('logged', response.data);
                    })
                    .catch(function (error) {
                        if (error.response) {
                            errors.splice(0,errors.length);
                            $.each(error.response.data, function (i, key) {
                                errors.push(key);
                            });
                        }
                        console.log(error);
                    });
            }
        }
    }
</script>
