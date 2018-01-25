import React, { Component } from 'react';

import OrderEntryForm from './components/OrderEntryForm';
import OrderViewingTable from './components/OrderViewingTable';
import OrderViewingDataTable from './components/OrderViewingDataTable';


class App extends Component {

  render() {
    return (
      <div className="container">
        <OrderEntryForm></OrderEntryForm>
        {/*<OrderViewingTable></OrderViewingTable>*/}
        <OrderViewingDataTable></OrderViewingDataTable>
      </div>
    );
  }
}

export default App;
