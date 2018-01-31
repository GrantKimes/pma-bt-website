import React from 'react';
import {BrowserRouter, Route, Switch} from 'react-router-dom';
import {hashHistory} from 'react-router';

import OrderEntryPage from './components/OrderEntryPage';
// import OrderViewingTable from './components/OrderViewingTable';
import OrderViewingPage from './components/OrderViewingPage';
import OrderEditingPage from './components/OrderEditingPage';

import HomePage from './components/HomePage';

const CURRENT_PAGE = window.CURRENT_PAGE || null;

class App extends React.Component {

  render() {
    return (
        <BrowserRouter basename="/sv">
            <Switch>
                <Route path="/order" component={OrderEntryPage} />
                <Route path="/view" component={OrderViewingPage} />
                <Route path="/edit" component={OrderEditingPage} />
                <Route path="/" component={HomePage} />
            </Switch>
        </BrowserRouter>
    );
  }
}

export default App;
