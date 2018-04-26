import React, { Component } from 'react'

import './style.css'
import Measure from '../Measure';

class MeasureNeed extends Component {
  render () {
    const { title } = this.props
    const { image } = this.props
    const { measure } = this.props

    return (
      <div>
        <h4>{ title }</h4>
        <img src= { image } alt="need-image"/>
        <Measure color = "orange" measure = "50"/>
      </div>
    )
  }
}

export default MeasureNeed