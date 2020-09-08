 @extends('admin.adminmain')
 @section('title',"Admin | Course")
 @section('stylesheets')

 @endsection

 @section('content')
<section id="content">
<section class="vbox">
<section class="scrollable padder">

 			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href=""><i class="fa fa-home"></i>Home</a></li>>
                <li><a href="">Course management</a></li>>
                <li><a href="">Edit Course</a></li>
            </ul>

                      {{Form::open(['route' => 'course-management.store','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}}
                      <div class="panel-body">                   
                         <div class="form-group">
                          <label class="col-sm-3 control-label">Course Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" value="{{$course[0]->name}}" data-required="true" placeholder="Course Name" required>   
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Eligibility</label>
                          <div class="col-sm-9">
                            <textarea class="summernote" name="eligibility" class="form-control" required>{{$course[0]->eligibility}}</textarea> 
<!--                             <input type="text" name="yoe" class="form-control"  data-required="true" placeholder="Years Of Experience" data-parsley-type="digits" maxlength="2" required>    -->
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-sm-3 control-label">Duration</label>
                          <div class="col-sm-9">
                            <input type="text" name="duration" class="form-control" value="{{$course[0]->duration}}" data-required="true" placeholder="Duration" required> 

                          </div>
                        </div>


                         <div class="line line-dashed line-lg pull-in"></div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Syllabus</label>
                          <div class="col-sm-9">


                                    <div class="col-xs-12">
                                        <div class="col-md-12" >
                                            <!-- <h3> Actions</h3> -->

@php

  $i=0;

@endphp
                                            @foreach($course as $c)

                                            <div id="field">
                                            <div id="field{{$i}}">

                                              @php $i+=1; @endphp
                            <!-- Text input-->
                                                <div class="form-group">
                                                  <label class="col-md-4 control-label" for="action_id">Session Name</label>  
                                                  <div class="col-md-5">
                                                  <input id="action_id" name="session_name[]" type="text" value="{{$c->session_name}}" placeholder="" class="form-control input-md" required>
                                                  </div>
                                                  <label class="col-md-4 control-label" for="action_id">Topic</label>  
                                                  <div class="col-md-5">
                                                  <input id="action_id" name="topic[]" type="text" value="{{$c->topic}}" placeholder="" class="form-control input-md" required>
                                                  </div>
                                                </div>
                                                <!-- Text input-->
                                                <div class="form-group">
                                                  <label class="col-md-4 control-label" for="action_name">Description</label>  
                                                  <div class="col-md-5">
                                                  <textarea class="" cols="100" name="description[]" class="form-control" required>{{$c->description}}</textarea> 
                                                    
                                                  </div>
                                                </div>
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
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Status</label>
                          <div class="col-sm-9">
                            <select name="status" required>
                         <option value="">select</option>
                         <option value="A">Active</option>
                         <option value="I">Inactive</option>
                        <option value="A" {{$course[0]->status=='A'?'selected':''}}>Active</option>
                         <option value="I" {{$course[0]->status=='I'?'selected':''}}>Inactive</option>


                           </select>

                          </div>
                         </div>
                    
                    
                      


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
<script type="text/javascript">
  $(document).ready(function () {
    //@naresh action dynamic childs


var next = <?php echo json_encode($i) ?>;


    // var next = 0;
    var next=<?php echo json_encode($i-1); ?>;
    // alert(next);
    $("#add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<div id="field'+ next +'" name="field'+ next +'"><div class="form-group"><label class="col-md-4 control-label" for="session_id">Session Name</label><div class="col-md-5"><input id="session_id" name="session_name[]" type="text" placeholder="" class="form-control input-md" required></div><label class="col-md-4 control-label" for="action_id">Topic</label><div class="col-md-5"><input id="action_id" name="topic[]" type="text" placeholder="" class="form-control input-md" required></div></div><!-- Text input--><div class="form-group"><label class="col-md-4 control-label" for="action_name">Description</label><div class="col-md-5"><textarea class="" cols="100" name="description[]" class="form-control" required></textarea></div></div><br><br></div>';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
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