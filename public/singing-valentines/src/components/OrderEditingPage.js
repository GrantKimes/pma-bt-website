import React from 'react';

import OrderViewingDataTable from './OrderViewingDataTable';
import ApiHelper from '../ApiHelper';
import OrderContainer from '../types/OrderContainer';

export default class OrderEditingPage extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            orderContainer: new OrderContainer(),
        }
    }

    componentDidMount() {
        ApiHelper.GetOrderContainer().then(orderContainer => this.setState({orderContainer: orderContainer}));
    }

    render() {
        return (
        	<div>
	            <OrderViewingDataTable
	            	isEditing={true}
	            	filterDay=""
	            	filterTime=""
	            	orderContainer={this.state.orderContainer}>
	            </OrderViewingDataTable>
            </div>
        );
    }
}