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
                <li><a href="">Recommendation Management</a></li>>
                <li><a href="">Recomendations</a></li>
            </ul>

                       <header class="panel-heading">
                        <span class="h4">Update/Add Recommendations</span>
                      </header>
                      {{Form::model($recom[0],['route' =>['recommendation.update',$recom[0]->id],'method'=>'PUT','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}}

            <div class="panel-body">                   
              <div class="table-responsive">
                    <table class="table">
                      <tr>
<!--                       <td>
                      <b>Test Name</b>
                      </td> -->
                      <td><b>Parameters Name</b></td>
                      <td><b>Recommendation(High)</b></td>
                      <td><b>Recommendation(Low)</b></td> 
                      </tr>

                    @foreach($param as $parameters)
                          <tr>

                                <td>
                                  {{$parameters->name}}
                                </td>
                                <td>   
                    @php $low=0; $high=0; @endphp

                    @foreach($parameters->recommendations as $recom)

                      @if($recom->pivot->outcome=='High')
                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" value="{{$recom->recommendations}}" name="high-{{$recom->pivot->parameter_id}}-{{$recom->id}}">
                                      </div>
                                  </div>
                                  @php $high=1 @endphp
                      
                      @endif

                    @endforeach

                    @if($high==0)
                                <div class="form-group">
                                   <div class="col-sm-9">
                                   <input type="text" name="high-{{$recom->pivot->parameter_id}}-{{$recom->id}}">
                                    </div>
                                </div>

                    @endif
                                </td>
                                <td>
                    @foreach($parameters->recommendations as $recom)
                      @if($recom->pivot->outcome=='Low')

                                  <div class="form-group">
                                     <div class="col-sm-9">
                                     <input type="text" value="{{$recom->recommendations}}" name="low-{{$recom->pivot->parameter_id}}-{{$recom->id}}">
                                      </div>
                                  </div>
                                  @php $low=1 @endphp
                      @endif
                    @endforeach

                    @if($low==0)
                                <div class="form-group">
                                   <div class="col-sm-9">
                                   <input type="text" name="low-{{$recom->pivot->parameter_id}}-{{$recom->id}}">
                                    </div>
                                </div>
                    
                    @endif


                                </td>
                          </tr>
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
