import React from 'react';

import OrderViewingDataTable from './OrderViewingDataTable';
import ApiHelper from '../ApiHelper';
import OrderContainer from '../types/OrderContainer';
import DayAndTimeslotFilter from './DayAndTimeslotFilter';

export default class OrderViewingPage extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            orderContainer: new OrderContainer(),
            filterDay: "",
            filterTime: "",
        }
    }

    componentDidMount() {
        ApiHelper.GetOrderContainer().then(orderContainer => this.setState({orderContainer: orderContainer}));
    }

    onFilter = (day, time) => {
    	this.setState({filterDay: day});
    	this.setState({filterTime: time});
    }

    render() {
        return (
        	<div>
        		<DayAndTimeslotFilter
        			daysDropdownValues={this.state.orderContainer.getDaysDropdownValues()}
        			onChange={this.onFilter}
        			orderContainer={this.state.orderContainer}>
        		</DayAndTimeslotFilter>
	            <OrderViewingDataTable
	            	isEditing={false}
	            	filterDay={this.state.filterDay}
	            	filterTime={this.state.filterTime}
	            	orderContainer={this.state.orderContainer}
	            >
	            </OrderViewingDataTable>
            </div>
        );
    }
}