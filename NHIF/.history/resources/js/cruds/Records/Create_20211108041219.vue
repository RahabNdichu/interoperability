<template>
  <div class="container-fluid">
    <form @submit.prevent="submitForm">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">add</i>
              </div>
              <h4 class="card-title">Create Record</h4>
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
                      'has-items': entry.student_id !== 0,
                      'is-focused': activeField == 'student'
                    }"
                  >
                    <label class="bmd-label-floating required">Student name</label>
                    <v-select
                      name="student"
                      label="name"
                      :key="'student-field'"
                      :value="entry.student_id"
                      :options="lists.student"
                      :reduce="entry => entry.id"
                      :closeOnSelect="false"
                      @input="updateStudent"
                      @search.focus="focusField('student')"
                      @search.blur="clearFocus"
                    />
                  </div>
                    <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.doc,
                      'is-focused': activeField == 'doc'
                    }"
                  >
                    <label class="bmd-label-floating required">Checkup Date</label>
                    <input
                      class="form-control"
                      placeholder="yyyy-m-d"
                      type=""
                      :value="entry.doc"
                      @input="updateDoc"
                      @focus="focusField('doc')"
                      @blur="clearFocus"
                    />
                  </div>
                    <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.doctor,
                      'is-focused': activeField == 'doctor'
                    }"
                  >
                    <label class="bmd-label-floating required">Doctor</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.doctor"
                      @input="updateDoctor"
                      @focus="focusField('doctor')"
                      @blur="clearFocus"
                    />
                  </div>
                   <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.diagnose,
                      'is-focused': activeField == 'diagnose'
                    }"
                  >
                    <label class="bmd-label-floating required">Diagnose</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.diagnose"
                      @input="updateDiagnose"
                      @focus="focusField('diagnose')"
                      @blur="clearFocus"
                    />
                  </div>
                   <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.description,
                      'is-focused': activeField == 'description'
                    }"
                  >
                    <label class="bmd-label-floating required">Description</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.description"
                      @input="updateDescription"
                      @focus="focusField('description')"
                      @blur="clearFocus"
                    />
                  </div>
                   <div
                    class="form-group bmd-form-group"
                    :class="{
                      'has-items': entry.weight,
                      'is-focused': activeField == 'weight'
                    }"
                  >
                    <label class="bmd-label-floating required">Weight</label>
                    <input
                      class="form-control"
                      type="text"
                      :value="entry.weight"
                      @input="updateWeight"
                      @focus="focusField('weight')"
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
import Attachment from '@components/Attachments/Attachment'

export default {
    components: {
        Attachment
        },
  data() {
    return {
      status: '',
      activeField: ''
    }
  },
  computed: {
    ...mapGetters('RecordsSingle', ['entry', 'loading', 'lists'])
  },
  mounted() {
    this.fetchCreateData()
  },
  beforeDestroy() {
    this.resetState()
  },
  methods: {
    ...mapActions('RecordsSingle', [
      'storeData',
      'resetState',
      'setDoctor',
      'setDoc',
      'setWeight',
      'setDescription',
      'setDiagnose',
      'setStudent',
      'fetchCreateData'
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
      this.storeData()
        .then(() => {
          this.$router.push({ name: 'records.index' })
          this.$eventHub.$emit('create-success')
        })
        .catch(error => {
          this.status = 'failed'
          _.delay(() => {
            this.status = ''
          }, 3000)
        })
    },
    focusField(student_id) {
      this.activeField = student_id
    },
    clearFocus() {
      this.activeField = ''
    }
  }
}
</script>
