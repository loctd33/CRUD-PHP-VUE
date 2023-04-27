<template>
  <div class="container-xl">
    <div class="table-responsive">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="row">
            <div class="col-sm-6">
              <h2>Manage <b>Developer</b></h2>
            </div>
            <div class="col-sm-6">
              <button @click="addDev" type="button" class="btn btn-primary btn-success d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="material-icons">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                  </svg>
                </i> 
                <span>Add Dev</span>
              </button>
              <button type="button" class="btn btn-primary btn-danger d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal" :disabled="isDisabledDeleteBtn">
                <i class="material-icons">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                  </svg>
                </i> 
                <span>Delete</span>
              </button>
            </div>
          </div>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>
                <span class="custom-checkbox">
                  <input type="checkbox" id="selectAll" v-model="selectAll">
                  <label for="selectAll"></label>
                </span>
              </th>
              <th>Name</th>
              <th>Email</th>
              <th>Technique</th>
              <th>Gender</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(dev, index) in devs" :key="index">
              <td>
                <span class="custom-checkbox">
                  <input type="checkbox" :id="'checkbox'+ index" v-model="selected" :value="dev.id">
                  <label :for="'checkbox'+ index"></label>
                </span>
              </td>
              <td>{{ dev.name }}</td>
              <td>{{ dev.email }}</td>
              <td>{{ dev.technique }}</td>
              <td>{{ dev.gender }}</td>
              <td>
                <a class="edit" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#editModal" @click="editDev(dev)">
                  <i class="material-icons" data-toggle="tooltip" title="Edit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                  </i>
                </a>
                <a class="delete" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal" @click="editDev(dev)">
                  <i class="material-icons bi bi-x-square-fill" data-toggle="tooltip" title="Delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                      <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                    </svg>
                  </i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Add Modal HTML -->
  <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST">
          <div class="modal-header">
            <h4 class="modal-title">Add Dev</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" v-model="devData.name" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" v-model="devData.email" required>
            </div>
            <div class="form-group">
              <label for="technique">Technique</label>
              <select class="form-select form-control" id="technique"  v-model="devData.technique" aria-label="Default select example">
                <option selected>Choose one technique</option>
                <option v-for="(tech, index) in techs" :value="tech" :key="index">
                  {{ tech }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <label>Gender</label>
              <div class="d-flex flex-direction-row mt-2">
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="g-male" value="male" v-model="devData.gender" checked/>
                  <label for="g-male">Male</label>
                </div>
                <div class="form-check female">
                  <input class="form-check-input" type="radio" id="g-female" value="female" v-model="devData.gender" />
                  <label for="g-female">Female</label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
            <button @click="addData" type="button" class="btn btn-success" data-bs-dismiss="modal">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit Modal HTML -->
  <div id="editModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST">
          <div class="modal-header">
            <h4 class="modal-title">Edit Dev</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" v-model="devData.name" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" v-model="devData.email" required>
            </div>
            <div class="form-group">
              <label for="technique">Technique</label>
              <select class="form-select form-control" id="technique"  v-model="devData.technique" aria-label="Default select example">
                <option selected>Choose one technique</option>
                <option v-for="(tech, index) in techs" :value="tech" :key="index">
                  {{ tech }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <label>Gender</label>
              <div class="d-flex flex-direction-row mt-2">
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="g-male" value="male" v-model="devData.gender" checked/>
                  <label for="g-male">Male</label>
                </div>
                <div class="form-check female">
                  <input class="form-check-input" type="radio" id="g-female" value="female" v-model="devData.gender" />
                  <label for="g-female">Female</label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
            <button @click="updateData" type="button" class="btn btn-success" data-bs-dismiss="modal">Edit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Delete Modal HTML -->
  <div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <h4 class="modal-title">Delete Dev</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
            <button @click="deleteData" type="button" class="btn btn-success" data-bs-dismiss="modal">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="statusModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{statusModal.message}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <h1 v-if="this.statusModal.status" class="text-center">
            <div class="checkmark-circle">
              <div class="background"></div>
              <div class="checkmark draw"></div>
            </div>
          </h1> 
          <svg v-else xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#e61e1e" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
          </svg>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import axios from "axios";
import { Modal } from 'bootstrap'
import jQuery from "jquery";
const $ = jQuery;
window.$ = $;

export default {
  name: 'DashBoard',
  data() {
    return {
      statusModal: {status: true, message: 'Add successfully'},
      techs: ['Front-end', 'Back-end', 'Fullstack', 'Mobile', 'Devops'],
      devData: {
        id: null,
        name: null,
        email: null,
        technique: null,
        gender: 'male'
      },
      devs: [],
      selected: [],
    }
  },
  methods: {
    addDev() {
      this.devData.id = null;
      this.devData.name = null;
      this.devData.email = null;
      this.devData.technique = null;
      this.devData.gender = 'male';
    },
    editDev(dev) {
      this.devData = dev;
    },
    async getData() {
      await axios.get('http://localhost/vue-php/src/api/api.php?action=getData')
        .then(res => {
          this.devs = res.data.devData;
        })
        .catch(err => {
          console.log(err);
        })
    },
    async addData() {
      let data = new FormData();
      data.append('name', this.devData.name);
      data.append('email', this.devData.email);
      data.append('technique', this.devData.technique);
      data.append('gender', this.devData.gender);
      await axios.post('http://localhost/vue-php/src/api/api.php?action=addData',data)
        .then(res => {
          if(res.data.success) {
            this.statusModal.status = res.data.success;
            this.statusModal.message = res.data.message;
          }
          else {
            this.statusModal.status = false
            this.statusModal.message = 'Add fail';
          }
          // this.getData();
          const statusModal = new Modal($('#statusModal'));
          statusModal.show();
          this.getData();
        })
        .catch(err => {
          console.log(err);
        })
    },
    async updateData() {
      let data = new FormData();
      data.append('id', this.devData.id);
      data.append('name', this.devData.name);
      data.append('email', this.devData.email);
      data.append('technique', this.devData.technique);
      data.append('gender', this.devData.gender);

      await axios.post('http://localhost/vue-php/src/api/api.php?action=updateData',data)
      .then(res => {
        console.log(res);
        if(res.data.success) {
          this.statusModal.status = res.data.success;
          this.statusModal.message = res.data.message;
        }
        else {
          this.statusModal.status = false
          this.statusModal.message = 'Update fail';
        }
        const statusModal = new Modal($('#statusModal'));
        statusModal.show();
        this.getData();
      })
      .catch(err => {
        console.log(err);
      })
    },
    async deleteData() {
      let data = new FormData();
      data.append('id', this.devData.id === null ? this.selected : this.devData.id);

      await axios.post('http://localhost/vue-php/src/api/api.php?action=deleteData',data)
      .then(res => {
        console.log(res);
        if(res.data.success) {
          this.statusModal.status = res.data.success;
          this.statusModal.message = res.data.message;
        }
        else {
          this.statusModal.status = false
          this.statusModal.message = 'Delete fail';
        }
        const statusModal = new Modal($('#statusModal'));
        statusModal.show();
        this.getData();
      })
      .catch(err => {
        console.log(err);
      })
    }
  },
  created() {
    this.getData();
  },
  computed: {
    selectAll: {
      get: function () {
        return this.devs ? this.selected.length == this.devs.length : false;
      },
      set: function (value) {
        var selected = [];

        if (!this.devs) return;
        if(value) {
          this.devs.forEach(function (user) {
            selected.push(user.id);
          });
        }
        this.selected = selected;
      }
    },
    isDisabledDeleteBtn() {
      return !this.selected.length ? true : false;
    }
  },
}
</script>

<style>
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
  border-radius: 8px;
  border: 1px solid #ccc;
	min-width: 1000px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {        
	padding-bottom: 15px;
	background: #435d7d;
	color: #fff;
	padding: 16px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin: 5px 0 0;
	font-size: 24px;
}
.table-title .btn-group {
	float: right;
}
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
  border-radius: 5px;
}
.table-title .btn i {
	float: left;
	font-size: 21px;
	margin-right: 5px;
}
.table-title .btn span {
	float: left;
	margin-top: 4px;
}
table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}
table.table tr th:first-child {
	width: 60px;
}
table.table tr th:last-child {
	width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}
