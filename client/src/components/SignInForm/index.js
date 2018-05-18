import React, { Component } from 'react'

import Button from '../../components/Button'

import './style.css'

class SignInForm extends Component {

  signin(){
    console.log("j'essaie de m'inscrire");
  }

  render () {
    return (
      <div>
        <form>
          <p>
            <div className = "text-SignIn">
              Inscris-toi pour jouer et entrainer ton ninja !
              <p>
                Déjà un compte ? <a href = "">Identifie toi</a> !
              </p>
            </div>
          </p>
          <p>
            <span data-placeholder="Username"></span>
            <input type="text" name="username" placeholder="Choisissez un pseudo"/>
          </p>
          <p>
            <span data-placeholder="Password"></span>
            <input type="password" name="password" placeholder="Entrez un mot de passe"/>
          </p>
          <Button title = "JOUER !" callBack={this.signin}/>
        </form>
      </div>
    )
  }
}

export default SignInForm