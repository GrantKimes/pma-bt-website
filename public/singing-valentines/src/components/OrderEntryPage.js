import React from 'react';

import OrderEntryForm from './OrderEntryForm';
import OrderContainer from '../types/OrderContainer';
import ApiHelper from '../ApiHelper';

export default class OrderEntryPage extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            orderContainer: new OrderContainer(),
        }
    }

    componentDidMount = () => {
        ApiHelper.GetOrderContainer().then(orderContainer => this.setState({orderContainer: orderContainer}));
    }


    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-primary">
                            <div className="panel-heading">
                                <h3 className=" panel-title">Place an Order for Singing Valentines</h3>
                            </div>
                            <div className="panel-body">
                                <p>We find the recipient during a class period and serenade them with a song, and deliver a rose for them.</p> 
                                <p>Each order costs $10, and can be paid with cash, Venmo (@JordanCraftPMA), or Paypal (SinfoniaBanking@gmail.com).</p> 
                                <p>If you have any questions, you can send an email to <strong>SV@BetaTauPMA.org</strong>.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="row">
                    <div className="col-md-12">
                        <OrderEntryForm
                            isEditingExistingOrder={false}
                            orderContainer={this.state.orderContainer}>
                        </OrderEntryForm>
                    </div>
                </div>
            </div>
        );
    }
}