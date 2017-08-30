<template>
    <form>
        <div class="alert alert-danger" role="alert" v-for="error in errors">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span> {{error}}
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input v-model="userName" type="text" class="form-control" id="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input v-model="userEmail" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input v-model="password" type="password" class="form-control" id="exampleInputPassword1"
                   placeholder="Password">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword2">Confirm Password</label>
            <input v-model="confirmPassword" type="password" class="form-control" id="exampleInputPassword2"
                   placeholder="Confirm password">
        </div>

        <button @click.prevent="register()" type="submit" class="btn btn-default">Submit</button>
    </form>
</template>

<script>
    export default {
        data: function () {
            return {
                userName: '',
                userEmail: '',
                password: '',
                confirmPassword: '',
                errors: [],
            }
        },
        methods: {
            register: function () {
                let self = this;
                let errors = this.errors;
                console.log(3434);
                axios.post('/register', {
                    name: this.userName,
                    email: this.userEmail,
                    password: this.password,
                    password_confirmation: this.confirmPassword,
                })
                    .then(function (response) {
                        self.$emit('logged', response.data);
                    })
                    .catch(function (error) {
                        if (error.response) {
                            errors.splice(0, errors.length);
                            $.each(error.response.data, function (i, key) {
                                errors.push(key);
                            });
                        }
                        console.log(error);
                    });
            },
        }
    }
</script>
