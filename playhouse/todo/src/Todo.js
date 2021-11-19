import React from 'react'

export default function Todo({ todo, toggleTodo }) {

    let handleTodoClick = () => {
        toggleTodo(todo.id)
    }

    return (
        <div>
            <label>
                <input id={todo.id} type="checkbox" checked={todo.complete} onChange={handleTodoClick}/>
                {todo.name}
            </label>
        </div>
    )
}
