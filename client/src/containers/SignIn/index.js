import React, { Component } from 'react'
import SignInForm from '../SignInForm'
import DashboardBlock from '../DashBoardBlock'
import './style.css'

class SignIn extends Component {

  displaySignInBlock(){
    return <div><SignInForm/></div>
  }

  render () {
    return (
      <div className = "sign-in">
          <DashboardBlock title="Inscription" content={this.displaySignInBlock()}/>
      </div>
    )
  }
}

export default SignIn
