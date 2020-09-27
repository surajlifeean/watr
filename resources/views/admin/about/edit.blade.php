 @extends('admin.adminmain')
 @section('title',"Admin | Course")
 @section('stylesheets')

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

 @endsection

 @section('content')
<section id="content">
<section class="vbox">
<section class="scrollable padder">

 			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href=""><i class="fa fa-home"></i>Home</a></li>>
                <li><a href="">About Watr</a></li>
                <!-- <li><a href="">Edit Course</a></li> -->
            </ul>

                      <!-- {{Form::open(['route' => 'aboutus.store','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}} -->

                      {{Form::model($about,['route' =>['aboutus.update',1],'method'=>'PUT','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}}



                      <div class="panel-body">                   
                         <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">About Details</label>
                          <div class="col-sm-9">


                                    <div class="col-xs-12">
                                        <div class="col-md-12" >
                                            <!-- <h3> Actions</h3> -->

                                            @php

                                              $i=0;

                                            @endphp
                                            @foreach($about as $c)

                                            <div id="field">
                                            <div id="field{{$i}}">

                            <!-- Text input-->
                                  <div class="form-group">


                                              <label class="col-sm-3 control-label">Select An Image(Min Dimension:800x400)</label>
                                                <div class="col-sm-9">
                                                    <div class="input_fields_wrap">
                                                          <div style="margin-bottom:10px;">
                                                               <input type="file" name="image_name[]" class="GalleryImage" id="img0"/> {{$c->image}}
                                                          </div>

                                                   </div>      
                                             </div>
                                            <input type="hidden" name="id[]" value="{{$c->id}}">
                                             @if($c->type=='about')


                                            <input type="hidden" name="type[]" value="about">
                                            <input type="hidden" name="title[]" value="about">

                                            <div class="form-group">
                                              <label class="col-sm-3 control-label">About us</label>
                                              <div class="col-sm-9">
                                                <textarea class="summernote" name="text[]" class="form-control" required>{!!$c->text!!}</textarea> 
                                              </div>
                                            </div> 



                                             @else

                                              <label class="col-sm-3 control-label">Type</label>
                                                <div class="col-sm-9">
                                                <select name="type[]" required>
                                                    <option value="">select</option>
                                                    <option value="product" {{$c->type=='product'?'selected':''}}>Product</option>
                                                    <option value="service" {{$c->type=='service'?'selected':''}} >Service</option>
                                                    <option value="career" {{$c->type=='career'?'selected':''}}>Career</option>
                                                    <option value="founder" {{$c->type=='founder'?'selected':''}}>Founder</option>
                                                </select>
                                                </div>


                                                  <label class="col-md-4 control-label" for="action_id">Title</label>  
                                                  <div class="col-md-5">
                                                  <input id="action_id" name="title[]" type="text" value="{{$c->title}}" placeholder="" class="form-control input-md" required>
                                                  </div>

                                                </div>
                                                <!-- Text input-->
                                                <div class="form-group">
                                                  <label class="col-md-4 control-label" for="action_name">Text</label>  
                                                  <div class="col-md-5">
                                                  <textarea class="" cols="100" name="text[]" class="form-control" required>{{$c->text}}</textarea> 
                                                    
                                                  </div>
                                                </div>


                                                @endif

                                              @php $i+=1; @endphp

                                    <!-- <div class="form-group"> -->
                                        <!-- <div class="col-md-4"> -->
                                          <button id="remove{{$i-1}}" class="btn btn-danger remove-me" >Remove</button>
                                        <!-- </div> -->
                                                <br><br>
                                                </div>
                                                </div>
                                                @endforeach
                                                <!-- Button -->
                                                <div class="form-group">
                                                  <div class="col-md-4">
                                                    <button id="add-more" name="add-more" class="btn btn-primary">Add More</button>
                                                  </div>
                                                </div>
                                                <br><br>
                                        </div>
                                    </div>
                                </div>
                              


                          </div>
                        </div>

                        <div class="line line-dashed line-lg pull-in"></div>
              
                  <footer class="panel-footer text-right bg-light lter">
                       
                          <input type="submit" class="btn btn-success btn-s-xs" value="Submit"/>

                        <a href="{{url('/admin/course-management')}}" class="btn btn-danger">Cancel</a>
                      </footer>


                     </div>

                     {{Form::close()}}
                      
                      
          

</section>
</section>
</section>



 @endsection


@section('scripts')

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>


<script type="text/javascript">
  $(document).ready(function () {
    //@naresh action dynamic childs


var next = <?php echo json_encode($i) ?>;
var i = <?php echo json_encode($i) ?>;


    // var next = 0;
    var next=<?php echo json_encode($i-1); ?>;
    // alert(next);
    $("#add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        console.log(next,i);
        var newIn = '<div id="field'+ next +'" name="field'+ next +'"><div class="form-group"><label class="col-sm-3 control-label">Select An Image(Min Dimension:800x400)</label><div class="col-sm-9"><div class="input_fields_wrap"><div style="margin-bottom:10px;"><input type="file" name="image_name[]" class="GalleryImage" id="img0" required/>&nbsp</div></div></div><label class="col-sm-3 control-label">Type</label><div class="col-sm-9"><select name="type[]" required><option value="">select</option><option value="product">Product</option><option value="service">Service</option><option value="career">Career</option></select></div></div><!-- Text input--><label class="col-md-4 control-label" for="action_id">Title</label><div class="col-md-5"><input id="action_id" name="title[]" type="text" placeholder="" class="form-control input-md" required></div><div class="form-group"><label class="col-md-4 control-label" for="action_name">Description</label><div class="col-md-5"><textarea class="" cols="100" name="text[]" class="form-control" required></textarea></div></div><br><br></div>';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        if(next!=i)
          $(addRemove).after(removeButton);

        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });

});

</script>
 
 <script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
  </script>


@endsection