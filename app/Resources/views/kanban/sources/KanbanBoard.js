import React, {Component, PropTypes} from 'react';

import List from './List';

class KanbanBoard extends Component
{
    render() {
        return (
            <div className="app">
                <List id="todo"
                      title="To-Do"
                      cards={
                        this.props.cards.filter((card) => card.status === "todo")
                      }
                      tasksCallbacks={
                          this.props.tasksCallbacks
                      }/>
                <List id="in-progress"
                      title="WIP"
                      cards={
                        this.props.cards.filter((card) => card.status === "in-progress")
                      }
                      tasksCallbacks={
                          this.props.tasksCallbacks
                      }/>
                <List id="done"
                      title="Done"
                      cards={
                        this.props.cards.filter((card) => card.status === "done")
                      }
                      tasksCallbacks={
                          this.props.tasksCallbacks
                      }/>
            </div>
        )
    };
};

KanbanBoard.propTypes = {
    Cards: PropTypes.arrayOf(PropTypes.object),
    tasksCallbacks: PropTypes.object
};

export default KanbanBoard;
