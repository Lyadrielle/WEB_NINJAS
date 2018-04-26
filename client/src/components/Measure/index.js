import React, { Component } from 'react'

import './style.css'

class Measure extends Component {
  render () {
    const { color } = this.props
    const { measure } = this.props

    return (
      <div>
         <div className='measure-background'>
           <div className='measure-color' style={`backgroundColor: ${color}, width: ${measure}`}>
           </div>
         </div> 
      </div>
    )
  }
}

export default Measure