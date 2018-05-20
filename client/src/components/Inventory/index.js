import React, { Component } from 'react'

import './style.css'
import StuffSlot from '../StuffSlot';
import Button from '../Button'
import api from '../../common/api'

/**TODO : Focus sur le truc, différencier le stuff équipé du selectionné, faire un bouton déséquiper*/

class Inventory extends Component {
  constructor(props) {
    super(props)
    this.state = {
      selectedObject: null,
    }
  }

  displayEmptySlots = (nbr) => {
    let slots = []
    for (let i = 0; i <= nbr; i++) {
      slots.push(<StuffSlot />)
    }
    return <div>{slots}</div>
  }

  selectObject = (item) => {
    if (item !== null) {
      this.setState({ selectedObject: item })
    }
  }

  equip = async (object) => {
    const { endDate, success } = await api.equipment(object.id)
    this.setState({ selectedObject:object})
  }

  unequip =  async (object) => {
    const { endDate, success } = await api.equipment(object.id)
    this.setState({ selectedObject:object})
  }

  getEquippedObject = () => {
    let equippedObject = null
    this.props.objects.forEach(object => {
      if(object.equipped) equippedObject = object
    }
  )
  return equippedObject
  }

  

  render(){
    const { objects } = this.props
    const { selectedObject } = this.state
    const maxItems = 12
    let emptySlots = maxItems - objects.length
    console.log("EQUIPPED")
    console.log(this.getEquippedObject())
    console.log("SELECTED")
    console.log(this.state.selectedObject)

    return (
      <React.Fragment>
        <div className='inventory-content'>
          {
            objects.map((item) => <StuffSlot callBack={this.selectObject} object={item} key={item.id} />)
          }

          {
            [...Array(emptySlots)].map((item, i) =>
              <StuffSlot callBack={this.selectObject} key={i} />
            )
          }
        </div>
        <div className='inventory-selector'>
          <div className='inventory-image-detail'>
            {selectedObject === null
              && this.getEquippedObject() !== selectedObject
              && this.getEquippedObject() != null
              && <img
                className='selected-item-image'
                src={'./images/inventory/' + this.getEquippedObject().name + '.png'}
                alt={this.getEquippedObject().name}
              />
            }
            {selectedObject != null
              && <img
                className='selected-item-image'
                src={'./images/inventory/' + selectedObject.name + '.png'}
                alt={selectedObject.name}
              />
            }

          </div>
          <div className = 'inventory-details'>
            {selectedObject != null ? selectedObject.bonus.map((bonus, i) =>
              <p key={i} className="item-bonus">
                {bonus.bonus >= 0? bonus.skill + ' +' + bonus.bonus : bonus.skill + ' ' + bonus.bonus }
              </p>) : ""}
            {selectedObject != null && this.getEquippedObject() ==null && <Button title="ÉQUIPER" callBack={() => this.equip(selectedObject)} />}
            {selectedObject != null && this.getEquippedObject() !=null && this.getEquippedObject().id !== selectedObject.id && <Button title="ÉQUIPER" callBack={() => this.equip(selectedObject)} />}
            {selectedObject != null && this.getEquippedObject()!=null && this.getEquippedObject().id == selectedObject.id && <Button title="DÉSÉQUIPER" callBack={() => this.unequip(selectedObject)} />}
          </div>
        </div>
      </React.Fragment>
    )
  }
}

export default Inventory