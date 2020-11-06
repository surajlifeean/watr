 @extends('admin.adminmain')
 @section('title',"Partner")
 @section('stylesheets')

 @endsection

 @section('content')
<section id="content">
<section class="vbox">
<section class="scrollable padder">

 			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href=""><i class="fa fa-home"></i>Home</a></li>>
                <li><a href="">Partner management</a></li>>
                <li><a href="">View Partner</a></li>
            </ul>

                       <header class="panel-heading">
                        <span class="h4">Partner Details</span>
                      </header>
<form>
                      <div class="panel-body">                   
                         <div class="form-group">
                          <label class="col-sm-3 control-label">Lab Name</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$partner->labname, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>
                         <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Contact Person</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$partner->contactperson, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                       <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Number</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$partner->number, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Address</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$partner->address, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                       <div class="form-group">
                          <label class="col-sm-3 control-label">State/City/PinCode</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$partner->state.", ".$partner->city.", ".$partner->pincode, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                       <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Designation</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$partner->designation, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Pan No.</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$partner->panno, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>


                       <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">GST No.</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$partner->gstno, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>


                       <div class="line line-dashed line-lg pull-in"></div>
                      
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                            <select name="status" disabled="true">
                         <option value="">select</option>
                         <option value="A" {{$partner->status=='A'?'selected':''}}>Active</option>
                         <option value="I" {{$partner->status=='I'?'selected':''}}>Inactive</option>
                        


                           </select>

                          </div>
                         </div>
              
              <label class="col-sm-3 control-label">Partner Test Parameter Costs</label>
              
              <div class="table-responsive">
                    <table class="table">
                      <tr>
                      <td>
                      <b>Parameters Name</b>
                      </td>
                      <td><b>Partner Cost</b></td>
                      <td><b>Watr Cost</b></td>
                      <td><b>Difference</b></td> 
                      </tr>
                    @foreach($partner->parameters as $test)
                          <tr>
                            <td>
                            {{$test->name}}
                            </td>
                            <td>{{$test->pivot->cost}}</td>

                            <td>{{$test->cost}}</td>
                      <td>{{$test->pivot->cost-$test->cost}}</td>

                          <tr>
                    @endforeach
                  
                </table>
              </div>
                    
                       <div class="line line-dashed line-lg pull-in"></div>
                      
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Partner Doc</label>
                          <div class="col-sm-4">
                            <!-- <a href="{{public_path('/images/partner/gst/'.$partner->gstfile)}}">GST</a> -->
                            <a href="{{asset('/images/partner/gst/'.$partner->gstfile)}}" target="_blank"s>GST</a>

                          </div>

                        <div class="col-sm-4">
                            <!-- <a href="{{public_path('/images/partner/gst/'.$partner->gstfile)}}">GST</a> -->
                            <a href="{{asset('/images/partner/pan/'.$partner->panfile)}}" target="_blank"s>Pan</a>

                          </div>

                          <div class="col-sm-4">
                            <!-- <a href="{{public_path('/images/partner/gst/'.$partner->gstfile)}}">GST</a> -->
                            <a href="{{asset('/images/partner/cheque/'.$partner->chequefile)}}" target="_blank"s>Cheque</a>

                          </div>

                         </div>


                         

                                        
                      
                  <footer class="panel-footer text-right bg-light lter">
                       <!-- 
                        <a href="{{url('/admin/partner/edit')}}" class="btn btn-success">Edit</a>
                        <a href="{{url('/admin/partner/')}}" class="btn btn-danger">Back</a> -->
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
