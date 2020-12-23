 @extends('admin.adminmain')
 @section('title',"Admin | Add Tests")
 @section('stylesheets')

        <link href="{{asset('admin/css/select2.min.css')}}" rel="stylesheet">
 
 @endsection

 @section('content')
<section id="content">
<section class="vbox">
<section class="scrollable padder">

 			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href=""><i class="fa fa-home"></i>Home</a></li>>
                <li><a href="{{url('/admin/test')}}">Test management</a></li>>
                <li><a href="{{url('/admin/test/create')}}">Add Tests</a></li>
            </ul>

                       <header class="panel-heading">
                        <span class="h4" style="margin-left:12px;">Add</span>
                      </header>

                      {{Form::open(['route' => 'test.store','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}}
                      <div class="panel-body">                   
                         <div class="form-group">
                          <label class="col-sm-3 control-label">Test Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="name" class="form-control"  data-required="true" placeholder="Name of test" required>   
                          </div>
                        </div>
                         <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Specific Instructions</label>
                          <div class="col-sm-9">
                            <textarea id="summernote" name="instructions" class="form-control" required></textarea>    
                          </div>
                        </div>
                        <label class="col-sm-3 control-label">Parameters</label>
                        <select class="js-example-basic-multiple form-control" name="parameters[]" multiple="multiple">
                          @foreach($parameters as $key=>$value)
                          <option value="{{$value}}">{{$key}}</option>
                          @endforeach
                        </select>


                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                            <select name="status" required>
                         <option value="">select</option>
                         <option value="A">Active</option>
                         <option value="I">Inactive</option>
                           </select>

                          </div>
                         </div>

                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Type</label>
                          <div class="col-sm-9">
                            <select name="type" required>
                         <option value="">select</option>
                         <option value="D">Default</option>
                         <option value="G">Group</option>
                         <option value="I">Individual</option>
                           </select>

                          </div>
                         </div>

                    

                  <footer class="panel-footer text-right bg-light lter">
                       
                          <input type="submit" class="btn btn-success btn-s-xs" value="Submit"/>

                        <a href="{{url('/admin/test')}}" class="btn btn-danger">Cancel</a>
                      </footer>


                     </div>

                     {{Form::close()}}
                      
                      
          

</section>
</section>
</section>



 @endsection


 @section('scripts')

  <script src="{{asset('admin/js/select2.min.js')}}"></script>
<script>
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

</script>
 @endsection
