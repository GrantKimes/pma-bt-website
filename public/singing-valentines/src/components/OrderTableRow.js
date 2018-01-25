import React from 'react';

export default class OrderTableRow extends React.Component {

    render() {
        return (
            <tr>
                <td>{this.props.order.location}</td>
                <td>{this.props.order.recipient_name}</td>
                <td>{this.props.order.sender_name}</td>
                <td>{this.props.order.sender_email}</td>
                <td>{this.props.order.song.title}</td>
                <td>{this.props.order.timeslot.day}</td>
                <td>{this.props.order.timeslot.start_time}</td>
                <td>{this.props.order.comment}</td>
                <td>{this.props.order.id}</td>
            </tr>
        );
    }
}