@extends('layouts.dentist')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Adauga o programare noua</div>
        <div class="card-body">    
            <form action="/dentist/appointments" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
                    <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="service_name">Service name</label>
                            <div class="">
                            <select name="service_name" class="form-control select2" required>
                              @foreach($services as $id => $service)
                                  <option value="{{ $service->servicename }}" >{{ $service->servicename }}</option>
                              @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
 
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="service_name">Date</label>
                          <div class="">
                            <input type="date" id="date" name="date" class="form-control datetime" required>

                          </div>
                          
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="service_name">Hour</label>
                          <div class="">
                            <input type="time" id="time" name="time" class="form-control datetime" required>

                          </div>
                          
                        </div>
                      </div>
 
                      <div class=" col-md-3 "> &nbsp;<br/>
                      <button type="submit" class="btn btn-success">Add appointment</button>
                      </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">Appointments List </div>

    <div class="card-body">
        <table id="table" class=" table text-center  table-bordered table-striped table-hover ajaxTable datatable datatable-Service">
            <thead>
                <tr>
                    <th width="10"></th>
                    <th>ID</th>
                    <th>Service name</th>
                    <th>Date</th>
                    <th>Hour</th>
                    <th>Created By</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            {{csrf_field()}}

            @foreach ($appointments as $key=> $value)
                <tr class="post{{$value->id}}">
                    <th width="10">-</th>
                    <th>{{$value->id}}</th>
                    <th>{{$value->service_name}}</th>
                    <th>{{Carbon\Carbon::parse($value->start_date)->format('Y-m-d')}}</th>
                    <th>{{Carbon\Carbon::parse($value->start_date)->format('H:i')}}</th>
                    <th>{{$value->created_by}}</th>
                    <th >
                        <a href="#" class="edit-modal btn btn-info btn-sm mx-auto" data-id="{{$value->id}}"
                                                                                   data-service_name="{{$value->service_name}}"
                                                                                    data-start_date="{{$value->start_date}}"
                                                                                     >
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}"">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </th>
                </tr>
            @endforeach
        </table>
    </div>
</div>



{{-- Modal Form Edit adn Delete Post --}}

<div id="editAndDeleteService" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    
                    <div class="form-group ">
                        <label class="control-label" for="title">Service name</label>
                        <div>
                            <input type="name" class="form-control" id="sn" name="servicename" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="start_date">Start date</label>
                        <div>
                            <input type="datetime" class="form-control" id="t" name="time" required>
                        </div>
                    </div>
                </form>
                {{--Delete form--}}
                <div class="deleteContent">
                    <h3>Are you sure that you want to delete this Appointment? 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn actionBtn" data-dismiss="modal">
                  <span id="footer_action_button" class="glyphicon"></span>
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                  <span class="glyphicon glyphicon"></span>Close
                </button>
              </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script type="text/javascript">

    {{-- ajax Form Edit Post--}}
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update Post");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Appointment Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();

        $a=$(this).data('id');
        $('#sn').val($(this).data('service_name'));
        $('#t').val($(this).data('start_date'));
        $('#editAndDeleteService').modal('show');
      });
      $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
          type: 'POST',
          url: '/dentist/appointments/editAppointment',
          data: {
            '_token':$('input[name=_token]').val(),
            'id':$a,
            'service_name': $('#sn').val(),
            'start_date': $('#t').val(),
          },
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          success: function(data){
                var a=new Date(data.start_date);
                var aa=a.getFullYear()+'-'+a.getMonth()+'-'+a.getDay();
                $('.post'+data.id).replaceWith("<tr class='post" + data.id + "'>"+
                "<th>-</th>"+
                "<th>" + data.id + "</th>"+
                "<th>" + data.service_name + "</th>"+
                "<th>" + data.start_date +" </th>"+
                "<th>" + data.start_date + "  </th>"+
                "<th>" + data.created_by + " </th>"+
                "<th><button class='edit-modal btn btn-info btn-sm mx-auto'data-id="+data.id+" data-servicename="+data.service_name+" data-start_date="+data.start_date+" >"+
                            "<i class='fas fa-edit'></i>"+
                        "</button>  "+
                        "<button class='delete-modal btn btn-danger btn-sm' data-id="+data.id+">"+
                        "   <i class='fas fa-trash-alt'></i>"+
                        "</button>"+
                "</th> ");
            },
        });
      });  
    

      //delete 
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete Post');
        $id=$(this).data('id');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.title').html($(this).data('title'));
        $('#editAndDeleteService').modal('show');
        });

        $('.modal-footer').on('click', '.delete', function(){
        $.ajax({
            type: 'POST',
            url: '/dentist/appointments/deleteAppointment',
            data: {
            '_token': $('input[name=_token]').val(),
            'id': $id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
            $('.post' + $id).remove();
            }
        });
    });
</script>


@endsection

