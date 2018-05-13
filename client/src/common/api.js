import axios from 'axios'
import url from 'url'
import queryString from 'query-string'

const API_PORT = 8000
const CLIENT_PORT = 3000
const apiUrl = url.resolve(window.location.origin.replace(CLIENT_PORT, API_PORT), '/api')

const api = axios.create({
  baseURL: apiUrl,
  timeout: 5000,
})

async function request(method, url, data) {
  const queryParams = method.toLowerCase() === 'get' && data
    ? `?${queryString.stringify(data)}`
    : ''
  const { data: result } = await api.request({
    method,
    url: `${url}${queryParams}`,
    data,
    withCredentials: true,
  })
  return result
}

function signin(login, password) {
  return request('POST', '/signin', {
    pseudo: login,
    motdepasse: password,
  })
}

function signup(login, password, ninjaName) {
  return request('POST', '/signin', {
    pseudo: login,
    motdepasse: password,
    nom: ninjaName,
  })
}

export default {
  signin,
  signup,
}