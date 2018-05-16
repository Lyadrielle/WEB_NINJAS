import React, { Component } from 'react'
import NeedBar from '../NeedBar'

import './style.css'

class Needs extends Component {

  render () {
    const { needs } = this.props
    console.log(needs)

    return (
      <div>
        {Object.entries(needs).map(([label, need]) => {
            return (
              <div className='need'>
                <div>
                  <img
                    src = {`./images/needs/${label}.png`}
                    alt = {label}
                    style = {{
                      'background-color': 'black'
                    }}
                  ></img>
                </div>
                <div className='need-bar-container'>
                  <h5>{label}</h5>
                  <NeedBar
                    percentage = {need.value}
                    color = '7f7f7f'
                  />
                </div>
              </div>
            )
          })}
      </div>
    )
  }
}

export default Needs
