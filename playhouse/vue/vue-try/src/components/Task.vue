<template>
    <!-- Tasks layout -->
    <div 
        @dblclick="$emit('toggle-reminder', task.id)" 
        class="listStyle" 
        :class="[task.reminder ? 'reminder' : '', 'task']"
    >
        
        <p>{{task.text}}
            <i class="fa fa-times" @click="$emit('delete-task', task.id)"></i>
        </p>
        <p>{{task.date}}</p>
    </div>
</template>


<script>
    export default {
        name: 'Task',
        props: {
            task: Object
        },
    }
</script>

<style >

    .fa {
        color: red;
        float: right;
    }

    .fa:hover {
        transform: scale(1.1);
        cursor: pointer;
    }

    .listStyle {
        margin: 1em 0;
        padding: 1em;
        background-color: #eee;

       
    }

    .listStyle:hover {
        background-color: #ddd;
        cursor: pointer;
    }

    p:first-child {
        font-weight: bold;
    }



    .reminder {
        border-left: 5px solid #333;
    }

</style>