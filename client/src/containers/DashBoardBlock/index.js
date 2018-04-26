import React, { Component } from 'react'

import './style.css'

class DashBoardBlock extends Component {
  render () {
    const { title } = this.props
    const { content } = this.props

    return (
      <div>
        <h2>{ title }</h2>
        { content }
      </div>
    )
  }
}

export default DashBoardBlock