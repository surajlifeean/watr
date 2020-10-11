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
                <li><a href="{{url('/admin/parameter')}}">recommendation management</a></li>>
                <li><a href="{{url('/admin/parameter/create')}}">Add Recommendations</a></li>
            </ul>

                       <header class="panel-heading">
                        <span class="h4" style="margin-left:12px;"> Add</span>
                      </header>

                      {{Form::model($recom,['route' =>['recommendation.update',$recom->id],'method'=>'PUT','files' => true, 'class'=>'form-horizontal course-form','data-parsley-validate'])}}
                      <div class="panel-body">                   
                         <div class="form-group">
                          <label class="col-sm-3 control-label">Recommendation</label>
                          <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" value="{{$recom->recommendations}}" data-required="true" placeholder="Add Recommendation" required>   
                          </div>
                        </div>

                  <footer class="panel-footer text-right bg-light lter">
                       
                          <input type="submit" class="btn btn-success btn-s-xs" value="Submit"/>

                        <a href="{{url('/admin/parameter')}}" class="btn btn-danger">Cancel</a>
                      </footer>


                     </div>

                     {{Form::close()}}
                      
                      
          

</section>
</section>
</section>



 @endsection


 @section('scripts')

 @endsection
