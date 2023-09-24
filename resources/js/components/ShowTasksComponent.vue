<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-3">
                        <div class="row">
                            <div class="col-md-6 ">
                                <h5 class="float-start">{{ title }}</h5>
                            </div>
                            <div class="col-md-6 ">
                                <button @click="createTask" class="btn btn-primary btn-sm float-end"> Add Task</button>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive  overflow-x-hidden">
                            <table class="table">
                                <tbody>
                                    <tr v-for="(task,index) in tasks" :key="index" class="m-5">
                                        <td>{{ index+1 }}</td>
                                        <td > <button @click="editTask(task)" class="btn">{{ task.Title }}</button> </td>
                                        <td class="text-light float-end">
                                            <button type="button" class="btn btn-danger btn-sm position-relative">
                                                {{ task.Date }}
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                >
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                            </button>
                                        </td>
                                        <td class=" float-end"><button @click="removeTask(task)" class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
  <div :class="`modal-dialog modal-dialog-centered ${!deleteMode ? modal-md : modal-sm }`">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5 text-light" id="taskModalLabel" v-show="!deleteMode">{{ !editMode ?  'Add Task' : 'Edit TODO'  }}</h1>
        <h1 class="modal-title fs-5 text-light" id="taskModalLabel" v-show="deleteMode">Delete Task</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row" v-show="!deleteMode">
            <div class="col-md-12">
                <div class="form-group mb-4">
                    <input type="text" class="form-control" placeholder="Write Task Title" v-model="taskData.title">
                    <span class="text-danger" v-show="taskErrors.title">Title is required</span>
                </div>
                <div class="form-group mb-4">
                    <textarea id="notes" class="form-control" rows="5" placeholder="Write Task Notes" v-model="taskData.notes"></textarea>
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" placeholder="Due Date Ex: 2023-09-25" v-model="taskData.date">
                    <span class="text-danger" v-show="taskErrors.date">Date is required</span>
                </div>
            </div>  
        </div>
        <h5 class="text-center" v-show="deleteMode">Are you sure you want to delete this task</h5>
      </div>
      <div class="modal-footer" v-show="!deleteMode">
        <button type="button" @click="!editMode ? storeTask() : updateTask()" class="btn btn-primary">{{ !editMode ? 'Submit Task' : 'SAVE'  }} </button>
      </div>
      <div class="modal-footer" v-show="deleteMode">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" @click="deleteTask()" class="btn btn-danger">Delete Task </button>
      </div>
    </div>
  </div>
</div>

    </div>
</template>


<script>
import axios from 'axios';


export default {

    setup: ()=> ({
        'title': 'Todo List'
    }),
    data(){
        return {
            editMode:false,
            deleteMode:false,
            taskData:{
                id: '',
                title: '',
                notes: '',
                date: '',
            },
            taskErrors:{
                title:'false',
                date:'false',
            },
            tasks:{}
        }
    },
    mounted(){
        this.getTasks();
    },
    methods:{
        getTasks(){
            axios.get('/api/tasks').then(response=>{
                // console.log( response);
                this.tasks = response.data;
            }).catch(err=>{
                // console.log(err.response.data);
            });
        },
        deleteTask(){
            axios.delete( '/api/task/' + this.taskData.id).then(response =>{
                    // console.log( response.data);
                    this.getTasks()
                }).catch(err =>{
                    // console.log(err.response.data)
                }).finally(()=>{
                    $('#taskModal').modal('hide');
                })
        },
        removeTask(task){
            this.deleteMode =true;
            this.taskData.id = task.id;
            $('#taskModal').modal('show');

        },
        updateTask(){
            this.taskData.title == '' ? this.taskErrors.title = true : this.taskErrors.title = false
            this.taskData.date == '' ? this.taskErrors.date = true : this.taskErrors.date = false
        
            if(this.taskData.title && this.taskData.date){
                // console.log(this.taskData.id)
                // console.log(this.taskData)
                axios.put( '/api/task/' + this.taskData.id ,this.taskData).then(response =>{
                    // console.log( response.data);
                    this.getTasks()
                }).catch(err =>{
                    // console.log(err.response.data)
                }).finally(()=>{
                    $('#taskModal').modal('hide');
                })
            }
        },
        editTask(task){
            this.editMode = true;
            this.deleteMode = false;
            this.taskData={
                id: task.id,
                title: task.Title,
                notes: task.Notes,
                date: task.Date,
            }
            this.taskErrors={
                title:'false',
                date:'false',
            }
            $('#taskModal').modal('show');
        }
        ,createTask(){
            this.editMode = false;
            this.deleteMode = false;
            this.taskData={
                id: '',
                title: '',
                notes: '',
                date: '',
            }
            this.taskErrors={
                title:'false',
                date:'false',
            }
            $('#taskModal').modal('show');
        },
        storeTask(){
            this.taskData.title == '' ? this.taskErrors.title = true : this.taskErrors.title = false
            this.taskData.date == '' ? this.taskErrors.date = true : this.taskErrors.date = false
        
            if(this.taskData.title && this.taskData.date){
                axios.post( '/api/task/store', this.taskData).then(response =>{
                    this.getTasks()
                    console.log(response.data)
                }).catch(err =>{
                    console.log(err.response.data)
                }).finally(()=>{
                    $('#taskModal').modal('hide');
                })
            }
        }
    }
}

</script>