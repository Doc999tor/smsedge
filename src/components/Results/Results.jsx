import React, { Component } from 'react';
import './Results.css';
import Result from '../Result/Result'

export default class Results extends Component {

	render() {
		console.log(this.props.logs)
		return this.props.logs && this.props.logs.length ? (
			<table className="col-lg-6 col-md-12 col-sm-12 col-xs-12">
				<caption>Logs for selected period</caption>
				<thead>
					<tr>
						<th>Date</th>
						<th>Successfully sent</th>
						<th>Failed</th>
					</tr>
				</thead>
				<tbody>
				{
					this.props.logs && this.props.logs.map((log, i) => (
						<Result
							key={i}
							log={log}
						></Result>
					))
				}
				</tbody>
			</table>
		) : (<p>There is no SMS logs yet</p>)
	}
}