table.table th i {
	font-size: 13px;
	margin: 0 5px;
	cursor: pointer;
}	
table.table td:last-child i {
	opacity: 0.9;
	font-size: 22px;
	margin: 0 5px;
}
table.table td a {
	font-weight: bold;
	color: #566787;
	display: inline-block;
	text-decoration: none;
	outline: none !important;
}
table.table td a:hover {
	color: #2196F3;
}
table.table td a.edit {
	color: #FFC107;
}
table.table td a.delete {
	color: #F44336;
}
table.table td i {
	font-size: 19px;
}
table.table .avatar {
	border-radius: 50%;
	vertical-align: middle;
	margin-right: 10px;
}
.pagination {
	float: right;
	margin: 0 0 5px;
}
.pagination li a {
	border: none;
	font-size: 13px;
	min-width: 30px;
	min-height: 30px;
	color: #999;
	margin: 0 2px;
	line-height: 30px;
	border-radius: 2px !important;
	text-align: center;
	padding: 0 6px;
}
.pagination li a:hover {
	color: #666;
}	
.pagination li.active a, .pagination li.active a.page-link {
	background: #03A9F4;
}
.pagination li.active a:hover {        
	background: #0397d6;
}
.pagination li.disabled i {
	color: #ccc;
}
.pagination li i {
	font-size: 16px;
	padding-top: 6px
}
.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
}    
/* Custom checkbox */
.custom-checkbox {
	position: relative;
}
.custom-checkbox input[type="checkbox"] {    
	opacity: 0;
	position: absolute;
	margin: 5px 0 0 3px;
	z-index: 9;
}
.custom-checkbox label:before{
	width: 18px;
	height: 18px;
}
.custom-checkbox label:before {
	content: '';
	margin-right: 10px;
	display: inline-block;
	vertical-align: text-top;
	background: white;
	border: 1px solid #bbb;
	border-radius: 2px;
	box-sizing: border-box;
	z-index: 2;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	content: '';
	position: absolute;
	left: 6px;
	top: 3px;
	width: 6px;
	height: 11px;
	border: solid #000;
	border-width: 0 3px 3px 0;
	transform: inherit;
	z-index: 3;
	transform: rotateZ(45deg);
}
.custom-checkbox input[type="checkbox"]:checked + label:before {
	border-color: #03A9F4;
	background: #03A9F4;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	border-color: #fff;
}
.custom-checkbox input[type="checkbox"]:disabled + label:before {
	color: #b8b8b8;
	cursor: auto;
	box-shadow: none;
	background: #ddd;
}
/* Modal styles */
.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 8px;
	font-size: 14px;
}
.modal .modal-footer {
  background: #ecf0f1;
  border-radius: 0 0 8px 8px;
}
.modal .modal-title {
  display: inline-block;
}
.modal .form-control {
  border-radius: 2px;
  box-shadow: none;
  border-color: #dddddd;
}
.modal .form-group{
  margin-top: 10px;
}
.modal .form-select {
  font-size: 13px;
}
.modal .form-control {
  margin-top: 4px;
  border-radius: 5px;
}
.modal .form-check.female {
  margin-left: 20px;
}
.modal textarea.form-control {
  resize: vertical;
}
.modal .btn {
  border-radius: 2px;
  min-width: 100px;
}	
.modal form label {
  font-weight: normal;
}
/* --------------- */
.modal .checkmark-circle {
  width: 150px;
  height: 150px;
  position: relative;
  display: inline-block;
  vertical-align: top;
}
.checkmark-circle .background {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  background: #1ab394;
  position: absolute;
}
.modal .checkmark-circle .checkmark {
  border-radius: 5px;
}
.modal .checkmark-circle .checkmark.draw:after {
  -webkit-animation-delay: 300ms;
  -moz-animation-delay: 300ms;
  animation-delay: 300ms;
  -webkit-animation-duration: 1s;
  -moz-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-timing-function: ease;
  -moz-animation-timing-function: ease;
  animation-timing-function: ease;
  -webkit-animation-name: checkmark;
  -moz-animation-name: checkmark;
  animation-name: checkmark;
  -webkit-transform: scaleX(-1) rotate(135deg);
  -moz-transform: scaleX(-1) rotate(135deg);
  -ms-transform: scaleX(-1) rotate(135deg);
  -o-transform: scaleX(-1) rotate(135deg);
  transform: scaleX(-1) rotate(135deg);
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
.modal .checkmark-circle .checkmark:after {
  opacity: 1;
  height: 75px;
  width: 37.5px;
  -webkit-transform-origin: left top;
  -moz-transform-origin: left top;
  -ms-transform-origin: left top;
  -o-transform-origin: left top;
  transform-origin: left top;
  border-right: 15px solid #fff;
  border-top: 15px solid #fff;
  border-radius: 2.5px !important;
  content: '';
  left: 35px;
  top: 80px;
  position: absolute;
}

@-webkit-keyframes checkmark {
  0% {
    height: 0;
    width: 0;
    opacity: 1;
  }
  20% {
    height: 0;
    width: 37.5px;
    opacity: 1;
  }
  40% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
  100% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
}
@-moz-keyframes checkmark {
  0% {
    height: 0;
    width: 0;
    opacity: 1;
  }
  20% {
    height: 0;
    width: 37.5px;
    opacity: 1;
  }
  40% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
  100% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
}
@keyframes checkmark {
  0% {
    height: 0;
    width: 0;
    opacity: 1;
  }
  20% {
    height: 0;
    width: 37.5px;
    opacity: 1;
  }
  40% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
  100% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
}
</style>