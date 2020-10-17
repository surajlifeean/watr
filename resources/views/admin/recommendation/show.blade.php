@extends('admin.adminmain')
@section('title',"Order")
 @section('stylesheets')

        <link href="{{asset('admin/css/select2.min.css')}}" rel="stylesheet">
 
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
                      {{Form::model($param[0],['route' =>['param-recomm.update',$param[0]->id],'method'=>'PUT','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}}

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

                                        <select class="js-example-basic-multiple form-control" name="parameters[{{$parameters->id}}][High]" multiple="multiple">
                                          <option value="{{$recom->id}}" selected="selected">{{$recom->recommendations}}</option>   
                                            @foreach($recommends as $key=>$value)
                                            <option value="{{$value}}">{{$key}}</option>
                                            @endforeach
                                          </select>

                                      </div>
                                  </div>
                                  @php $high=1 @endphp
                      
                      @endif

                    @endforeach

                    @if($high==0)
                                <div class="form-group">
                                   <div class="col-sm-9">
                                          <select class="js-example-basic-multiple form-control" name="parameters[{{$parameters->id}}][High]" multiple="multiple">
 
                                            @foreach($recommends as $key=>$value)
                                            <option value="{{$value}}">{{$key}}</option>
                                            @endforeach
                                          </select>
                                    </div>
                                </div>

                    @endif
                                </td>
                                <td>
                    @foreach($parameters->recommendations as $recom)
                      @if($recom->pivot->outcome=='Low')

                                  <div class="form-group">
                                     <div class="col-sm-9">
                                            <select class="js-example-basic-multiple form-control" name="parameters[{{$parameters->id}}][Low]" multiple="multiple">
                                              <option value="{{$recom->id}}" selected="selected">{{$recom->recommendations}}</option>   
                                            @foreach($recommends as $key=>$value)
                                            <option value="{{$value}}">{{$key}}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  @php $low=1 @endphp
                      @endif
                    @endforeach

                    @if($low==0)
                                <div class="form-group">
                                   <div class="col-sm-9">


                                            <select class="js-example-basic-multiple form-control" name="parameters[{{$parameters->id}}][Low]" multiple="multiple">

                                            @foreach($recommends as $key=>$value)
                                            <option value="{{$value}}">{{$key}}</option>
                                            @endforeach
                                          </select>

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


<script src="{{asset('admin/js/select2.min.js')}}"></script>

<script>
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2({
       maximumSelectionLength: 1
    });

    // $('.js-example-basic-multiple').val({!! json_encode($parameters->recommendations()->allRelatedIds())!!});

    $('.js-example-basic-multiple').trigger('change');

});

</script>


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
