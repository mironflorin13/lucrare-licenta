@extends('layouts.dentist')

@section('content')


<div class="card" >
    <div class="card-header">Add a new appointment</div>
    <div class="card-body text-center ">    
        <form action="/dentist/appointments" class="form-prevent-multiple-submit" method="POST" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="row d-flex justify-content-cente">

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Service name*</label>
                        <select name="service_name" class="form-control select2" required>
                            @foreach($services as $id => $service)
                                <option value="{{ $service->servicename }}" >{{ $service->servicename }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Patient Name*</label>
                        <input id="patient_name" maxlength="35" name="patient_name" class="form-control" value="{{ old('patinet_name') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Date*</label>
                        <input  id="time" name="time" class="form-control datetime" value="{{ old('time') }}" onkeydown="return false">
                    </div>
                </div>


                <div class="col-md-2">
                    <div class="form-group" >
                        <label>Phone*</label>
                        <input id="phone" maxlength="10" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group" >
                        <label>Duration*</label>
                        <select name="duration" class="form-control" required>
                                <option value="15">15min</option>
                                <option value="30">30min</option>
                                <option value="60"selected>60min</option>
                                <option value="90">1:30</option>
                                <option value="120">2hours</option>
                                <option value="150">2:30</option>
                                <option value="180">3hours</option>
                                <option value="210">3:30</option>
                                <option value="240">4hours</option>
                                <option value="270">4:30</option>
                                <option value="300">5hours</option>   
                        </select>
                    </div>
                </div>
            </div>
            <div class="pull-right"> &nbsp;<br/>
                <button type="submit" class="btn btn-success button-prevent-multiple-submit">Add appointment</button>
            </div>
        </form>
    </div>
</div>



<div class="card">
    <div class="card-header">Appointments List </div>

    <div class="card-body">
        <table id="table" class=" table text-center  table-bordered table-striped table-hover ajaxTable datatable datatable-Service">
            <thead>
                <tr>
                    <th width="10"></th>
                    <th>Service name</th>
                    <th>Date and Hour</th>
                    <th>Patient name</th>
                    <th>Phone</th>
                    <th>Duration(min)</th>
                    <th>Created By</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>


            @foreach ($appointments as $key=> $value)
                <?php 
                    $parsed = date_parse($value->duration);
                    $duration = $parsed['hour'] * 60 + $parsed['minute'];
                ?>
                <tr class="post{{$value->id}}">
                    <th width="10">-</th>
                    <th>{{$value->service_name}}</th>
                    <th>{{$value->start_date}}</th>
                    <th>{{$value->patient_name}}</th>
                    <th>{{$value->phone}}</th>
                    <th>{{$duration}}</th>
                    <th>{{$value->created_by}}</th>
                    <th >
                        <a href="#" class="edit-modal btn btn-info btn-sm mx-auto" 
                                    data-id="{{$value->id}}"
                                    data-service_name="{{$value->service_name}}"
                                    data-start_date="{{$value->start_date}}"
                                    data-duration = "{{$duration}}" >
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
                    
                    <div class="form-group">
                        <label class="control-label">Service name</label>
                        <div>
                            <input type="name" class="form-control" id="sn" name="servicename" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Start date</label>
                        <div>
                            <input  id="t" name="time" class="form-control datetime1" format="Y-M-D HH:mm" onkeydown="return false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label ">Approximate duration(min)</label>
                        <div>
                            {{-- <input type="text" class="form-control" id="dur" name="duration" required> --}}
                            <select name="duration" id="dur" class="form-control" required>
                                <option value="15">15min</option>
                                <option value="30">30min</option>
                                <option value="60"selected>60min</option>
                                <option value="90">1:30</option>
                                <option value="120">2hours</option>
                                <option value="150">2:30</option>
                                <option value="180">3hours</option>
                                <option value="210">3:30</option>
                                <option value="240">4hours</option>
                                <option value="270">4:30</option>
                                <option value="300">5hours</option>   
                        </select>
                        </div>
                        
                    </div>
                </form>
                {{--Delete form--}}
                <div class="deleteContent">
                    <h3>Are you sure that you want to delete this Appointment? </h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id='aaa'class="btn actionBtn" >
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


<script type="text/javascript">
    $(document).ready( function(){
        $('.datetime').datetimepicker({
            format: 'Y-M-D HH:mm',
            sideBySide: true,            
            locale: 'en',
            minDate: new Date(),
            disabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 20, 21, 22, 23, 24],
            stepping: 15,
            icons: {
                    time: 'far fa-clock',
                    date: 'far fa-calendar',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-chevron-left',
                    next: 'fas fa-chevron-right',
                    today: 'fas fa-calendar-check',
                    clear: 'far fa-trash-alt',
                    close: 'far fa-times-circle'
                }
        }).on('change', function(){
                $('.datetimepicker').hide();
        });

    });
    
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

        $a = $(this).data('id');
        
        $('#sn').val($(this).data('service_name'));
        $('#t').val($(this).data('start_date'));
        $('#dur').val($(this).data('duration'));
        $('#editAndDeleteService').modal('show');
      });
     
      $('.datetime1').datetimepicker({
            format: 'Y-M-D HH:mm:ss',
            daysOfWeekDisabled: [0,6],
            sideBySide: true,
            
            locale: 'en',
            minDate: new Date(),
            daysOfWeekDisabled: [0,6],
            disabledHours: [0, 1, 2, 3, 4, 5, 6, 7, 17, 18, 19,20, 21, 22, 23, 24],
            stepping: 15,
            icons: {
                    time: 'far fa-clock',
                    date: 'far fa-calendar',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-chevron-left',
                    next: 'fas fa-chevron-right',
                    today: 'fas fa-calendar-check',
                    clear: 'far fa-trash-alt',
                    close: 'far fa-times-circle'
                }
        }).on('change', function(){
                $('.datetimepicker').hide();
        });
      $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
          type: 'POST',
          url: '/dentist/appointments/{$id}',
          data: {
            '_token':$('input[name=_token]').val(),
            'id':$a,
            '_method':'PUT',
            'service_name': $('#sn').val(),
            'start_date': $('#t').val(),
            'duration': $('#dur').val(),
          },
          
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          success: function(data){
                $('#editAndDeleteService').modal('hide');
                $('.post'+data.id).replaceWith("<tr class='post" + data.id + "'>"+
                "<th>-</th>"+
                "<th>" + data.service_name + "</th>"+
                "<th>" + data.start_date +" </th>"+
                "<th>" + data.patient_name+ "</th>"+
                "<th>" + data.phone + "  </th>"+
                "<th>" + data.duration + "</th>"+
                "<th>" + data.created_by + " </th>"+
                "<th><button class='edit-modal btn btn-info btn-sm mx-auto' data-id="+data.id+ " data-service_name="+data.service_name+ " data-start_date="+data.start_date+" data-duration="+data.duration+" >"+
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
            url: '/dentist/appointments/{$id}',
            data: {
            '_token': $('input[name=_token]').val(),
            'id': $id,
            '_method': 'DELETE'
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                $('#editAndDeleteService').modal('hide');
                $('.post' + $id).remove();
    
            }
        });
    });
</script>


@endsection

