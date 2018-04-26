import React, { Component } from 'react'

import './style.css'

class LogOutUser extends Component {
  render () {
    const { user } = this.props
    return (
      <div>
        <p>{user.pseudo}</p>
        <img src="" alt="door"/><a>Log Out</a>
      </div>
    )
  }
}

export default LogOutUser