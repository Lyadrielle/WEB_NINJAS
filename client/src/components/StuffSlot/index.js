import React, { Component } from 'react'

import './style.css'

class StuffSlot extends Component {
  constructor(props) {
    super(props)
    this.state = {
      empty:true,
      focus:false,
      object: this.props.object
    }
  }

  /* Style qui varie en fonction du focus */
  render () {
    return (
      <div>
        {this.state.object != null? <img src={this.state.object.image} /> : "" }
      </div>
    )
  }
}

export default StuffSlot
