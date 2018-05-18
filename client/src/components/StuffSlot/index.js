import React, { Component } from 'react'

import './style.css'

class StuffSlot extends Component {
  render () {
    const { object } = this.props
    return (
      <div className={'slot' + (this.props.isEquiped? ' equiped':'')} onClick={ () => this.props.callBack(this.props.object) }>
        { object != null? <img className='item-image' alt={object.name} src={'./images/inventory/'+ object.name + '.png'} /> : "" }
      </div>
    )
  }
}

export default StuffSlot