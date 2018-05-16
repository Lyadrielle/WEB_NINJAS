import React, { Component } from 'react'

import './style.css'

class NeedBar extends Component {

  render () {
    const { percentage, color} = this.props

    return (
      <div className='needbar'
        style = {{
          'background-color': '#3a3a3a',
          'min-width': '100px',
        }}
      >
        <div className='needbar'
          style={{
            'background-color': `#${color}`,
            width: `${percentage}%`,
          }}>
        </div>
      </div>
    )
  }
}

export default NeedBar
