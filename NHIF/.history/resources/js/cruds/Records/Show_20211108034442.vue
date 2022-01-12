<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">remove_red_eye</i>
            </div>
            <h4 class="card-title">View Record</h4>
          </div>
          <div class="card-body">
            <back-button></back-button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <div class="table">
                    <tbody>
                        <tr>
                       <td class="text-primary">
                          Name
                        </td>
                        <td>
                          <datatable-list
                            :row="entry"
                            field="student.name"
                          >
                          </datatable-list>
                        </td>
                       </tr>
                       <tr>
                        <td class="text-primary">
                          Doctor
                        </td>
                        <td>
                          {{ entry.doctor }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          Check up Date
                        </td>
                        <td>
                          {{ entry.doc }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          Diagnose
                        </td>
                        <td>
                          {{ entry.diagnose }}
                        </td>
                      </tr>
                       <tr>
                        <td class="text-primary">
                          Description
                        </td>
                        <td>
                          {{ entry.description }}
                        </td>
                      </tr>
                      <tr>
                        <td class="text-primary">
                          Weight
                        </td>
                        <td>
                          {{ entry.weight }}
                        </td>
                      </tr>
                    </tbody>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import DatatableList from '@components/Datatables/DatatableList'

export default {
    components: {
    DatatableList
  },
  data() {
    return {}
  },
  beforeDestroy() {
    this.resetState()
  },
  computed: {
    ...mapGetters('RecordsSingle', ['entry'])
  },
  watch: {
    '$route.params.id': {
      immediate: true,
      handler() {
        this.resetState()
        this.fetchShowData(this.$route.params.id)
      }
    }
  },
  methods: {
    ...mapActions('RecordsSingle', ['fetchShowData', 'resetState'])
  }
}
</script>
