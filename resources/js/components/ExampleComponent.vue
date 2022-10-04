<template>
    <div class="container">
        <div class="row justify-content-center">
        
            <div class="col-md-8">
                <div class="card">
            <div class="card-body">
              <a class="btn btn-primary" href="/advertising/create" >Create</a>
                <div class="table-responsive">
                                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
          <td>name</td>
          <td>from</td>
          <td>to</td>
          <td>total</td>
          <td>daily_budget</td>
          <td></td>


                                            </tr>

                                            </thead>
<tbody>
    <tr v-for="(data,index) in data.data" :key="data.id">
          <td>{{data.name}}</td>
          <td>{{data.from}}</td>
          <td>{{data.to}}</td>
          <td>{{data.total}}</td>
          <td>{{data.daily_budget}}</td>
           
       <td>

        <div class="dropdown">
  <button class="btn btn-light dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
 action
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" :href="'/advertising/edit/'+data.id">edit</a>

    <a class="dropdown-item" @click="deleteitem(index,data.id)" href="#">delete</a>

    <a class="dropdown-item" @click="CallingImage(data.id)" href="#">preview image</a>

    
  </div>
</div>

       </td>

                                            </tr>

</tbody>
                                            </table>
                                            <pagination :data="data" @pagination-change-page="getdatapagination"></pagination>
                                            </div>



            </div>
        </div>
    </div>
    </div>
    <div id="deathEmployeeModal" class="modal fade bd-example-modal-lg" >
         <div class="modal-dialog ">
            <div class="modal-content" style="overflow:auto;">
                <div class="modal-body">

                  <div class="row">


                    <div class="col-6" v-for="m in images" :key="m.id" >

                      <img :src="'/uploads/advertising/'+m.img" class="img-fluid" alt="Responsive image">

                    </div>

                  </div>

                  </div>
                  </div>
                  </div>
    </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default {
        mounted() {
           this.JsonListAdvertising()
        },
       data(){
        return{
         data:{},
images:[],
        }
       },
       methods:{
        getdatapagination(page = 1) {
		axios({
  method: 'post',
  url: '/advertising/JsonListAdvertising?page=' + page,

})		.then(response => {
                    this.data.data.splice(0)
              this.data =  response.data.data
            
                })
    },

        CallingImage(id){
axios({
    url:'/advertising/CallingImage/'+id,
    method:'get'
}).then(res=>{
this.images = res.data.data
window.$("#deathEmployeeModal").modal("show"); 

})
        },
     
        JsonListAdvertising(){
            axios({
               url:'/advertising/JsonListAdvertising',
               method:'post' 
            }).then(res=>{
                this.data = res.data.data
            })
        },
        deleteitem(index,id){
            axios({
               url:'/advertising/delete/'+id,
               method:'post' 
            }).then(res=>{
                this.data.data.splice(index,1)
            })
        }
       }
    }
</script>
