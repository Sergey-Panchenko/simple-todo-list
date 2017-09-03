<template>
    <div class="container login-container">
        <form>
            <div class="form-group">
                <label for="email">Email address</label>
                <input v-model="email" type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input v-model="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button @click="login" type="submit" class="center-block btn btn-danger">Submit</button>
            </div>

        </form>
    </div>
</template>

<script>
    import bus from '../../bus';
    export default {
        data: function () {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            login: function (e) {
                e.preventDefault();
                let self = this;
                let dataToast = {
                    position: 'topLeft',
                    transitionIn: 'bounceInRight',
                };
                axios.post('login', {
                    email: this.email,
                    password: this.password,
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
