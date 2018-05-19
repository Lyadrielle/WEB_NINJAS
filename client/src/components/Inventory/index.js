import React, { Component } from 'react'

import './style.css'
import StuffSlot from '../StuffSlot';
import Button from '../Button'

/**TODO : Focus sur le truc, différencier le stuff équipé du selectionné, faire un bouton déséquiper*/

class Inventory extends Component {
  constructor(props) {
    super(props)
    this.state = {
      selectedObject: null,
      equipedObject: null
    }
  }

  displayEmptySlots = (nbr) => {
    let slots = [];
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

  equip = () => {
    this.setState({ equipedObject: this.state.selectedObject })
    /**TODO : 
     * Faire une fonction qui envoie l'objet à équiper au back
     */
  }

  unequip = () => {
    this.setState({ equipedObject: null })
    /**TODO :
     * Faire une fonction qui envoie un signal au back disant qu'on veut désequiper
     */
  }

  render(){
    const { objects } = this.props
    const { selectedObject, equipedObject } = this.state
    const maxItems = 12
    let emptySlots = maxItems - objects.length
    return (
      <React.Fragment>
        <div className='inventory-content'>
          {
            objects.map((item) => <StuffSlot isEquiped={item.equipped} callBack={this.selectObject} object={item} key={item.id} />)
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
              && equipedObject !== selectedObject
              && <img
                className='selected-item-image'
                src={'./images/inventory/' + equipedObject.name + '.png'}
                alt={equipedObject.name}
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
                {bonus.value >= 0? bonus.skill + ' +' + bonus.value : bonus.skill + ' ' + bonus.value }
              </p>) : ""}
            {selectedObject != null && equipedObject !== selectedObject && <Button title="ÉQUIPER" callBack={this.equip} />}
            {selectedObject != null && equipedObject === selectedObject && <Button title="DÉSÉQUIPER" callBack={this.unequip} />}
          </div>
        </div>
      </React.Fragment>
    )
  }
}

export default Inventory