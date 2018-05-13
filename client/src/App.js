import React, { Component } from 'react';
// import { Route, BrowserRouter as Router } from 'react-router-dom'

import Login from './containers/Login'
import Dashboard from './containers/Dashboard'

class App extends Component {
  constructor (props) {
    super(props)
    this.state = {
      user: null,
    }
  }

  log = user => {
    this.setState({ user })
  }

  render() {
    const { user } = this.state

    return (
      <div>
        {user === null ? <Login/> : <Dashboard user={user} />}
      </div>
    );
  }
}

export default App;
