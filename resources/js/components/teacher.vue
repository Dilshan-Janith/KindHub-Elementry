<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mt-0 mb-3">Teachers Details</h4>
        <div class="card-tools">
          <button
            class="btn btn-blue"
            style="float: right; margin-top: -43px"
            @click="addTeacher"
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
              <th>First Name</th>
              <th>Last Name</th>
              <th>Assigned Classes</th>
              <th>Telephone</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="teacher in teachers" :key="teacher.id">
              <td>{{ teacher.id }}</td>
              <td>{{ teacher.first_name }}</td>
              <td>{{ teacher.last_name }}</td>
              <td>{{ teacher.class }}</td>
              <td>{{ teacher.telephone }}</td>
              <td>{{ teacher.email }}</td>
              <td>
                <a type="button" href="" @click.prevent="editTeacher(teacher)"
                  ><i class="fa fa-edit"></i
                ></a>
                /
                <a
                  type="button"
                  href=""
                  @click.prevent="deleteTeacher(teacher.id)"
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
      id="addNewTeacher"
      class="modal fade"
      aria-hidden="true"
      aria-labelledby="addNewTeacherLable"
    >
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 v-show="!editMode" class="modal-title">Add New Teacher</h4>
            <h4 v-show="editMode" class="modal-title">Update Teacher's Info</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="editMode ? updateTeacher() : createTeacher()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.first_name"
                  type="text"
                  name="first_name"
                  placeholder="First Name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('first_name') }"
                />
                <has-error :form="form" field="first_name"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.last_name"
                  type="text"
                  name="last_name"
                  placeholder="Last Name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('last_name') }"
                />
                <has-error :form="form" field="last_name"></has-error>
              </div>
              <div
                class="form-group"
                v-for="class_room in classes"
                :key="class_room.id"
              >
                <input
                  v-model="form.checked_classes.checked_ids"
                  type="checkbox"
                  class="form-check"
                  :id="class_room.id"
                  :value="class_room.id"
                  :class="{ 'is-invalid': form.errors.has('class_room') }"
                />
                <label :for="class_room.class_name">{{
                  class_room.class_name
                }}</label>
                <has-error :form="form" field="class_room"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.telephone"
                  type="text"
                  name="telephone"
                  placeholder="telephone"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('telephone') }"
                />
                <has-error :form="form" field="telephone"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.email"
                  type="text"
                  name="email"
                  placeholder="email"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                />
                <has-error :form="form" field="email"></has-error>
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
      teachers: {},
      classes: [],
      checked_classes: {
        checked_ids: [],
      },
      form: new Form({
        id: "",
        first_name: "",
        last_name: "",
        checked_classes: {
          checked_ids: [],
        },
        telephone: "",
        email: "",
      }),
    };
  },
  methods: {
    loadTeacher() {
      axios.get("api/teacher").then(({ data }) => (this.teachers = data.data));
    },
    loadclasses() {
      axios.get("api/get_class").then(({ data }) => (this.classes = data));
    },
    addTeacher() {
      this.editMode = false;
      this.form.reset();
      $("#addNewTeacher").modal("show");
    },
    editTeacher(teacher) {
      this.editMode = true;
      this.form.reset();
      $("#addNewTeacher").modal("show");
      this.form.fill(teacher);
    },
    createTeacher() {
      this.form
        .post("api/teacher")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNewTeacher").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        })
        .catch(() => {});
    },
    updateTeacher() {
      this.form.put("api/teacher/" + this.form.id);
      Fire.$emit("AfterCreate");
      $("#addNewTeacher").modal("hide");
      $("body").removeClass("modal-open");
      $(".modal-backdrop").remove();
    },
    deleteStudent(id) {
      this.form.delete("api/teacher/" + id);
      Fire.$emit("AfterCreate");
    },
  },
  created() {
    this.loadclasses();
    this.loadTeacher();
    Fire.$on("AfterCreate", () => {
      this.loadTeacher();
    });
  },
};
</script>
