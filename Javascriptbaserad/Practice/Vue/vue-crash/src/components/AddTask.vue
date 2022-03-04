<template>
    <form @submit="onSubmit">
        <label for="text">Task</label> 
        <input type="text" name="text" v-model="text">

        <label for="day">Date</label> 
        <input type="date" name="day" v-model="day">
        
        <label for="reminder">Reminder</label> 
        <input type="radio" name="reminder" v-model="reminder">

        <input type="submit" value="Add Task">
    </form>
</template>

<script>
    export default {
        name: 'AddTask',
        data() {
            return {
                text: '',
                day: '',
                reminder: false
            }
        },
        methods: {
            onSubmit(e) {
                e.preventDefault()

                //Validations
                if(!this.text) { 
                    alert('Please add a task') 
                    return
                }

                //Collect values
                const newTask = {
                    id: Math.floor(Math.random() * 100000),
                    text: this.text,
                    day: this.day,
                    reminder: this.reminder
                }

                //Send task away
                this.$emit('add-task', newTask)

                //Clear form
                this.text = '',
                this.day = '',
                this.reminder = false

            }
        }
    }
</script>


<style scoped>

input[type=radio] {
    width: auto;
    margin: 0.5em 0.1em;
}

form {
    box-sizing: border-box;
    margin: 2em 0;

    border: 2px solid #999;
    padding: 3em;
}

input {
    display: inline-block;
    width: 100%;
    padding: 0.5em 0;
    margin-bottom: 2em;

    font-size: 1em;

    border: none;
    border-bottom: 2px solid #999;
}

input:focus {
    background-color: #eee;
    outline: none;
    box-shadow: 0 0 2.5px 0 #eee;
}


label {
    color: #999;
    font-size: 0.9em;
}

input[type=submit] {
    border: none;
    border-radius: 0.25rem;
    padding: 0.5em;
    cursor: pointer;

    width: 100%;
    display: block;
    margin: 1em 0;

}


input[type=submit]:hover {
    background-color: rgb(178, 240, 166);
}


select {
    font-size: 1.1em;
    padding: 0.5em;
    width: 100%;
    margin-top: 0.3em;
    margin-bottom: 3em;
    box-sizing: border-box;
    cursor: pointer;
    border: 1px solid #999;
}

span {
    display: inline-block;
    width: 100%;
    color: #cd0000;
    margin-bottom: 2em;
    font-size: 0.9em;
    font-weight: bold;
}


textarea {
    width: 100%;
    height: 150px;
    padding: 0.5em 0.2em;
    box-sizing: border-box;
    border: 2px solid £999;
    border-radius: 4px;
    resize: none;
    font-size: 1em;
}


.form-check-label { 
    margin: 1em 0;
}


</style>