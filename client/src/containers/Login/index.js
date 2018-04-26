import React, { Component } from 'react'

import './style.css'

class Login extends Component {
  render () {
    return (
      <div>
        <form>
          <span data-placeholder="Username"></span>
          <input type="text" name="username" placeholder="username"/>
          <span data-placeholder="Password"></span>
          <input type="password" name="password" placeholder="password"/>
          <button>Login</button>
        </form>
      </div>
    )
  }
}

export default Login