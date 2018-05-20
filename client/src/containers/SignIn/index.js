import React, { Component } from 'react'

import api from '../../common/api'

import './style.css'

class SignIn extends Component {

  state = {
    ninjaName: '',
    userName: '',
    password: '',
    error: false,
  }

  SignUp = event => {
    event.preventDefault()
    this.setState({ error: false })
    const { ninjaName, userName, password } = this.state
    api.signup(ninjaName, userName, password)
      .then(user => {
        this.props.logAction(user)
      })
      .catch((e) => {
        console.log(e)
        this.setState({ error: true })
      })
  }

  updateNinjaName = event => {
    this.setState({ ninjaName: event.target.value })
  }

  updateUserName = event => {
    this.setState({ userName: event.target.value })
  }

  updatePassword = event => {
    this.setState({ password: event.target.value })
  }

  render () {
    const { error } = this.state

    return (
      <div className="sign-up">
        <form onSubmit={this.signUp}>
          <div className = "text-Sign-up">
            <p>
              Inscris-toi pour jouer et entrainer ton ninja !<br />
              Sinon <a href="?signin=true">identifie toi</a> !
            </p>
          </div>
          <div>
            <span data-placeholder="Username"></span>
            <input type="text" name="username" placeholder="nom du ninja" onChange={this.updateNinjaName} />
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
         <div className="ninja-imgs-block">
          <img className="ninja-img-login" src="images/gifs/shuriken.gif" alt = "ninja is throwing shurikens"/>
        </div>
      </div>
    )
  }
}

export default SignIn