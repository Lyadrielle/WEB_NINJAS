import React, { Component } from 'react'

import './style.css'
import StuffSlot from '../StuffSlot';
import Button from '../Button'

/**TODO : Focus sur le truc, différencier le stuff équipé du selectionné, faire un bouton déséquiper*/

class Inventory extends Component {
  constructor(props){
    super(props)
    this.state = {
      selectedObject:null,
      equipedObject:null
    }
    this.selectObject = this.selectObject.bind(this)
    this.equip = this.equip.bind(this)
    this.unequip = this.unequip.bind(this)


  }
  displayEmptySlots(nbr) {
    let slots = [];
    for (let i = 0; i <= nbr; i++) {
      slots.push(<StuffSlot />)
    }
    return <div>{slots}</div>
  }

 selectObject(item) {
    if(item !== null) {
      this.setState({ selectedObject:item })
    }
  }

  equip() {
    this.setState({equipedObject: this.state.selectedObject})
  }

  unequip(){
    this.setState({equipedObject: null})
  }

  render() {
    const { objects } = this.props
    const {selectedObject, equipedObject} = this.state
    const maxItems = 12
    let emptySlots = maxItems - objects.length
    console.log(selectedObject)
    return (
      <React.Fragment>
        <div className='inventory-content'>
          {
            objects.map((item) => <StuffSlot isEquiped={ item === equipedObject } callBack = { this.selectObject } object={item} key={item.name}/>)
          }

          {
            [...Array(emptySlots)].map((item, i) =>
              <StuffSlot callBack = { this.selectObject } key={i} />
            )
          }
        </div>
        <div className='inventory-selector'>
          <div className='inventory-image-detail'>
            { selectedObject === null
              && equipedObject !== selectedObject
              && <img
                className='selected-item-image'
                src = {'./images/inventory/' + equipedObject.name + '.png'}
                alt = {equipedObject.name}
              />
            } 
            { selectedObject !== null
              && <img
                className = 'selected-item-image'
                src = {'./images/inventory/' + selectedObject.name + '.png'}
                alt = {selectedObject.name}
              />
            } 
            
          </div>
          <div>
          { selectedObject !== null? <p className = "item-bonus">{selectedObject.bonus.skill + ' +' + selectedObject.bonus.value}</p> : "" }
          { selectedObject !== null && equipedObject !== selectedObject  && <Button title="ÉQUIPER" callBack = {this.equip} /> } 
          { selectedObject !== null && equipedObject === selectedObject  && <Button title="DÉSÉQUIPER" callBack = {this.unequip} /> }
          </div>
        </div>
      </React.Fragment>
    )
  }
}

export default Inventory