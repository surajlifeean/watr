 @extends('admin.adminmain')
 @section('title',"Admin | Test")
 @section('stylesheets')

 	  <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style type="text/css">

    .label {
      color: white;
      /*padding: 3px;*/
    }

    .label-primary {background-color: #4CAF50;}       
    
    </style>

 @endsection

 @section('content')

      <div id="content">

        <!-- Topbar -->

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tests</h1>
          <p class="mb-4"> 
          	<!-- <a target="_blank" href="https://datatables.net">official DataTables documentation</a>. -->
          </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listing of Tests</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Typ</th>
                      <th>Name</th>
                      <th>Specific Instructions</th>
                      <th>Parameters</th>
                      <th>Total Cost</th>
                      <th>Status</th>
                      <th>Added On</th>
                      <th>Actions</th>
                      <!-- <th>Salary</th> -->
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <!-- <th>Image</th> -->
                      <th>Typ</th>
                      <th>Name</th>
                      <th>Specific Instructions</th>
                      <th>Parameters</th>
                      <th>Total Cost</th>
                      <th>Status</th>
                      <th>Added On</th>
                      <th>Actions</th>

                      <!-- <th>Salary</th> -->
                    </tr>
                  </tfoot>
                  <tbody>

                  	@foreach($tests as $test)
                  	 <tr>
                      <td>{{$test->type}}</td>
                      <td>{{$test->name}}</td>
                      <td>{{$test->instructions}}</td>

                      @php
                        $total_cost=0;
                        $pname='';
                        foreach($test->parameters as $param){
                          $total_cost=$total_cost+$param->cost;
                          $pname=$param->name.','.$pname;
                        }
                        
                      @endphp

                      <td>

                        @foreach($test->parameters as $param)

                          <span class='label label-primary'>{{$param->name}}</span>|
                        @endforeach

                      </td>
                      <td>{{$total_cost}}</td>

                      <td>{{$test->status=='A'?'Active':'Inactive'}}</td>
                      <td>{{$test->created_at->format('d-m-Y')}}</td>
                      <td>
                      <a href="{{route('test.edit',$test->id)}}"  class="btn"><i class="fas fa-pen"></i></a>
<!--                       <a href="{{route('test.show',$test->id)}}" data-toggle="tooltip" title="test Details" class="btn">
                      <i class="fas fa-eye"></i>
                      </a> -->
                      <!-- &nbsp &nbsp &nbsp<i class="fas fa-trash"></i> -->
                      <button class="formConfirm" data-form="#frmDelete-{{$test->id}}" data-title="Delete Details" data-message="Are you sure, you want to delete this Entry?" >
                          <i title="Delete" style="margin-right: 0;" class="fas fa-trash" aria-hidden="true"></i>

                      </button>
                      {!! Form::open(array(
                              'url' => route('admin.test.delete', array($test->id)),
                              'method' => 'get',
                              'style' => 'display:none',
                              'id' => 'frmDelete-'.$test->id
                          ))
                      !!}
                      {!! Form::submit('Submit') !!}
                      {!! Form::close() !!}

                      <!-- <i class="fa fa-file" aria-hidden="true"></i> -->

                      
                    </td>

                    </tr>
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
 