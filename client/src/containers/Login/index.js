import React, { Component } from 'react'
import LoginForm from '../LoginForm'
import DashboardBlock from '../DashBoardBlock'
import './style.css'

class Login extends Component {

  displayLoginBlock(){
    return <div><LoginForm/></div>
  }

  render () {
    return (
      <div className = "Login">
        <DashboardBlock title="Login" content={this.displayLoginBlock()}/>
      </div>
    )
  }
}

export default Login
