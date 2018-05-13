import React, { Component } from 'react'

import './style.css'

class Button extends Component {

  constructor(props) {
    super(props)
    this.disableButton = this.disableButton.bind(this)
    this.state = {
      disabled:false
    }
  }

  disableButton(){
    console.log("disableButton")
    console.log(this.state.disabled)
    this.setState({disabled: true})
    setTimeout(function(){
      console.log(this.state.disabled)
      if(this.state.disabled === true){
        setTimeout(function(){this.setState({disabled:false})}.bind(this), 3000) // changer ici le temps de désactivation du bouton
      }
    }.bind(this), 1000) // pour laisser le temps à setState de mettre à jour --> Asynchrone
    this.props.callBack()
  }

  render () {
    const { callBack, title, image } = this.props

    return (
      <div>
         <button className='button' type='button' onClick={ this.disableButton } disabled={this.state.disabled}>
         {image != null ? <img src = { image } alt='button-image'/> : ' ' }
         {' ' + title}
         </button>
      </div>
    )
  }
}

export default Button
