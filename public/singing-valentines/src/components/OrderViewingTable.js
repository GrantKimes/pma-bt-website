import React from 'react';

import ApiHelper from '../ApiHelper';
import OrderTableRow from './OrderTableRow';
import OrderContainer from '../types/OrderContainer';

export default class OrderViewingTable extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            orderContainer: new OrderContainer()
        }
    }

    componentDidMount = () => {
        ApiHelper.GetOrderContainer().then(this.onOrderContainerLoaded);

    }

    onOrderContainerLoaded = (orderContainer) => {
        console.log(orderContainer);
        this.setState({orderContainer: orderContainer});
    }

    render() {
        return (
            <div className="row">
                <div className="col-md-12">
                    <table class="datatable display responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Location</th>
                                <th>Recipient Name</th>
                                <th>Sender Name</th>
                                <th>Sender Email</th>
                                <th>Song</th>
                                <th>Day</th>
                                <th>Timeslot</th>
                                <th>Comment</th>
                                {/*<th></th>*/}
                                <th>Order ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            {this.state.orderContainer.orders.map(order => <OrderTableRow order={order}></OrderTableRow>)}
                        </tbody>
                    </table>
                </div>
            </div>
        );
    }
}