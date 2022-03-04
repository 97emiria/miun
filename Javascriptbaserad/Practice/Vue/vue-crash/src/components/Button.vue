<template>
    <button @click="onClick()" :style="{background: color}" class="btn">{{text}}</button>
</template>

<script>
    export default {
        name: 'Button',
        props: {
            text: String,
            color: String
        },
        methods: {
            onClick() {
                this.$emit('btn-click')
            }
        }
    }
</script>


<style>
    .btn {
        background-color: #333;
        padding: 0.75em;
        border-radius: 0.2em;
        color: white;
        border: none;
    }

    .btn:hover {
        transform: scale(0.9);
        cursor: pointer;
    }

</style>