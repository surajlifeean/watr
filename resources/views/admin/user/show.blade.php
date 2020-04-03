 @extends('admin.adminmain')
 @section('title',"User")
 @section('stylesheets')

 @endsection

 @section('content')
<section id="content">
<section class="vbox">
<section class="scrollable padder">

 			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href=""><i class="fa fa-home"></i>Home</a></li>>
                <li><a href="">User management</a></li>>
                <li><a href="">View User</a></li>
            </ul>

                       <header class="panel-heading">
                        <span class="h4">User Details</span>
                      </header>
<form>
                      <div class="panel-body">                   
                         <div class="form-group">
                          <label class="col-sm-3 control-label">Name</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$user->name, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>
                         <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Email</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$user->email, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                       <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Address</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$user->address, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                       <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Pin Code</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$user->pincode, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">City</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$user->city, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                      <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">State</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$user->state, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                       <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Phone Number</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$user->number, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                       <div class="form-group">
                          <label class="col-sm-3 control-label">Date of Birth</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$user->dob, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>



                        <div class="form-group">
                          <label class="col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                            <select name="status" disabled="true">
                         <option value="">select</option>
                         <option value="A" {{$user->gender=='M'?'selected':''}}>Male</option>
                         <option value="I" {{$user->gender=='F'?'selected':''}}>Female</option>
                           </select>

                          </div>
                         </div>
                    
                    
                      
                  <footer class="panel-footer text-right bg-light lter">
                       <!-- 
                        <a href="{{url('/admin/User/edit')}}" class="btn btn-success">Edit</a>
                        <a href="{{url('/admin/User/')}}" class="btn btn-danger">Back</a> -->
                      </footer>






                     </div>








          <div class="modal fade" id="formConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title" id="frm_title">Delete</h4>
                </div>
                <div class="modal-body" id="frm_body">Are you sure, you want to delete this Topic ?</div>
                <div class="modal-footer">
                  <button style='margin-left:10px;' type="button" class="btn btn-danger col-sm-2 pull-right" id="frm_submit">Confirm</button>
                  <button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">Cancel</button>
                </div>
              </div>
            </div>
          </div>         
                     {{Form::close()}}
                      
                      
          

</section>
</section>
</section>



 @endsection


 @section('scripts')

<script>

$(document).ready(function(){

     
  $('.formConfirm').on('click', function(e) {
    //alert();
        e.preventDefault();
        var el = $(this);
        // alert(el);
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');
        
        $('#formConfirm')
        .find('#frm_body').html(msg)
        .end().find('#frm_title').html(title)
        .end().modal('show');
        
        $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
  });
  $('#formConfirm').on('click', '#frm_submit', function(e) {
        // console.log($('.frmDelete'));
        $('.frmDelete').submit();        
  });
});
</script>
 @endsection
