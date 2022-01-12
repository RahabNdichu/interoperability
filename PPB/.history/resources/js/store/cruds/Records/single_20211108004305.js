function initialState() {
  return {
    entry: {
      id: null,
      doctor: '',
      doc: '',
      diagnose: '',
      description: '',
      weight: '',
      student_id: null,
      created_at: '',
      updated_at: '',
      deleted_at: ''
    },
    lists: {
      student: []
    },
    loading: false
  }
}

const route = 'records'

const getters = {
  entry: state => state.entry,
  lists: state => state.lists,
  loading: state => state.loading
}

const actions = {
    storeData({ commit, state, dispatch }) {
      commit('setLoading', true)
      dispatch('Alert/resetState', null, { root: true })

      return new Promise((resolve, reject) => {
        let params = objectToFormData(state.entry, {
          indices: true,
          booleansAsIntegers: true
        })
        axios
          .post(route, params)
          .then(response => {
            resolve(response)
          })
          .catch(error => {
            let message = error.response.data.message || error.message
            let errors = error.response.data.errors

            dispatch(
              'Alert/setAlert',
              { message: message, errors: errors, color: 'danger' },
              { root: true }
            )

            reject(error)
          })
          .finally(() => {
            commit('setLoading', false)
          })
      })
    },
    updateData({ commit, state, dispatch }) {
      commit('setLoading', true)
      dispatch('Alert/resetState', null, { root: true })

      return new Promise((resolve, reject) => {
        let params = objectToFormData(state.entry, {
          indices: true,
          booleansAsIntegers: true
        })
        params.set('_method', 'PUT')
        axios
          .post(`${route}/${state.entry.id}`, params)
          .then(response => {
            // commit('setEntry', response.data.data)
            resolve(response)
          })
          .catch(error => {
            let message = error.response.data.message || error.message
            let errors = error.response.data.errors

            dispatch(
              'Alert/setAlert',
              { message: message, errors: errors, color: 'danger' },
              { root: true }
            )

            reject(error)
          })
          .finally(() => {
            commit('setLoading', false)
          })
      })
    },
  setDoctor({ commit }, value) {
    commit('setDoctor', value)
  },
  setDoc({ commit }, value) {
    commit('setDoc', value)
  },
  setDiagnose({ commit }, value) {
    commit('setDiagnose', value)
  },
  setDescription({ commit }, value) {
    commit('setDescription', value)
  },
  setStudent({ commit }, value) {
    commit('setStudent', value)
  },
  setWeight({ commit }, value) {
    commit('setWeight', value)
  },
  setRememberToken({ commit }, value) {
    commit('setRememberToken', value)
  },
  setCreatedAt({ commit }, value) {
    commit('setCreatedAt', value)
  },
  setUpdatedAt({ commit }, value) {
    commit('setUpdatedAt', value)
  },
  setDeletedAt({ commit }, value) {
    commit('setDeletedAt', value)
  },
  fetchCreateData({ commit }) {
    axios.get(`${route}/create`).then(response => {
      commit('setLists', response.data.meta)
    })
  },
  fetchEditData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}/edit`).then(response => {
      commit('setEntry', response.data.data)
      commit('setLists', response.data.meta)
    })
  },
  fetchShowData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}`).then(response => {
      commit('setEntry', response.data.data)
    })
  },
  resetState({ commit }) {
    commit('resetState')
  }
}

const mutations = {
  setEntry(state, entry) {
    state.entry = entry
  },
  setDoctor(state, value) {
    state.entry.doctor = value
  },
  setDoc(state, value) {
    state.entry.doc = value
  },
  setStudent(state, value) {
    state.entry.student_id = value
  },
  setDiagnose(state, value) {
    state.entry.diagnose = value
  },
  setDescription(state, value) {
    state.entry.description = value
  },
  setWeight(state, value) {
    state.entry.weight = value
  },
  setRememberToken(state, value) {
    state.entry.remember_token = value
  },
  setCreatedAt(state, value) {
    state.entry.created_at = value
  },
  setUpdatedAt(state, value) {
    state.entry.updated_at = value
  },
  setDeletedAt(state, value) {
    state.entry.deleted_at = value
  },
  setLists(state, lists) {
    state.lists = lists
  },
  setLoading(state, loading) {
    state.loading = loading
  },
  resetState(state) {
    state = Object.assign(state, initialState())
  }
}

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
}
