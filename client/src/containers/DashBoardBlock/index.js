import React, { Component } from 'react'

import './style.css'

class DashBoardBlock extends Component {
  render () {
    const { title } = this.props
    const { content } = this.props

    return (
      <div className='dashboard-block'>
        <h2>{ title }</h2>
        <div className='dashboard-content-block'>
          { content }
        </div>
      </div>
    )
  }
}

export default DashBoardBlock