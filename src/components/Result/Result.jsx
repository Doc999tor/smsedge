import React, { Component } from 'react';
import './Result.css';

export default class Result extends Component {

	render() {
		return (
			<tr>
				<td>{this.props.log.date}</td>
				<td>{this.props.log.success_count}</td>
				<td>{this.props.log.success_fail}</td>
			</tr>
		)
	}
}
