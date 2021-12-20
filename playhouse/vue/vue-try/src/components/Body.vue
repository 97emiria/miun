<template>
    <div class="borderFrame">
            <h2> Tasks </h2>

        <div class="felix">
            <div>
                <AddTask />
            </div>
            <div>
                <Button text="Add" />
            </div>
        </div>

        <Tasks 
            @toggle-reminder="toggleReminder"
            @delete-task="deleteTask" 
            :tasks="tasks" />
    </div>
</template>

<script>
    import Button from './Button'
    import Tasks from './Tasks'
    import AddTask from './AddTask'

    export default {
        name: 'Body',
        components: {
            Button,
            Tasks,
            AddTask
        },

          data() {
            return {
                tasks: []
            }
        },

        methods: {
            deleteTask(id) {
                if(confirm('Are u sure?!')) {
                    this.tasks = this.tasks.filter((task) => task.id != id )
                }
            },
            toggleReminder(id) {
                this.tasks = this.tasks.map((task) => task.id === id ? { ...task, reminder: !task.reminder } : task)
                console.log(id)
            }
        },

        created() {
            this.tasks = [
                {
                    id: 1,
                    text: 'Läkar tid',
                    date: 'Mars 1, 14.30',
                    reminder: true,
                },
                {
                    id: 2,
                    text: 'Klipp tid',
                    date: 'April 1, 14.30',
                    reminder: true,
                },
                {
                    id: 3,
                    text: 'Bio',
                    date: 'Okt 10, 14.30',
                    reminder: false,
                },
            ]
        }
    }
</script>

<style>
    .borderFrame {
        border: 0.41px solid #ddd;
        padding: 1em;
    }


    .felix {
        display: flex;
        justify-content: space-between;
        margin: 2em 0;
        align-items: center;
    }

    .felix div:first-child {
        width: 80%;
    }

</style>