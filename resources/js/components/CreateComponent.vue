<template>
    <div class="container">
        <div class="row justify-content-center">
        
            <div class="col-md-8">
                <div class="card">
            <div class="card-body">
    
                <form method="POST"  v-on:submit.prevent="postitem()" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Name </label>
    <input type="text" class="form-control" @change="storeingData()" v-model="name"  placeholder="advertising...">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">from </label>
    <input type="date" @change="storeingData()" class="form-control" v-model="from"  >
    
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">to </label>
    <input type="date" @change="storeingData()" class="form-control" v-model="to"  >
    
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">total </label>
    <input type="text"  @change="storeingData()" class="form-control" v-model="total"  >
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">daily_budget </label>
    <input type="text" @change="storeingData()" class="form-control" v-model="daily_budget"  >
    
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">files </label>
    <input type="file" class="form-control" @change="onImageChange($event)" multiple >
    
  </div>



<button class="btn btn-primary"
>
Submit
</button>
  </form>

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
 
            this.total =   this.$cookies.get('total') !== null ? this.$cookies.get('total') : '';
           this.from =  this.$cookies.get('from') !== null ? this.$cookies.get('from') : '';
           this.to = this.$cookies.get('to') !== null ? this.$cookies.get('to') : '';
           this.name = this.$cookies.get('name') !== null ? this.$cookies.get('name') : '';
           this.daily_budget = this.$cookies.get('daily_budget') !== null ? this.$cookies.get('daily_budget') : '';
        },
       data(){
        return{
         total:'',
from:'',
to:'',
total:'',
name:'',
daily_budget:'',
images:[],

        }
       },
       methods:{
    


storeingData(){
    this.$cookies.set('total',this.total);
    this.$cookies.set('from',this.from);
    this.$cookies.set('to',this.to);
    this.$cookies.set('name',this.name);
    this.$cookies.set('daily_budget',this.daily_budget);
    
},

        onImageChange(e) {    
         this.images = [] 
   this.images.push(e.target.files[0])
           },

 postitem(){

let formData = new FormData();

if(this.total){
formData.append('total', this.total);
}

if(this.from){
formData.append('from', this.from);
}
if(this.to){
formData.append('to', this.to);
}

if(this.name){
formData.append('name', this.name);
}
if(this.daily_budget){
formData.append('daily_budget', this.daily_budget);
}
if(this.images){
   formData.append('count', this.images.length);
   }

   this.images.forEach((element, index, array) => {
   if(element !== undefined){
   formData.append('files-' + index, element);
   }
    
   });

   axios.post('/advertising/Add',formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data' },
}).then(res=>{
    this.$cookies.remove('total');
    this.$cookies.remove('from');
    this.$cookies.remove('to');
    this.$cookies.remove('name');
    this.$cookies.remove('daily_budget');
    
        window.location.href = ('/advertising/index')
  
    })
 }
       }
    }
</script>
