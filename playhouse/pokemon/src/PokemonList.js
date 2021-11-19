import React from 'react'
import { v4 as uuidv4 } from 'uuid';

export default function PokemonList({ pokemon }) {
    return (
        <div>
            {pokemon.map(p => (
                <div key={uuidv4()}> {p} </div>
            ))}
        </div>
    )
}
