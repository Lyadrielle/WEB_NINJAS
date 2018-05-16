import React, { Component } from 'react'
import LoginForm from '../LoginForm'
import DashboardBlock from '../DashBoardBlock'
import './style.css'

class Login extends Component {

  displayLoginBlock(){
    return <div><LoginForm logAction={this.props.logAction}/></div>
  }

  render () {
    return (
      <div className = "login">
          <DashboardBlock title="Login" content={this.displayLoginBlock()}/>
      </div>
    )
  }
}

export default Login
