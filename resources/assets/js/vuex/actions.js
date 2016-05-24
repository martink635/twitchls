import Vue from 'vue'
import NProgress from 'nprogress'

const apiUrl = '/api/v1/'
const errorMessage = 'Something went wrong when connecting to the Twitch.tv Api. Please retry in a few seconds.'

function setErrorMessage(dispatch) {
  NProgress.done()
  dispatch('SET_ERROR', errorMessage)
}

function successfulRequest(dispatch) {
  dispatch('CLEAR_ERROR')
  NProgress.done()
  dispatch('LOADING', false)
}

export const setAuth = ({ dispatch }, identifier) => { dispatch('SET_AUTH', identifier) }
export const setQuery = ({ dispatch }, query) => { dispatch('SET_QUERY', query) }

export const getFollowed = ({ dispatch }, identifier) => {
  NProgress.start()
  Vue.http({ url: apiUrl + 'followed', method: 'GET',
    headers: {
      identifier,
      limit: 100,
      offset: 0
    }
  }).then((response) => {
    dispatch('RECEIVE_FOLLOWED', response.data)
    successfulRequest(dispatch)
  }, (response) => { setErrorMessage(dispatch) })
}

export const getStreams = ({ dispatch }, game, offset = 0) => {
  NProgress.start()
  dispatch('LOADING', true)

  Vue.http({ url: apiUrl + 'streams', method: 'GET',
    headers: {
      limit: 30,
      offset,
      game
    }
  }).then((response) => {
    if (offset === 0) dispatch('RECEIVE_STREAMS', response.data)
    else dispatch('RECEIVE_STREAMS', response.data, true)
    successfulRequest(dispatch)
  }, (response) => { setErrorMessage(dispatch) })

}

export const getGames = ({ dispatch }) => {

  Vue.http({ url: apiUrl + 'games', method: 'GET',
    headers: {
      limit: 100,
      offset: 0
    }
  }).then((response) => {
    var games = response.data.map((item) => {
      var label = item.name + ' (' + item.viewers + ')'
      return { label, key: item.name }
    })

    games.unshift({label: 'All games', key:''})

    dispatch('RECEIVE_GAMES', games)
    dispatch('CLEAR_ERROR')
  }, (response) => { setErrorMessage(dispatch) })
}

export const getFound = ({ dispatch }, query) => {
  if (!query) return

  NProgress.start()

  Vue.http({ url: apiUrl + 'search', method: 'GET',
    headers: {
      limit: 30,
      query
    }
  }).then((response) => {
    dispatch('RECEIVE_FOUND', response.data)
    successfulRequest(dispatch)
  }, (response) => { setErrorMessage(dispatch) })

}
