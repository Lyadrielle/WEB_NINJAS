import React, { Component } from 'react'

import Button from '../../components/Button'
import './style.css'

import api from '../../common/api'

class LoginForm extends Component {

  state = {
    userName: '',
    password: '',
    error: false,
  }

  login = event => {
    event.preventDefault()
    this.setState({ error: false })
    const { userName, password } = this.state
    api.signin(userName, password)
      .then(user => {
        this.props.logAction(user)
      })
      .catch((e) => {
        console.log(e)
        this.setState({ error: true })
      })
  }

  updateUserName = event => {
    this.setState({ userName: event.target.value })
  }

  updatePassword = event => {
    this.setState({ password: event.target.value })
  }

  render() {
    const { error } = this.state
    return (
      <div>
        <form onSubmit={this.login}>
          <div className="text-login">
            Identifie-toi pour aller entrainer ton ninja !
              <p>
              Sinon <a href="">inscris toi</a> !
              </p>
          </div>
          <p>
            <span data-placeholder="Username"></span>
            <input type="text" name="username" placeholder="username" onChange={this.updateUserName} />
          </p>
          <p>
            <span data-placeholder="Password"></span>
            <input type="password" name="password" placeholder="password" onChange={this.updatePassword} />
          </p>
          <button>Login</button>
        </form>
        {error && (
          <p>Wrong username or password</p>
        )}
      </div>
    )
  }
}

export default LoginForm
