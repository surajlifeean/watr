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
                <li><a href="{{url('/admin/parameter')}}">Partner</a></li>>
                <li><a href="{{url('/admin/parameter/create')}}">Manage Credentials</a></li>
            </ul>

                       <header class="panel-heading">
                        <span class="h4" style="margin-left:12px;"> Add</span>
                      </header>

                      {{Form::open(['route' =>['partner.update',$data['member_id']],'method'=>'PUT','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}}
                      <input type="hidden" name="partner_id" value="{{$data['partner_id']}}">
                      <div class="panel-body">                   
                         <div class="form-group">
                          <label class="col-sm-3 control-label">Company Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="company_name" class="form-control"  data-required="true" value="{{$data['lab']}}" placeholder="Company Name" required>   
                          </div>
                        </div>
                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Assigned ID</label>
                          <div class="col-sm-9">
                            <input type="text" name="email" class="form-control"  data-required="true" value="{{$data['id']}}" placeholder="Assigned ID" required>   
                          </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Assigned Password</label>
                          <div class="col-sm-9">
                            <input type="password" name="password" class="form-control"  data-required="true" value="{{$data['password']}}" placeholder="Password"  required>   
                          </div>
                        </div>


                    
              
                  <footer class="panel-footer text-right bg-light lter">
                       
                          <input type="submit" class="btn btn-success btn-s-xs" value="Submit"/>

                        <a href="{{url('/admin/partner')}}" class="btn btn-danger">Cancel</a>
                      </footer>


                     </div>

                     {{Form::close()}}
                      
                      
          

</section>
</section>
</section>



 @endsection


 @section('scripts')

 @endsection
