import React, { Component } from 'react';
import { Route, BrowserRouter as Router } from 'react-router-dom'

import Login from './containers/Login'
import Dashboard from './containers/Dashboard'

class App extends Component {
  constructor (props) {
    super(props)
    this.state = {
      logged: false,
    }
  }

  render() {
    const { logged } = this.state

    return (
      <div>
        {logged === false ? <Login/> : <Dashboard/>}
      </div>
    );
  }
}

export default App;
