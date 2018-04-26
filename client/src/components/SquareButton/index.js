import React, { Component } from 'react'

import './style.css'

class SquareButton extends Component {
  render () {
    const { callBack } = this.props
    const { title } = this.props
    const { image } = this.props

    return (
      <div>
         <button type="button" onClick={ callBack }>
         {image==null? <img src = { image } alt="button-image"/> : "" }
         </button> 
         <h3>{ title }</h3>
      </div>
    )
  }
}

export default Button