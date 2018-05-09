import React, { Component } from 'react'

import './style.css'

class StuffSlot extends Component {
  constructor(props) {
    super(props)
    this.onClickFunction = this.onClickFunction.bind(this)
  }

  onClickFunction() {
    this.props.callBack(this.props.object)
  }

  /* Style qui varie en fonction du focus */
  render () {
    const { object } = this.props
    return (
      <div className={'slot' + (this.props.isEquiped? ' equiped':'')} onClick={ this.onClickFunction }>
        { object != null? <img className='item-image' alt={object.name} src={'./images/inventory/'+ object.name + '.png'} /> : "" }
      </div>
    )
  }
}

export default StuffSlot
