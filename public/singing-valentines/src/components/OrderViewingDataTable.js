import React from 'react';

// Integration DataTables with React
// https://medium.com/@zbzzn/integrating-react-and-datatables-not-as-hard-as-advertised-f3364f395dfa

const $ = require('jquery');
require('datatables.net-bs');
require('datatables.net-responsive-bs');

export default class OrderViewingDataTable extends React.Component {

    componentDidMount = () => {
        $(this.refs.main).DataTable({
            dom: '<"#data-table-wrapper"iftlp>',
            columns: this.props.orderContainer.getDataTablesColumnsConfig(this.props.isEditingTable),
            data: this.props.orderContainer.toDataTablesData(this.props.isEditingTable),
            order: this.props.orderContainer.getDataTablesOrdering(this.props.isEditingTable),
            ordering: true,
            responsive: true,
        });

        const table = $('#data-table-wrapper')
            .find('table')
            .DataTable();

        if (this.props.isEditingTable) {
            let onEditOrderClicked = this.props.onEditOrderClicked;
            table.on('draw', function() {
                $('.edit-button').on('click', function(event) {
                    onEditOrderClicked(Number(event.target.dataset.orderId));
                });
            });
        }
    }

    componentWillUnmount() {
       $('#data-table-wrapper')
           .find('table')
           .DataTable()
           .destroy(true);
    }

    shouldComponentUpdate = (nextProps, nextState) => {
        // Instead of modifying/rerendering the React component, have DataTables to handle update.
        if (nextProps.orderContainer !== this.props.orderContainer) {
            const table = $('#data-table-wrapper')
                .find('table')
                .DataTable();
            table.clear();
            table.rows.add(nextProps.orderContainer.toDataTablesData(this.props.isEditingTable));
            table.column('day:name').search(nextProps.orderContainer.dayToDTSearchFormat(nextProps.filterDay));
            table.column('time:name').search(nextProps.orderContainer.timeToDTSearchFormat(nextProps.filterTime));
            table.draw();
        }

        return true;
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
            </div>
        );
    }
}