import React from 'react';

import OrderViewingDataTable from './OrderViewingDataTable';
import OrderEntryForm from './OrderEntryForm';
import ApiHelper from '../ApiHelper';
import OrderContainer from '../types/OrderContainer';

export default class OrderEditingPage extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            orderContainer: new OrderContainer(),
            orderBeingEdited: null,
            isEditingExistingOrder: false,
            isFormHidden: true,
            // buttonText: "Create New Order",
        }
    }

    componentDidMount() {
        ApiHelper.GetOrderContainer().then(orderContainer => this.setState({orderContainer: orderContainer}));
    }

    onEditOrderClicked = (orderId) => {
        var order = this.state.orderContainer.getOrderById(orderId);
        this.setState({
            orderBeingEdited: order,
            isEditingExistingOrder: true,
            isFormHidden: false,
        });
    }

    getButtonText() {
        return this.state.isFormHidden ? "Create New Order" : "Cancel Editing Order";
    }

    getButtonClass() {
        return this.state.isFormHidden ? "btn btn-block btn-success" : "btn btn-block btn-danger";
    }

    onButtonClicked = () => {
        if (!this.state.isFormHidden) {
            this.setState({
                orderBeingEdited: null,
                isEditingExistingOrder: false,
                isFormHidden: true,
            });
        }
        else {
            this.setState({
                isFormHidden: false,
            });
        }
    }

    render() {
        return (
        	<div>
                <div className="container">
                    <OrderEntryForm
                        isHidden={this.state.isFormHidden}
                        isEditingExistingOrder={this.state.isEditingExistingOrder}
                        shouldOverrideTimeslotFull={true}
                        orderBeingEdited={this.state.orderBeingEdited}
                        orderContainer={this.state.orderContainer}>
                    </OrderEntryForm>

                    <div className="col-md-6 col-md-offset-3">

                        <br />
                        <button 
                            className={this.getButtonClass()}
                            onClick={this.onButtonClicked}
                        >
                            {this.getButtonText()}
                        </button>
                    </div>
                </div>
	            <OrderViewingDataTable
	            	isEditingTable={true}
	            	filterDay=""
	            	filterTime=""
                    onEditOrderClicked={this.onEditOrderClicked}
	            	orderContainer={this.state.orderContainer}>
	            </OrderViewingDataTable>
            </div>
        );
    }
}