 @extends('admin.adminmain')
 @section('title',"Admin | Add Parameters")
 @section('stylesheets')

 @endsection

 @section('content')
<section id="content">
<section class="vbox">
<section class="scrollable padder">

 			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href=""><i class="fa fa-home"></i>Home</a></li>>
                <li><a href="{{url('/admin/parameter')}}">parameter management</a></li>>
                <li><a href="{{url('/admin/parameter/create')}}">Add Parameters</a></li>
            </ul>

                       <header class="panel-heading">
                        <span class="h4" style="margin-left:12px;"> Add</span>
                      </header>

                      {{Form::model($parameter,['route' =>['parameter.update',$parameter->id],'method'=>'PUT','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}}


                      <div class="panel-body">                   
                         <div class="form-group">
                          <label class="col-sm-3 control-label">Parameter Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" value="{{$parameter->name}}" data-required="true" placeholder="Name of Parameter" required>   
                          </div>
                        </div>
                         <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Cost</label>
                          <div class="col-sm-9">
                            <input type="text" name="cost" class="form-control" value="{{$parameter->cost}}"  data-required="true" placeholder="Cost" required>   
                          </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                            <select name="status" required>
                           <option value="">select</option>
                           <option value="A" {{$parameter->status=='A'?'selected':''}}>Active</option>
                           <option value="I" {{$parameter->status=='I'?'selected':''}}>Inactive</option>
                           </select>

                          </div>
                         </div>
                    
              
                  <footer class="panel-footer text-right bg-light lter">
                       
                          <input type="submit" class="btn btn-success btn-s-xs" value="Submit"/>

                        <a href="{{url('/admin/parameter')}}" class="btn btn-danger">Cancel</a>
                      </footer>


                     </div>

                     {{Form::close()}}
                      
                      
          

</section>
</section>
</section>



 @endsection


 @section('scripts')

 @endsection
