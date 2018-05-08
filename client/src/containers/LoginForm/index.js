import React, { Component } from 'react'

import Button from '../../components/Button'
import './style.css'

class LoginForm extends Component {

  authentification(){
    console.log("j'essaie de m'authentifier");
  }

  render () {
    return (
      <div>
        <form>
          <p>
            Identifie-toi pour aller entrainer ton ninja !
          </p>
          <p>
            <span data-placeholder="Username"></span>
            <input type="text" name="username" placeholder="username"/>
          </p>
          <p>
            <span data-placeholder="Password"></span>
            <input type="password" name="password" placeholder="password"/>
          </p>
          <Button title = "LOGIN" callBack={this.authentification}/>
        </form>
      </div>
    )
  }
}

export default LoginForm
