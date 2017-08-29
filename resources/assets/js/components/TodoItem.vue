<template>
    <li>
        {{ title }} - {{key}} - {{name}}
        <button v-on:click="$emit('remove')">X</button>
    </li>
</template>

<script>
    export default {
        mounted() {
            console.log('Component child mounted.')
        },
        props: ['title','key', 'name']
    }
</script>
