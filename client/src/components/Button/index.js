import React, { Component } from 'react'

import './style.css'

class Button extends Component {
  render() {
    const { title, image, disabled = false } = this.props

    return (
      <div>
        <button className='button' type='button' onClick={this.props.callBack} disabled={disabled}>
          {image != null ? <img src={image} alt='button' /> : ' '}
          {' ' + title}
        </button>
      </div>
    )
  }
}

export default Button
