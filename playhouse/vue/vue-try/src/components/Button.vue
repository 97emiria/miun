<template>
    <button @click="onClick()"> {{text}} </button>
</template>

<script>
    export default {
        name: 'Button',
        props: {
            text: String
        },
        components: {},
        methods: {
            onClick() {
                console.log('Clicked');
            }
        },

    }
</script>

<style scope>

    button {
        background-color: #333;
        color: white;
        padding: 1em 2em;
        border: none;
        border-radius: 0.2em;
    }

    button:hover {
        transform: scale(0.9);
        cursor: pointer;
        background-color: black;
    }

</style>