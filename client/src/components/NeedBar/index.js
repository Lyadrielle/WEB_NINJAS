import React, { Component } from 'react'

import './style.css'

class NeedBar extends Component {

  render () {
    const { percentage, color} = this.props

    return (
      <div className='needbar'
        style = {{
          'backgroundColor': '#f26c4f',
          'minWidth': '100px',
        }}
      >
        <div className='needbar'
          style={{
            'backgroundColor': `#${color}`,
            width: `${percentage}%`,
          }}>
        </div>
      </div>
    )
  }
}

export default NeedBar
