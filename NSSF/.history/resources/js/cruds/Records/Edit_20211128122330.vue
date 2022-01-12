<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">edit</i>
              </div>
              <h4 class="card-title">Edit Record</h4>
            </div>
            <div class="card-body">
              <back-button></back-button>
            </div>
            <div class="card-body">
              <bootstrap-alert />
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.user_id !== 0,
                      'is-focused': activeField == 'user'
                    }"
                  >
                    <label class="bmd-label-floating required">ID Number</label>
                    <v-select
                      name="users"
                      label="id_no"
                      :key="'users-field'"
                      :value="entry.user_id"
                      :options="lists.user"
                      :reduce="entry => entry.id"
                      :closeOnSelect="false"
                      @input="updateUser"
                      @search.focus="focusField('user')"
                      @search.blur="clearFocus"
                    />
                  </div>

                  <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.amount,
                      'is-focused': activeField == 'amount'
                    }"
                  >
                    <label class="bmd-label-floating required">Amount</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.amount"
                      @input="updateAmount"
                      @focus="focusField('amount')"
                      @blur="clearFocus"
                    />
                  </div>
                    <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.paydate,
                      'is-focused': activeField == 'paydate'
                    }"
                  >
                    <!-- <label class="bmd-label-floating required">Date</label> -->
                    <input
                      class="form-control"
                      type="date"
                      :value="entry.paydate"
                      @input="updatePaydate"
                      @focus="focusField('paydate')"
                      @blur="clearFocus"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <vue-button-spinner
                class="btn-primary"
                :status="status"
                :isLoading="loading"
                :disabled="loading"
              >
                Save
              </vue-button-spinner>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  data() {
    return {
      status: '',
      activeField: ''
    }
  },
  computed: {
    ...mapGetters('RecordsSingle', ['entry', 'loading', 'lists'])
  },
  beforeDestroy() {
    this.resetState()
  },
  watch: {
    '$route.params.id': {
      immediate: true,
      handler() {
        this.resetState()
        this.fetchEditData(this.$route.params.id)
      }
    }
  },
  methods: {
    ...mapActions('RecordsSingle', [
      'fetchEditData',
      'updateData',
      'resetState',
      'setAmount',
      'setPaydate',
      'setUser',
    ]),
    updateStudent(value) {
      this.setStudent(value)
    },
    updateDoc(e) {
        this.setDoc(e.target.value)
    },
    updateDoctor(e) {
        this.setDoctor(e.target.value)
    },
    updateDiagnose(e) {
        this.setDiagnose(e.target.value)
    },
    updateDescription(e) {
        this.setDescription(e.target.value)
    },
    updateWeight(e) {
        this.setWeight(e.target.value)
    },
    submitForm() {
      this.updateData()
        .then(() => {
          this.$router.push({ name: 'records.index' })
          this.$eventHub.$emit('update-success')
        })
        .catch(error => {
          this.status = 'failed'
          _.delay(() => {
            this.status = ''
          }, 3000)
        })
    },
    focusField(name) {
      this.activeField = name
    },
    clearFocus() {
      this.activeField = ''
    }
  }
}
</script>
