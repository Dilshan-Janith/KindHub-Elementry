<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mt-0 mb-3">Student Details</h4>
        <div class="card-tools">
          <button
            class="btn btn-blue"
            style="float: right; margin-top: -43px"
            @click="addStudent"
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
              <th>Gender</th>
              <th>Assigned Class</th>
              <th>Assigned Teacher</th>
              <th>Joined Year</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="student in students" :key="student.id">
              <td>{{ student.id }}</td>
              <td>{{ student.first_name }}</td>
              <td>{{ student.last_name }}</td>
              <td>{{ (student.gender = 1 ? "Male" : "female") }}</td>
              <td>{{ student.class }}</td>
              <td>{{ student.teacher }}</td>
              <td>{{ student.year }}</td>
              <td>
                <a type="button" href="" @click.prevent="editStudent(student)"
                  ><i class="fa fa-edit"></i
                ></a>
                /
                <a
                  type="button"
                  href=""
                  @click.prevent="deleteStudent(student.id)"
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
      id="addNewStudent"
      class="modal fade"
      aria-hidden="true"
      aria-labelledby="addNewStudentLable"
    >
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 v-show="!editMode" class="modal-title">Add New Student</h4>
            <h4 v-show="editMode" class="modal-title">Update Student's Info</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="editMode ? updateStudent() : createStudent()">
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
              <div class="form-group">
                <select
                  v-model="form.gender"
                  type="text"
                  name="gender"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('gender') }"
                >
                  <option value="">Select Gender</option>
                  <option value="1">Female</option>
                  <option value="2">Male</option>
                </select>
                <has-error :form="form" field="gender"></has-error>
              </div>
              <div class="form-group">
                <select
                  v-model="form.teacher_id"
                  type="text"
                  name="teacher"
                  id="teacher"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('teacher') }"
                >
                  <option value="">Select Teacher</option>
                  <option
                    v-for="teacher in teachers"
                    :key="teacher.id"
                    v-bind:value="teacher.id"
                  >
                    {{ teacher.first_name }}
                  </option>
                </select>
                <has-error :form="form" field="teacher"></has-error>
              </div>
              <div class="form-group">
                <select
                  v-model="form.class_id"
                  type="text"
                  name="class_room"
                  id="class_room"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('class_room') }"
                >
                  <option value="">Select Class</option>
                  <option
                    v-for="class_room in classes"
                    :key="class_room.id"
                    v-bind:value="class_room.id"
                  >
                    {{ class_room.class_name }}
                  </option>
                </select>
                <has-error :form="form" field="class_room"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.year"
                  type="month"
                  name="year"
                  placeholder="Year"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('year') }"
                />
                <has-error :form="form" field="year"></has-error>
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
      students: {},
      teachers: [],
      classes: [],
      form: new Form({
        id: "",
        first_name: "",
        last_name: "",
        gender: "",
        teacher_id: "",
        class_id: "",
        year: "",
      }),
    };
  },
  methods: {
    loadStudent() {
      axios.get("api/student").then(({ data }) => (this.students = data.data));
    },
    loadTeachers() {
      axios.get("api/get_teacher").then(({ data }) => (this.teachers = data));
    },
    loadclasses() {
      axios.get("api/get_class").then(({ data }) => (this.classes = data));
    },
    addStudent() {
      this.editMode = false;
      this.form.reset();
      $("#addNewStudent").modal("show");
    },
    editStudent(student) {
      this.editMode = true;
      this.form.reset();
      $("#addNewStudent").modal("show");
      this.form.fill(student);
    },
    createStudent() {
      this.form
        .post("api/student")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNewStudent").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        })
        .catch(() => {});
    },
    updateStudent() {
      this.form.put("api/student/" + this.form.id);
      Fire.$emit("AfterCreate");
      $("#addNewStudent").modal("hide");
      $("body").removeClass("modal-open");
      $(".modal-backdrop").remove();
    },
    deleteStudent(id) {
      this.form.delete("api/student/" + id);
      Fire.$emit("AfterCreate");
    },
  },
  created() {
    this.loadStudent();
    this.loadTeachers();
    this.loadclasses();
    Fire.$on("AfterCreate", () => {
      this.loadStudent();
    });
  },
};
</script>
