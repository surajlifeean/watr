 @extends('admin.adminmain')
 @section('title',"Admin | Doctor")
 @section('stylesheets')

 	  <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

 @endsection

 @section('content')

      <div id="content">

        <!-- Topbar -->

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Courses</h1>
          <p class="mb-4"> 
          	<!-- <a target="_blank" href="https://datatables.net">official DataTables documentation</a>. -->
          </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listing of Courses</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Duration</th>
                      <th>Status</th>
                      <th>Added On</th>
                      <th>Actions</th>
                      <!-- <th>Salary</th> -->
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <!-- <th>Image</th> -->
                      <th>Name</th>
                      <th>Duration</th>
                      <th>Status</th>
                      <th>Added On</th>
                      <th>Actions</th>

                      <!-- <th>Salary</th> -->
                    </tr>
                  </tfoot>
                  <tbody>
                    @if(count($courses)>0)
                          @php $prev=''; @endphp
                          
                    @endif

                  	@foreach($courses as $course)
                          @php $curr=$course['name'];
                           @endphp

                    @if($prev!=$curr)
                  	 <tr>
                      <td>{{$course->name}}</td>
                      <td>{{$course->duration}}</td>
                      <td>{{$course->status=='A'?'Active':'Inactive'}}</td>
                      <td>{{$course->created_at}}</td>
                      <td>
                      <a href="{{route('course-management.edit',$course->name)}}"  class="btn"><i class="fas fa-pen"></i></a>
                      <a href="{{route('course-management.show',$course->name)}}" data-toggle="tooltip" title="Course Details" class="btn">
                      <i class="fas fa-eye"></i>
                      </a>
                      <!-- &nbsp &nbsp &nbsp<i class="fas fa-trash"></i> -->
                      <button class="formConfirm" data-form="#frmDelete-{{$course->id}}" data-title="Delete Details" data-message="Are you sure, you want to delete this Entry?" >
                          <i title="Delete" style="margin-right: 0;" class="fas fa-trash" aria-hidden="true"></i>

                      </button>
                      {!! Form::open(array(
                              'url' => route('admin.course-management.delete', array($course->id)),
                              'method' => 'get',
                              'style' => 'display:none',
                              'id' => 'frmDelete-'.$course->id
                          ))
                      !!}
                      {!! Form::submit('Submit') !!}
                      {!! Form::close() !!}
                    </td>

                    </tr>
                      @php $prev=$course['name'];
                      @endphp

                    @endif

                  	@endforeach
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

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
                     



 @endsection

 @section('scripts')

   <!-- Page level plugins -->
  <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function(){

     
  $('.formConfirm').on('click', function(e) {
    //alert();
        e.preventDefault();
        var el = $(this);
        //alert(el);
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
        var id = $(this).attr('data-form');
        //alert(id);
        $(id).submit();
  });
});

</script>
 @endsection
 