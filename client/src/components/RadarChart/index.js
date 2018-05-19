import React, { Component } from 'react'

import { VictoryChart, VictoryTheme, VictoryLabel, VictoryGroup, VictoryArea, VictoryPolarAxis } from 'victory'

import './style.css'

class RadarChart extends Component {
  constructor(props) {
    super(props)
    const defaultCharacter = [{
      Force: 0,
      Sagesse: 0,
      Agilité: 0,
      Endurance: 0,
      Dissimulation: 0,
    }]
    this.state = {
      data: this.processData(defaultCharacter),
      maxima: this.getMaxima(defaultCharacter),
    }
  }

  updateCharacterData = (props = this.props) => {
    const {
      strength,
      agility,
      endurance,
      smartness,
      dissimulation
    } = props
    const characterData = [
      {
        Force: strength,
        Sagesse: smartness,
        Agilité: agility,
        Endurance: endurance,
        Dissimulation: dissimulation,
      }
    ]
    this.setState({
      data: this.processData(characterData),
      maxima: this.getMaxima(characterData)
    })
  }

  componentWillReceiveProps = (newProps) => {
    this.updateCharacterData(newProps)
  }

  getMaxima= (data) => {
    const groupedData = Object.keys(data[0]).reduce((memo, key) => {
      memo[key] = data.map((d) => d[key])
      return memo
    }, {})
    return Object.keys(groupedData).reduce((memo, key) => {
      memo[key] = 50
      return memo
    }, {})
  }

  processData = (data) => {
    const maxByGroup = this.getMaxima(data)
    const makeDataArray = (d) => {
      return Object.keys(d).map((key) => {
        return { x: key, y: d[key] / maxByGroup[key] }
      })
    }
    return data.map((datum) => makeDataArray(datum))
  }

  render() {
    return (
      <div className='skill-graph'>
      <VictoryChart polar
        theme={VictoryTheme.material}
        domain={{ y: [ 0, 1 ] }}
      >
        <VictoryGroup colorScale={["orange"]}
          style={{ data: { fillOpacity: 0.2, strokeWidth: 2 } }}
        >
          {this.state.data.map((data, i) => {
            return <VictoryArea key={i} data={data}/>
          })}
        </VictoryGroup>
      {
        Object.keys(this.state.maxima).map((key, i) => {
          return (
            <VictoryPolarAxis key={i} dependentAxis
              style={{
                axisLabel: { padding: 10, fontSize: '12px' },
                axis: { stroke: "none" },
                grid: { stroke: "grey", strokeWidth: 0.25, opacity: 0.5 }
              }}
              tickLabelComponent={
                <VictoryLabel labelPlacement="vertical"/>
              }
              labelPlacement="perpendicular"
              axisValue={i + 1} label={key}
              tickFormat={(t) => Math.ceil(t * this.state.maxima[key])}
              tickValues={[0.25, 0.5, 0.75]}
            />
          )
        })
      }
        <VictoryPolarAxis
          labelPlacement="parallel"
          tickFormat={() => ""}
          style={{
            axis: { stroke: "none" },
            grid: { stroke: "grey", opacity: 0.5 }
          }}
        />

      </VictoryChart>
      </div>
    )
  }
}

export default RadarChart
