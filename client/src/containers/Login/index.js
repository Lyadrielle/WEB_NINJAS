import React, { Component } from 'react'

import api from '../../common/api'

import './style.css'

class Login extends Component {
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
        <div className="login">
          <form onSubmit={this.login}>
            <div className="text-login">
              <p>
                Identifie-toi pour aller entrainer ton ninja !<br />
                Sinon <a href="?signup=true">inscris toi</a> !
              </p>
            </div>
            <div>
              <span data-placeholder="Username"></span>
              <input type="text" name="username" placeholder="pseudonyme" onChange={this.updateUserName} />
            </div>
            <div>
              <span data-placeholder="Password"></span>
              <input type="password" name="password" placeholder="mot de passe" onChange={this.updatePassword} />
            </div>
            <button>Login</button>
          </form>
          {error && (
            <p>Wrong username or password</p>
          )}
        </div>
        <div className="ninja-imgs-block">
          <img className="ninja-img-login" src="images/gifs/walking.gif" alt = "ninja is walking" />
        </div>
      </div>
    )
  }
}

export default Login