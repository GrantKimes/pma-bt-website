import React from 'react';

// Integration DataTables with React
// https://medium.com/@zbzzn/integrating-react-and-datatables-not-as-hard-as-advertised-f3364f395dfa

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
            columns: this.props.orderContainer.getDataTablesColumnsConfig(this.props.isEditingTable),
            data: this.props.orderContainer.toDataTablesData(this.props.isEditingTable),
            order: this.props.orderContainer.getDataTablesOrdering(this.props.isEditingTable),
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
        table.rows.add(nextProps.orderContainer.toDataTablesData(this.props.isEditingTable));
        table.column('day:name').search(nextProps.orderContainer.dayToDTSearchFormat(nextProps.filterDay));
        table.column('time:name').search(nextProps.orderContainer.timeToDTSearchFormat(nextProps.filterTime));
        table.draw();


        if (this.props.isEditingTable) {
            let onEditOrderClicked = this.props.onEditOrderClicked;
            $('.edit-button').on('click', function(event) {
                console.log("clicked edit for order " + event.target.dataset.orderId);
                onEditOrderClicked(Number(event.target.dataset.orderId));
            });
        }

        return true;
    }

    // onEditOrderClicked(orderId) {
    //     var order = this.props.orderContainer.getOrderById(orderId);
    //     console.log(order);

    //     this.setState({orderBeingEdited: order});
    // }

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
            </div>
        );
    }
}