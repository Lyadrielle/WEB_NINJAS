import React, { Component } from 'react';
// import { Route, BrowserRouter as Router } from 'react-router-dom'

import Login from './containers/Login'
import SignIn from './containers/SignIn'
import Dashboard from './containers/Dashboard'

class App extends Component {
  constructor (props) {
    super(props)
    this.state = {
      user: null,
    }
  }

  generateLogAction = () => {
    const setState = state => this.setState(state)
    return user => {
      console.log(user)
      setState({ user })
    }
  }

  render() {
    const { user } = this.state

    return (
      <div>
        {user === null ? <Login logAction={this.generateLogAction}/> : <Dashboard user={user} />}
      </div>
    );
  }
}

export default App;
