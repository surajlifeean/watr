@extends('admin.adminmain')
@section('title',"Order")
@section('stylesheets')
@endsection

@section('content')
<section id="content">
<section class="vbox">
<section class="scrollable padder">

 			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href=""><i class="fa fa-home"></i>Home</a></li>>
                <li><a href="">Order Management</a></li>>
                <li><a href="">Order Details</a></li>
            </ul>

                       <header class="panel-heading">
                        <span class="h4">Order Details</span>
                      </header>
                      {{Form::model($order,['route' =>['order.update',$order->id],'method'=>'PUT','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}}

                      <div class="panel-body">                   
                         <div class="form-group">
                          <label class="col-sm-3 control-label">Customer Name</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$order->name, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>
                         <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Address</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$order->address, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label">City</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$order->city, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label">State</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$order->state, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Pin</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$order->pin, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>


                       <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Phone Number</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$order->phone, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                       <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Email</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$order->email, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Pick Up Date</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$order->pickup_date, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>


                       <div class="line line-dashed line-lg pull-in"></div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Bill Amount</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$order->billamt, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label">Pick Up Note</label>
                          <div class="col-sm-9">
                          {{Form::label('Null',$order->pickup_note, ['class' => 'form-control','data-required'=>'true','disabled'])}}
                          </div>
                        </div>


                       <div class="line line-dashed line-lg pull-in"></div>
                      
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Pick Up Time</label>
                          <div class="col-sm-9">
                            <select name="status" disabled="true">
                         <option value="">select</option>
                         <option value="1" {{$order->pickupst_time=='09:00:00'?'selected':''}}>Morning</option>
                         <option value="2" {{$order->pickupst_time=='12:00:00'?'selected':''}}>Noon</option>
                        <option value="3" {{$order->pickupst_time=='16:00:00'?'selected':''}}>Evening</option>


                           </select>

                          </div>
                         </div>
                     <div class="line line-dashed line-lg pull-in"></div>
                      
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Order Status</label>
                          <div class="col-sm-9">
                            <select name="status">
                         <option value="">select</option>
                          <option value="1" {{$order->order_status=='1'?'selected':''}}>Order Placed</option>
                          <option value="2" {{$order->order_status=='2'?'selected':''}}>Sample Collected</option>
                          <option value="3" {{$order->order_status=='3'?'selected':''}}>Analysis</option>
                          <option value="4" {{$order->order_status=='4'?'selected':''}}>Report Generated</option>

                           </select>

                          </div>
                         </div>
              
              <label class="col-sm-3 control-label">Ordered Tests</label>
              
              <div class="table-responsive">
                    <table class="table">
                      <tr>
                      <td>
                      <b>Test Name</b>
                      </td>
<!--                       <td><b>order Cost</b></td>
                      <td><b>Watr Cost</b></td> -->
                      </tr>
                    @foreach($order->tests as $test)
                          <tr>
                            <td>
                            {{$test->name}}
                            </td>
<!--                             <td></td>

                            <td></td> -->
                          <tr>
                    @endforeach
                  
                </table>
              </div>
                    
            <input type="submit" class="btn btn-success btn-s-xs" value="Update"/>


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
