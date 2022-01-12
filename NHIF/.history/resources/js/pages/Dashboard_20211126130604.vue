<template>
  <div class="container-fluid">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">language</i>
              </div>
              <h4 class="card-title">Hello</h4>
            </div>
            <div class="card-body">
              You are logged in!

              <p>Member Number: {{}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
        user : [],
    }
  },
  mounted() {
      this.loadUsers();
  },
  methods: {
      loadUsers() {
          this.$Progress.start();
          // Fire.$emit("updatedEmployeesTable");
          axios.get("/api/v1/users/id").then(res => {
              this.user = res.data.data;
              this.$Progress.finish();
          });
      },
  }
}
</script>
