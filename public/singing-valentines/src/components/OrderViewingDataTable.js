import React from 'react';

// Integration DataTables with React
// https://medium.com/@zbzzn/integrating-react-and-datatables-not-as-hard-as-advertised-f3364f395dfaimport ApiHelper from '../ApiHelper';

import ApiHelper from '../ApiHelper';
import OrderContainer from '../types/OrderContainer';

const $ = require('jquery');
$.DataTable = require('datatables.net');

export default class OrderViewingDataTable extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            orderContainer: new OrderContainer(),
        }
    }

    componentDidMount = () => {
        $(this.refs.main).DataTable({
            dom: '<"data-table-wrapper"iftlp>',
            data: this.state.orderContainer.toDataTablesData(),
            columns: OrderContainer.dataTableColumnsConfig(),
            ordering: true
        });

        ApiHelper.GetOrderContainer().then(this.onOrderContainerLoaded);
    }

    componentWillUnmount(){
       $('.data-table-wrapper')
           .find('table')
           .DataTable()
           .destroy(true);
    }

    shouldComponentUpdate(nextProps, nextState) {
        // Instead of modifying/rerendering the React component, just forward the data to DataTables to handle update.
        const table = $('.data-table-wrapper')
            .find('table')
            .DataTable();
        table.clear();
        table.rows.add(nextState.orderContainer.toDataTablesData());
        table.draw();
        return false;
    }


    onOrderContainerLoaded = (orderContainer) => {
        console.log(orderContainer);
        this.setState({orderContainer: orderContainer});
    }

    // Everythin inside the table element is not touched by React, just by DataTables
    render() {
        return (
            <div className="row">
                <div className="col-md-12">
                    <table ref="main"></table>
                </div>
            </div>
        );
    }
}