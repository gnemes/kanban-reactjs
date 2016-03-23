import React, {Component, PropTypes} from 'react';

class CheckList extends Component
{
    checkInputKeyPress(evt) {
        if (evt.key === 'Enter') {
            this.props.tasksCallbacks.add(null, this.props.cardId, evt.target.value);
            evt.target.value = "";
        }
    }

    render() {
        let tasks = this.props.tasks.map((task, taskIndex) => (
            <li key={task.id} className="checklist_task">
                <input type="checkbox"
                       defaultChecked={task.done}
                       onChange={this.props.tasksCallbacks.toggle.bind(null, this.props.cardId, task.id, taskIndex)}/>
                {task.name}
                <a href="#"
                   className="checklist_task-remove"
                   onClick={this.props.tasksCallbacks.delete.bind(null, this.props.cardId, task.id, taskIndex)}/>
            </li>
        ));

        return (
            <div className="checklist">
                <ul>{tasks}</ul>
                <input type="text"
                       className="checklist--add-task"
                       placeholder="Type and hit enter to add a new task"
                       onKeyPress={this.checkInputKeyPress.bind(this)}/>
            </div>
        );
    };
};

CheckList.propTypes = {
    cardId: PropTypes.number,
    tasks: PropTypes.arrayOf(PropTypes.object),
    tasksCallbacks: PropTypes.object
};

export default CheckList;
