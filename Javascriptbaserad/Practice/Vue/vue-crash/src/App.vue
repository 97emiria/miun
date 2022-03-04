<template>
    <Header @toggle-add-task="toggleAddTask" title="Task tracker" :showAddTask="showAddTask" />
    <Tasks @toogle-reminder="toggleReminder" @delete-task="deleteTask" :tasks="tasks" />

    <section v-show="showAddTask">
        <AddTask @add-task="addTask" />
    </section>


</template>

<script>
    import Header from './components/Header'
    import Tasks from './components/Tasks'
    import AddTask from './components/AddTask'

    export default {
        name: 'App',
        components: {
            Header,
            Tasks,
            AddTask
        },
        data() {
            return {
               tasks: [],
               showAddTask: false
            }
        },
        methods: {
            deleteTask(id) {
                if(confirm('Are u sure?!')) {
                    this.tasks = this.tasks.filter((task) => task.id  !== id)
                }
            },
            toggleReminder(id) {
                this.tasks = this.tasks.map((task) => task.id === id ? {...task, reminder: !task.reminder} : task)
            },
            addTask(newTask) {
                this.tasks = [...this.tasks, newTask]
            },
            toggleAddTask() {
                this.showAddTask = !this.showAddTask
            }


        },
        created() {
            this.tasks = [
                {
                    id: 1, 
                    text: 'Meeting',
                    day: '3/10',
                    reminder: true
                },
                {
                    id: 2, 
                    text: 'Cooking',
                    day: '3/10',
                    reminder: true
                },
                {
                    id: 3, 
                    text: 'Baking',
                    day: '3/10',
                    reminder: false
                }
                
            ] 
        }
    }
</script>

<style>
    body {
        width: 90%;
        margin: 0 auto;
        padding: 1em 0;
        font-family: Calibri, 'Trebuchet MS', sans-serif;
    }
</style>
