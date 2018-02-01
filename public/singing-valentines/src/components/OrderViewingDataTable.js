import React from 'react';

// Integration DataTables with React
// https://medium.com/@zbzzn/integrating-react-and-datatables-not-as-hard-as-advertised-f3364f395dfa

import OrderContainer from '../types/OrderContainer';
import Order from '../types/Order';
import EditOrderModal from './EditOrderModal';

const $ = require('jquery');
require('datatables.net-bs');
require('datatables.net-responsive-bs');

export default class OrderViewingDataTable extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            orderBeingEdited: null,
        }
    }

    componentDidMount = () => {
        $(this.refs.main).DataTable({
            dom: '<"#data-table-wrapper"iftlp>',
            columns: this.props.orderContainer.getDataTablesColumnsConfig(this.props.isEditing),
            data: this.props.orderContainer.toDataTablesData(this.props.isEditing),
            ordering: true,
            responsive: true,
        });
    }

    componentWillUnmount() {
       $('#data-table-wrapper')
           .find('table')
           .DataTable()
           .destroy(true);
    }

    shouldComponentUpdate = (nextProps, nextState) => {
        // Instead of modifying/rerendering the React component, have DataTables to handle update.
        console.log(nextProps);
        const table = $('#data-table-wrapper')
            .find('table')
            .DataTable();
        table.clear();
        table.rows.add(nextProps.orderContainer.toDataTablesData(this.props.isEditing));
        table.column('day:name').search(nextProps.orderContainer.dayToDTSearchFormat(nextProps.filterDay));
        table.column('time:name').search(nextProps.orderContainer.timeToDTSearchFormat(nextProps.filterTime));
        table.draw();
        console.log("Just filtered on:");
        console.log(nextProps.orderContainer.dayToDTSearchFormat(nextProps.filterDay));
        console.log(nextProps.orderContainer.timeToDTSearchFormat(nextProps.filterTime));


        // TODO: How to set this onClick handler for responsive layout, since buttons don't exist at that time
        let onEditOrderClicked = this.onEditOrderClicked.bind(this);
        $('.edit-button').on('click', function(event) {
            console.log("clicked edit for order " + event.target.dataset.orderId);
            onEditOrderClicked(Number(event.target.dataset.orderId));
        });
        return true;
    }

    onEditOrderClicked(orderId) {
        var order = this.props.orderContainer.getOrderById(orderId);
        console.log(order);
        this.setState({orderBeingEdited: order});
    }

    // Everythin inside the table element is not managed by React, just by DataTables
    render() {
        return (
            <div>
                <table 
                    ref="main" 
                    className="display table table-striped table-bordered"
                    cellSpacing="0" 
                    width="100%">
                </table>

                <EditOrderModal
                    orderBeingEdited={this.state.orderBeingEdited}
                    orderContainer={this.props.orderContainer}
                    ref="modal">
                </EditOrderModal>
            </div>
        );
    }
}