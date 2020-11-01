@extends('admin.adminmain')
@section('title',"Order")
@section('stylesheets')

<style>
.cust-btn {
    color: #fff;
    background-color: #1cc88a;
    border-color: #1cc88a;
    display: inline-block;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .35rem;
    transition: color .15s;
}


  </style>
@endsection

@section('content')
<section id="content">
<section class="vbox">
<section class="scrollable padder">

 			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href=""><i class="fa fa-home"></i>Home</a></li>>
                <li><a href="">Report Management</a></li>>
                <li><a href="">Report Details</a></li>
            </ul>

                       <header class="panel-heading">
                        <span class="h4">Report Details</span>
                      </header>
                      {{Form::model($order,['route' =>['report.update',$order->id],'method'=>'PUT','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}}

                      <div class="panel-body">                   

                      <div class="form-group">
                              <label class="col-sm-3 control-label">Assingned To:</label>
                              <div class="col-sm-9">
                                  
                                  <select name="partner" required>
                                      <option value="">Select Partner</option>
                                      @php

                                        if(isset($order->partners[0]))
                                         $ass_pt=$order->partners[0];
                                        else
                                          $ass_pt=null;
                                        
                                      @endphp

                                      

                                      @foreach($partners as $partner)
                                      <option value="{{$partner->id}}"
                                        {{$ass_pt['id']==$partner->id?'selected':''}}>{{$partner->labname}}</option>
                                      <!-- <option value="I">Inactive</option> -->
                                      @endforeach

                                  </select>

                              </div>
                      </div>

                      

<div class="form-group">
<label class="col-sm-3 control-label">Note:</label>
<textarea name="note"  rows="4" cols="50" class="col-sm-12">
  
</textarea>

</div>
              <label class="col-sm-3 control-label">Ordered Tests</label>
              

              <div class="table-responsive">
                    <table class="table">
                      <tr>
                      <td>
                      <b>Test Name</b>
                      </td>
                      <td><b>Parameters Name</b></td>
                      <td><b>MCL</b></td>
                      <td><b>MDL</b></td>
                      <td><b>Result</b></td>
                      <td><b>Outcome(Low/High)</b></td> 
                      </tr>
                    

                        @if(count($reports)!=0)
                          
                          @foreach($reports as $report)

                              <tr>
                                <td>
                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" name="test[test][]" value='{{$report->test_name}}' required>
                                      </div>
                                  </div>
                                </td>
                                <td>
                                  
                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" name="test[parameter][]" value='{{$report->parameter}}' required>
                                      </div>
                                  </div>


                                </td>
                                
                                <td>
                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" name="test[mcl][]" value='{{$report->mcl}}' required>
                                      </div>
                                  </div>
                                </td>
                                  
                                <td>
                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" name="test[mdl][]" value='{{$report->mdl}}' required>
                                      </div>
                                  </div>
                                </td>



                                <td>                                                                   
                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" name="test[result][]" value='{{$report->result}}' required>
                                      </div>
                                  </div>
                                </td>
                                <td>

                            <select name="test[outcome][]" required>

                              <option value="">select</option>
                              <option value="Low" {{$report->outcome=='Low'?'selected':''}} >Low</option>
                              <option value="Normal" {{$report->outcome=='Normal'?'selected':''}}>Normal</option>
                              <option value="High" {{$report->outcome=='High'?'selected':''}}>High</option>


                           </select>

                                </td>

                          </tr>


                          @endforeach

                        @else

                          @foreach($order->tests as $test)

                          @foreach($test->parameters as $parameters)
                          <tr>
                                <td>
                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" name="test[test][]" value='{{$test->name}}' required>
                                      </div>
                                  </div>
                                </td>
                                <td>
                                  
                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" name="test[parameter][]" value='{{$parameters->name}}' required>
                                      </div>
                                  </div>


                                </td>
                                
                                <td>
                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" name="test[mcl][]" required>
                                      </div>
                                  </div>
                                </td>
                                  
                                <td>
                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" name="test[mdl][]" required>
                                      </div>
                                  </div>
                                </td>



                                <td>                                                                   
                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" name="test[result][]" required>
                                      </div>
                                  </div>
                                </td>
                                <td>

                            <select name="test[outcome][]" required>

                            
                              <option value="">select</option>
                              <option value="Low">Low</option>
                              <option value="Normal">Normal</option>
                              <option value="High">High</option>


                           </select>

                                </td>

                          </tr>
                          @endforeach
                        @endforeach

                      @endif
                  
                </table>
              </div>



            <input type="submit" class="btn btn-success btn-s-xs" value="Update"/>

            <!-- <input type="submit" class="btn btn-success btn-s-xs" value="Generate Report"/> -->


            </div>



    
                     {{Form::close()}}
<br>
                    <!-- <a href="{{url('/admin/parameter')}}" class="btn btn-danger">Cancel</a> -->



@if(count($reports)>0)
                    <a href="{{url('admin/pdfreport/'.$order->id)}}"><button class="cust-btn">Generate Report</button></a>
@if(!is_null($reports[0]->filename))
                    <a href="{{asset('/images/reports/'.$reports[0]->filename)}}" target="_blank"s>Check report</a>
  
@endif               
@endif    
          

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
