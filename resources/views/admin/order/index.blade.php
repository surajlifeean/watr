 @extends('admin.adminmain')
 @section('title',"Admin | Order")
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
          <h1 class="h3 mb-2 text-gray-800">orders</h1>
          <p class="mb-4"> 
          	<!-- <a target="_blank" href="https://datatables.net">official DataTables documentation</a>. -->
          </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listing of Orders</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Phone No.</th>
                      <th>Ordered Test</th>
                      <th>Ordered On</th>
                      <th>Collection Date</th>
                      <th>Bill</th>
                      <th>Assigned To</th>
                      <th>Actions</th>
                      <!-- <th>Salary</th> -->
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <!-- <th>Image</th> -->
                      <th>Status</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Phone No.</th>
                      <th>Ordered Test</th>
                      <th>Ordered On</th>
                      <th>Collection Date</th>
                      <th>Bill Amount</th>
                      <th>Assigned To</th>
                      <th>Actions</th>

                      <!-- <th>Salary</th> -->
                    </tr>
                  </tfoot>
                  <tbody>

@if(isset($orders))

                  	@foreach($orders as $order)
                  	 <tr>
                      <td>
                        @if($order->order_status=='1')
                          {{'Ordered'}}
                        @elseif($order->order_status=='2')
                         {{'Sample Collected'}}
                        @elseif($order->order_status=='3')
                         {{'Analysis Made'}}
                         @else
                         {{'Report Generated'}} 
                        @endif
                      </td>
                      <td>{{$order->name}}</td>
                      <td>{{$order->address}}, {{$order->state}},{{$order->pin}}</td>
                      <td>{{$order->phone}}</td>
                      <td>
                        
                        @foreach($order->tests as $test)
                          <span class='label label-primary'>{{$test->name}}</span>|
                        @endforeach

                      </td>

                      <td>{{$order->created_at}}</td>
                      <td>{{$order->pickup_date}}</td>
                      <td>Rs{{$order->billamt}}</td>
                      <td>{{is_null($order->partners)?'None':$order->partners[0]->labname}}</td>
                      <td>
                      <a href="{{route('order.show',$order->id)}}"  class="btn"><i class="fas fa-pen"></i></a>
                      <a href="{{route('report.show',$order->id)}}"  class="btn"><i class="fa fa-file"></i></a>

                    </td>

                    </tr>

                  	@endforeach
@else
<tr><td colspan="10">No order has been assigned to you</td>
</tr>
@endif

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
 