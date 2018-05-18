import React, { Component } from 'react'

import './style.css'

class Menu extends Component {

  render () {
    return (
      <div className = "menu">
        {this.props.pseudo}
        <a href=""> <img src ="./images/logout.png" alt = "logout"/> Log out</a>
      </div>
    )
  }
}

export default Menu