<template>
    <!--Is like if statement-->
    <div @dblclick="$emit('toogle-reminder', task.id)" :class="[task.reminder ? 'reminder' : '', ]" >
        <h3>{{ task.text }}
            <i @click="$emit('delete-task', task.id)" class="fas fa-times"></i>
        </h3>
        <p>{{task.day}}</p>
    </div>
</template>

<script>
    export default {
        name:'Task',
        props: {
            task: Object
        }
    }
</script>

<style scoped>

    .reminder {
        border-left: 5px solid green;
    }

    .fas {
        color: red;
        float: right;
        cursor: pointer;
    }

    .fas:hover {
        transform: scale(1.5)
    }

    div {
        background-color: #d2e1e7;
        padding: 0.1em 1em;
        margin: 0.5em 0;
        box-sizing: border-box;
        border-radius: 0.2em;

    }

</style>