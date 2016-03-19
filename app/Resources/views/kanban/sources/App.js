import React from 'react';

import KanbanBoard from './KanbanBoard';

let cardList = [
    {
        id: 1,
        title: "Read a book",
        description: "I should read the **whole** book",
        status: "in-progress",
        color: "BD8D31",
        tasks: []
    },
    {
        id: 2,
        title: "Write some code",
        description: "Code along with the samples in this book. The complete source can be found at [github](https://github.com/pro-react)",
        status: "todo",
        color: "3A7E28",
        tasks: [
            {
                id: 1,
                name: "Contact list example",
                done: true
            },
            {
                id: 2,
                name: "Kanban example",
                done: false
            },
            {
                id: 3,
                name: "My own experiments",
                done: false
            }
        ]
    },
];

React.render(<KanbanBoard cards={cardList} />, document.getElementById('container'));
