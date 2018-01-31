import React from 'react';

// Integration DataTables with React
// https://medium.com/@zbzzn/integrating-react-and-datatables-not-as-hard-as-advertised-f3364f395dfaimport ApiHelper from '../ApiHelper';

import ApiHelper from '../ApiHelper';
import OrderContainer from '../types/OrderContainer';

const $ = require('jquery');
// $.DataTable = require('datatables.net');

require('datatables.net-bs');
require('datatables.net-responsive-bs');
// require('datatables.net-responsive');

export default class OrderViewingDataTable extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            orderContainer: new OrderContainer(),
        }
    }

    componentDidMount = () => {
        $(this.refs.main).DataTable({
            dom: '<"#data-table-wrapper"iftlp>',
            data: this.state.orderContainer.toDataTablesData(),
            columns: OrderContainer.dataTableColumnsConfig(),
            ordering: true,
            responsive: true,
        });

        // $('#data-table-wrapper table').addClass('responsive').addClass('display').addClass('datatable');

        ApiHelper.GetOrderContainer().then(this.onOrderContainerLoaded);
    }

    componentWillUnmount(){
       $('#data-table-wrapper')
           .find('table')
           .DataTable()
           .destroy(true);
    }

    shouldComponentUpdate(nextProps, nextState) {
        // Instead of modifying/rerendering the React component, just forward the data to DataTables to handle update.
        const table = $('#data-table-wrapper')
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
            <table 
                ref="main" 
                className="display table table-striped table-bordered"
                cellSpacing="0" 
                width="100%">
            </table>
        );
    }
}