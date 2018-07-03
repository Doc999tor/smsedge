import React, { Component } from 'react';
import './Form.css';

export default class Form extends Component {
	/**
	 * react on every change of 4 inputs
	 * @param  {event}   user input change event
	 * @return {void}
	 */
	updateLogs = e => {
		this.props.updateLogs(e.target.name, e.target.value);
	}

	render() {
		return (
			<form className="col-lg-6 col-md-12 col-sm-12 col-xs-12" id="form_container">
				<div className="form-group" id="countries_container">
					<label htmlFor="country_select">Country: </label>
					<select name="cnt_id" id="country_select"
						onChange={this.updateLogs}
					>
						<option value="" >Pls choose a country</option>
					{
						this.props.countries && this.props.countries.map(country => (
								<option
									key={country.cnt_id}
									value={country.cnt_id}
								>{country.cnt_title}</option>
							))
					}
					</select>
				</div>
				<div className="form-group" id="users_container">
					<label htmlFor="user_select">User: </label>
					<select name="usr_id" id="user_select"
						onChange={this.updateLogs}
					>
						<option value="" >Pls choose a user</option>
					{
						this.props.users && this.props.users.map(user => (
								<option
									key={user.usr_id}
									value={user.usr_id}
								>{user.usr_name}</option>
							))
					}
					</select>
				</div>

				<div className="form-group" id="from_container">
					<label htmlFor="start_input">From: </label>
					<input type="date" name="start" id="start_input" defaultValue={this.props.start} onChange={this.updateLogs} />
				</div>

				<div className="form-group" id="from_container">
					<label htmlFor="end_input">To: </label>
					<input type="date" name="end" id="end_input" defaultValue={this.props.end} onChange={this.updateLogs} />
				</div>
			</form>
		)
	}
}
