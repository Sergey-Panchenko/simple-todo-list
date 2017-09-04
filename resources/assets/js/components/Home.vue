<template>
    <div class="container home">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe id="ytplayer" type="text/html" width="720" height="405"
                    src="https://www.youtube.com/embed/ibGnjSKLqTc?start=16&autoplay=1&controls=0&fs=0&rel=0&end=25&showinfo=0"
                    frameborder="0" allowfullscreen>
            </iframe>
        </div>
    </div>
</template>

<script>
    import bus from '../bus';
    export default {
        created: function(){
            let dataToast = {
                title: 'Hello!',
                message: "Let's finish using notepads for your records!!!",
                position: 'bottomCenter',
                transitionIn: 'flipInX',
                transitionOut: 'flipOutX',
                progressBarColor: 'rgb(0, 255, 184)',
                layout:2,
                timeout: 7000,
                onClosed: function(){
                    dataToast.position = 'topLeft';
                    dataToast.title = 'Do it';
                    dataToast.message = 'Start using right now !!!';
                    dataToast.onClosed = function () {};
                    iziToast.warning(dataToast);
                },
            };
            iziToast.info(dataToast);
        },

        data: function () {
            return {userEmail: '', userPassword: '', errors: []}
        },
    }
</script>
