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
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr v-for="(task,index) in tasks" :key="index" class="m-5">
                                        <td>{{ index+1 }}</td>
                                        <td > <button @click="editTask(task)" class="btn">{{ task.Title }}</button> </td>
                                        <td class="btn btn-danger bg-danger text-light float-end btn-sm">{{ task.Date }}</td>
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
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5 text-light" id="taskModalLabel">{{ !editMode ?  'Add Task' : 'Edit TODO'  }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
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
      </div>
      <div class="modal-footer">
        <button type="button" @click="!editMode ? storeTask() : updateTask()" class="btn btn-primary">{{ !editMode ? 'Submit Task' : 'SAVE'  }} </button>
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
        updateTask(){
            this.taskData.title == '' ? this.taskErrors.title = true : this.taskErrors.title = false
            this.taskData.date == '' ? this.taskErrors.date = true : this.taskErrors.date = false
        
            if(this.taskData.title && this.taskData.date){
                console.log(this.taskData.id)
                console.log(this.taskData)
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