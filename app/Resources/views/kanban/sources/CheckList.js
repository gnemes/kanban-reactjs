import React, {Component} from 'react';

class CheckList extends Component
{
    render() {
        let tasks = this.props.tasks.map((task) => (
            <li key={task.id} className="checklist_task">
                <input type="checkbox" defaultChecked={task.done}/>
                {task.name}
                <a href="#" className="checklist_task-remove"/>
            </li>
        ));

        return (
            <div className="checklist">
                <ul>{tasks}</ul>
                <input type="text" className="checklist--add-task" placeholder="Type and hit enter to add a new task"/>
            </div>
        );
    };
};

CheckList.propTypes = {
    cardId: PropTypes.number,
    tasks: PropTypes.arrayOf(PropTypes.object)
};

export default CheckList;
