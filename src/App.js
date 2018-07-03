import React, { Component } from 'react';
import 'bootstrap/dist/css/bootstrap.css';
import './App.css';
import Form from './components/Form/Form'
import Results from './components/Results/Results'
import { formatDate } from './services/formatDate'
import { getLogRequestQueryString } from './services/getLogRequestQueryString'

class App extends Component {
	constructor (props) {
		super(props);
		this.state = {
			users: [],
			countries: [],
			logs: [],
		}
		this.logRequestParams = {
			start: formatDate(new Date(Date.now() - 7 * 86400000)), // default a week ago
			end: formatDate(new Date()),
			usr_id: null,
			cnt_id: null,
		}
	}

	componentDidMount() {
		const users = fetch('http://localhost:9000/users');
		const countries = fetch('http://localhost:9000/countries');
		const logs = fetch('http://localhost:9000/logs' + getLogRequestQueryString(this.logRequestParams));
		Promise.all([users, countries, logs])
		.then(responses => Promise.all(
			responses.map(r => r.json())
		))
		.then(data => {
			const state = {
				users: data[0],
				countries: data[1],
				logs: data[2],
			}
			this.setState(Object.assign(this.state, state))
		})
	}
	/**
	 * reloads a log list with updated search criteria
	 * @param  {key}    usr_id|cnt_id|start|end
	 * @param  {value}  values
	 * @return {void}
	 */
	updateLogs = (key, value) => {
		Object.assign(this.logRequestParams, {[key]: value});
		fetch('http://localhost:9000/logs' + getLogRequestQueryString(this.logRequestParams))
		.then(response => response.json())
		.then(logs => this.setState(Object.assign(this.state, {logs})))
	}

	render() {
		return (
			<div className="container-fluid">
				<div className="row">
					<Form
						users={this.state.users}
						countries={this.state.countries}
						start={this.logRequestParams.start}
						end={this.logRequestParams.end}
						updateLogs={this.updateLogs}
					></Form>
					<Results
						logs={this.state.logs}
					></Results>
				</div>
			</div>
		);
	}
}

export default App;
