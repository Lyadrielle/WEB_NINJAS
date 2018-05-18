import React, { Component } from 'react'

import './style.css'
import Measure from '../Measure';

class MeasureLevel extends Component {
  render () {
    const { level } = this.props
    const { measure } = this.props

    return (
      <div>
        <h4>Level { level }</h4>
        <Measure color = "blue" measure = "50"/>
      </div>
    )
  }
}

export default MeasureLevel