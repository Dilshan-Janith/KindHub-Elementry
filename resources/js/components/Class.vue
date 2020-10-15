<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mt-0 mb-3">Class Rooms</h4>
        <div class="card-tools">
          <button
            class="btn btn-blue"
            style="float: right; margin-top: -43px"
            @click="addClass"
          >
            +
          </button>
        </div>
      </div>
      <div class="table-responsive card-body">
        <table class="table table-hover mb-0">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="class_name in classes" :key="class_name.id">
              <td>{{ class_name.id }}</td>
              <td>{{ class_name.class_name }}</td>
              <td>
                <a type="button" href="" @click.prevent="editCalss(class_name)"
                  ><i class="fa fa-edit"></i
                ></a>
                /
                <a
                  type="button"
                  href=""
                  @click.prevent="deleteCalss(class_name.id)"
                  ><i class="fa fa-trash"></i
                ></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal content-->
    <div
      id="addNewClass"
      class="modal fade"
      aria-hidden="true"
      aria-labelledby="addNewClassLable"
    >
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 v-show="!editMode" class="modal-title">Add New Class</h4>
            <h4 v-show="editMode" class="modal-title">Update Class</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="editMode ? updateClass() : createClass()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.class_name"
                  type="text"
                  name="class_name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('class_name') }"
                />
                <has-error :form="form" field="class_name"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-inverse">Clear</button>
              <button
                v-show="editMode"
                type="submit"
                id="update_btn"
                class="btn btn-inverse"
              >
                Update
              </button>
              <button
                v-show="!editMode"
                type="submit"
                id="submit_btn"
                class="btn btn-inverse"
              >
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editMode: false,
      classes: {},
      form: new Form({
        id: "",
        class_name: "",
      }),
    };
  },
  methods: {
    loadClass() {
      axios.get("api/class").then(({ data }) => (this.classes = data.data));
    },
    addClass() {
      this.editMode = false;
      this.form.reset();
      $("#addNewClass").modal("show");
    },
    editCalss(class_name) {
      this.editMode = true;
      this.form.reset();
      $("#addNewClass").modal("show");
      this.form.fill(class_name);
    },
    createClass() {
      this.form
        .post("api/class")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNewClass").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        })
        .catch(() => {});
    },
    updateClass() {
      this.form.put("api/class/" + this.form.id);
      Fire.$emit("AfterCreate");
      $("#addNewClass").modal("hide");
      $("body").removeClass("modal-open");
      $(".modal-backdrop").remove();
    },
    deleteCalss(id) {
      this.form.delete("api/class/" + id);
      Fire.$emit("AfterCreate");
    },
  },
  created() {
    this.loadClass();
    Fire.$on("AfterCreate", () => {
      this.loadClass();
    });
  },
};
</script>
