import React, {Component} from 'react';

import KanbanBoard from './KanbanBoard';

import update from 'react-addons-update';

import 'babel-polyfill';

import 'whatwg-fetch';

const API_URL = 'http://192.168.100.21/kanban-reactjs/app_dev.php/API';

const API_HEADERS = {
	'content-type': 'application/json',
	'authorization': 'gnemes@gmail.com'
}

class KanbanBoardContainer extends Component
{
	constructor() {
		super();
		this.state = {
			cards:[]
		};
	}

	componentDidMount() {
		fetch(`${API_URL}/cards`, {headers: API_HEADERS})
			.then((response) => response.json())
			.then((responseData) => {
				this.setState({cards: responseData});
			})
			.catch((error) => {
				console.log('Error fetching and parsing data', error);
			});
	}

	addTask(cardId, taskName) {
		let cardIndex = this.state.cards.findIndex((card) => card.id == cardId);

		let prevState = this.state;

		let newTask = {id: Date.now(), name:  taskName, done: false};

		let nextState = update(this.state.cards, {
			[cardIndex]: {
				tasks: {$push:[newTask]}
			}
		});

		this.setState({cards: nextState});

		fetch(`${API_URL}/cards/${cardId}/tasks`, {
			method: 'post',
			headers: API_HEADERS,
			body: JSON.stringify(newTask)
		}).then((response) => {
			if (response.ok) {
				return response.json();
			} else {
				throw new Error("Server response wasnt OK");
			}
		}).then((responseData) => {
			newTask.id = responseData.id;
			this.setState({cards: nextState})
		}).catch((error) => {
			console.error("Fetch error: ", error);
			this.setState(prevState);
		});
	}

	deleteTask(cardId, taskId, taskIndex) {
	 	let cardIndex = this.state.cards.findIndex((card) => card.id == cardId);

        let prevState = this.state;

		let nextState = update(this.state.cards, {
			[cardIndex]: {
				tasks: {$splice:[[taskIndex,1]]}
			}
		});

		this.setState({cards:nextState});

		fetch(`${API_URL}/cards/${cardId}/tasks/${taskId}`, {
			method: 'delete',
			headers: API_HEADERS
		}).then((response) => {
			if (!response.ok) {
				throw new Error("Server response wasnt OK");
			}
		}).catch((error) => {
			console.error("Fetch error: ", error);
			this.setState(prevState);
		});
	}

	toggleTask(cardId, taskId, taskIndex) {
		let cardIndex = this.state.cards.findIndex((card) => card.id == cardId);

		let prevState = this.state;

		let newDoneValue;

		let nextState = update(this.state.cards, {
			[cardIndex]: {
				tasks: {
					[taskIndex]: {
						done: {
							$apply:(done) => {
								newDoneValue = !done;
								return newDoneValue;
							}
						}
					}
				}
			}
		});

		this.setState({cards:nextState});

		fetch(`${API_URL}/cards/${cardId}/tasks/${taskId}`, {
			method: 'put',
			headers: API_HEADERS,
			body: JSON.stringify({done:newDoneValue})
		}).then((response) => {
			if (!response.ok) {
				throw new Error("Server response wasnt OK");
			}
		}).catch((error) => {
			console.error("Fetch error: ", error);
			this.setState(prevState);
		});
	}

	render() {
		return <KanbanBoard cards={this.state.cards}
							tasksCallbacks={
								{
									toggle: this.toggleTask.bind(this),
									delete: this.deleteTask.bind(this),
									add: this.addTask.bind(this)
								}
							}/>
	}
}

export default KanbanBoardContainer;
