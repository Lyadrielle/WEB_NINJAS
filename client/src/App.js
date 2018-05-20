import React, { Component } from 'react';
// import { Route, BrowserRouter as Router } from 'react-router-dom'

import Login from './containers/Login'
import SignUp from './containers/SignUp'
import Dashboard from './containers/Dashboard'

class App extends Component {
  state = {
    user: null,
  }

  generateLogAction = () => {
    const setState = state => this.setState(state)
    return user => {
      setState({ user })
    }
  }

  render() {
    const { user } = this.state
    const signup = window.location.search.includes('signup')

    if (user) {
      return (<div><Dashboard user={user} /></div>)
    }

    if (signup) {
      return (<div><SignUp logAction={this.generateLogAction()}/></div>)
    }

    return <Login logAction={this.generateLogAction()}/>
  }
}

export default App
