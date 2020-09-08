 @extends('admin.adminmain')
 @section('title',"Admin | About us")
 @section('stylesheets')

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

 @endsection

 @section('content')

<section id="content">
<section class="vbox">
<section class="scrollable padder">

 			<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href=""><i class="fa fa-home"></i>Home</a></li>>
                <li><a href="">About us</a></li>
            </ul>


                      {{Form::open(['route' => 'aboutus.store','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}}
                      <div class="panel-body">    

                        <div class="form-group">
                          <label class="col-sm-3 control-label">Select An Image(Min Dimension:800x400)</label>
                          <div class="col-sm-9">

                              <div class="input_fields_wrap">
                                  
                                  
                                    <div style="margin-bottom:10px;">
                                         <input type="file" name="image_name" class="GalleryImage" id="img0" required /> &nbsp 
                                    </div>

                             </div>      
                       </div>
                     </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label">About us</label>
                          <div class="col-sm-9">
                            <textarea class="summernote" name="text" class="form-control" required></textarea> 
<!--                             <input type="text" name="yoe" class="form-control"  data-required="true" placeholder="Years Of Experience" data-parsley-type="digits" maxlength="2" required>    -->
                          </div>
                        </div> 


                  <footer class="panel-footer text-right bg-light lter">
                       
                          <input type="submit" class="btn btn-success btn-s-xs" value="Submit"/>

                        <a href="{{url('/admin/aboutus')}}" class="btn btn-danger">Cancel</a>
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
    var next = 0;
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