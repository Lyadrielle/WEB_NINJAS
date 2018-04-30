import React, { Component } from 'react'

import './style.css'

class Button extends Component {
  render () {
    const { callBack } = this.props
    const { title } = this.props
    const { image } = this.props

    return (
      <div>
         <button className="button" type="button" onClick={ callBack }>
         {image!=null? <img src = { image } alt="button-image"/> : "" }
         { title }
         </button> 
      </div>
    )
  }
}

export default Button