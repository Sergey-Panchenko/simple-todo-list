<template>
    <div class="container registration-container">
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input v-model="name" type="text" class="form-control" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input v-model="email" type="text" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input v-model="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm password</label>
                <input v-model="confirmPassword" type="password" class="form-control" id="confirm-password" placeholder="Confirm password">
            </div>
            <div class="form-group">
                <button @click="registration" class="center-block btn btn-danger">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
    import bus from '../../bus';
    export default {
        data: function () {
            return {
                name: '',
                email: '',
                password: '',
                confirmPassword: '',
            }
        },
        methods: {
            registration: function (e) {
                e.preventDefault();
                let self = this;
                let dataToast = {
                    position: 'topLeft',
                    transitionIn: 'bounceInRight',
                };
                axios.post('/register', {
                    name: self.name,
                    email: self.email,
                    password: self.password,
                    password_confirmation: self.confirmPassword,
                }).then(function (response) {
                    bus.$emit('logged', response.data);
                }).catch(function (error) {
                    if (error.response) {
                        $.each(error.response.data, function (i, key) {
                            dataToast.message = key;
                            bus.$emit('show-toast', 'error', dataToast);
                        });
                    }
                    console.log(error);
                });
            }
        }
    }
</script>
