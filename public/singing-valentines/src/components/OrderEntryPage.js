import React from 'react';

import OrderEntryForm from './OrderEntryForm';

export default class OrderEntryPage extends React.Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-12">
                        <OrderEntryForm></OrderEntryForm>
                    </div>
                </div>
            </div>
        );
    }
}