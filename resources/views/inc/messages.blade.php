<style>
.alert .alert-success {
  padding-left: 15px;  
  padding-right: 15px;
  padding: 20px;
  background-color: rgb(92, 230, 133); 
  margin-bottom: 15px;
}

.alert .alert-danger {
  padding-left: 15px;  
  padding-right: 15px;
  padding: 20px;
  background-color: #CB6D51; 
  margin-bottom: 15px;
}


.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}

.alert {
  opacity: 1;
  transition: opacity 0.6s; 
}



Modern Alerts
https://codepen.io


</style>
@if(count($errors)>0)
  @foreach($errors->all() as $error)
    <div class="alert alert-danger">
      {{$error}}
    </div>
  @endforeach
@endif


@if(session('success'))
  <div class="alert alert-success">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      {{session('success')}}
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      {{session('error')}}
  </div>
@endif

