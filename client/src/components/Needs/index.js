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
              <div className='need' key = {label}>
                <div>
                  <img
                    src = {`./images/needs/${label}.png`}
                    alt = {label}
                    style = {{
                      'backgroundColor': '40D1D8'
                    }}
                  ></img>
                </div>
                <div className='need-bar-container'>
                  <h5>{label}</h5>
                  <NeedBar
                    percentage = {need.value}
                    color = 'F7D260'
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
