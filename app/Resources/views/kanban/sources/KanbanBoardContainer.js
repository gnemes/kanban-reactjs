import React, {Component} from 'react';

import KanbanBoard from './KanbanBoard';

import 'whatwg-fetch';

const API_URL = 'http://127.0.0.1/kanban-reactjs/app_dev.php/cards/';

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
		fetch(API_URL, {headers: API_HEADERS})
			.then((response) => response.json())
			.then((responseData) => {
				this.setState({cards: responseData});
			})
			.catch((error) => {
				console.log('Error fetching and parsing data', error);
			});
	}

	render() {
		return <KanbanBoard cards={this.state.cards}/>
	}
}

export default KanbanBoardContainer;
