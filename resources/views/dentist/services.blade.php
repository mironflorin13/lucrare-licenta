@extends('layouts.dentist')
@section('content')
<div class='service'>
    <div class="service-content">
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" id="addNewService" href="#">
                    Add New Service
                </a>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
               Services List 
            </div>
        
            <div class="card-body" >
                <table id="table" class="table text-center table-bordered table-striped table-hover ajaxTable datatable datatable-Service" >
                    <thead>
                        <tr>
                            <th width="10"></th>
                            <th>Nr</th>
                            <th>Service name</th>
                            <th>Price</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    {{csrf_field()}}
                    <?php $nr=1 ?>
                    @foreach ($post as $value)
                        <tr class="post{{$value->id}}">
                            <th width="10">-</th>
                            <th>{{$nr++}}</th>
                            <th>{{$value->servicename}}</th>
                            <th>{{$value->price}} lei</th>
                            <th >
                                <a href="#" class="edit-modal btn btn-info btn-sm mx-auto" data-id="{{$value->id}}" data-servicename="{{$value->servicename}}" data-price="{{$value->price}}">
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
    </div>
</div>


{{-- Modal Form Create Post --}}
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="form">

                    <div class="form-group ">
                        <div class="error alert alert-danger justify-content-center align-items-center">  
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="success alert alert-success"">  
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="control-label" for="title">Service name</label>
                        <div>
                            <input type="name" maxlength="80" class="form-control" id="title" name="servicename" placeholder="Your Service" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="body">Price</label>
                        <div>
                            <input type="number" class="form-control"  id="price" min="1" max="9999" pattern="\d*" maxlength="4" name="price" placeholder="Add the price for service" required>
                        </div>
                    </div>
                  </form>
            </div>
            
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit" id="add">
                        Save Post
                    </button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
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
                            <input type="name" class="form-control" id="sn" name="servicename" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label " for="body">Price(lei)*</label>
                        <div>
                            <input type="number" class="form-control"  id="p" min="1" max="9999" pattern="\d*" maxlength="4" name="price" required>
                        </div>
                    </div>
                </form>
                {{--Delete form--}}
                <div class="deleteContent">
                    <h3>Are you sure that you want to delete this Service? 
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

    {{-- ajax Form Add Post--}}
      $(document).on('click','#addNewService', function() {
        $('#create').modal('show');
        $('.error').hide();
        $('.success').hide();
        $('.modal-title').text('Add new service');
      });
      $("#add").click(function() {
        $.ajax({
            type: 'POST',
            url: 'services',
            data: {
                '_token':$('input[name=_token]').val(),
                'user_id':{{$user->id}},
                'servicename': $('input[name=servicename]').val(),
                'price': $('input[name=price]').val()
            },
            success: function(data){
                    if ((data.error)) {
                    $('.error').show();
                    $('.success').hide();
                    console.log(data.error);
                    $('.error').html("");
                    $.each(data.error, function(k, v) {
                        $('.error').append('<p>'+data.error[k]+'</p>');
                        
                    });
                    
              
                    } else {
                    $('.success').show();
                    $('.error').hide();
                    $('.success').html("");
                    $('.success').append('<p>'+'Service white name '+data.servicename+' has been added!'+'</p>');
                        
                    $('#table').prepend("<tr class='post" + data.id + "'>"+
                    "<th>-</th>"+
                    "<th>" + data.id + "</th>"+
                    "<th>" + data.servicename + "</th>"+
                    "<th>" + data.price + "lei </th>"+
                    "<th><button class='edit-modal btn btn-info btn-sm mx-auto'data-id="+data.id+" data-servicename="+data.servicename+" data-price="+data.price+" >"+
                                "<i class='fas fa-edit'></i>"+
                            "</button>  "+
                            "<button class='delete-modal btn btn-danger btn-sm' data-id="+data.id+">"+
                            "   <i class='fas fa-trash-alt'></i>"+
                            "</button>"+
                    "</th> ");
                    }
                },

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
        $('.modal-title').text('Edit Service');
        $('.deleteContent').hide();
        $('.form-horizontal').show();

        $id=$(this).data('id');
        $('#sn').val($(this).data('servicename'));
        $('#p').val($(this).data('price'));
        $('#editAndDeleteService').modal('show');
      });
      $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
          type: 'POST',
          url: 'services/{$id}',
          data: {
            '_method': 'PUT',
            '_token':$('input[name=_token]').val(),
            'id':$id,
            'price': $('#p').val()
          },
          success: function(data){
                $('.post'+data.id).replaceWith("<tr class='post" + data.id + "'>"+
                "<th>-</th>"+
                "<th>" + data.id + "</th>"+
                "<th>" + data.servicename + "</th>"+
                "<th>" + data.price + " lei </th>"+
                "<th><button class='edit-modal btn btn-info btn-sm mx-auto'data-id="+data.id+" data-servicename="+data.servicename+" data-price="+data.price+" >"+
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
        $('.modal-title').text('Delete Service');
        $id=$(this).data('id');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.title').html($(this).data('title'));
        $('#editAndDeleteService').modal('show');
        });

        $('.modal-footer').on('click', '.delete', function(){
        $.ajax({
            type: 'POST',
            url: 'services/{$id}',
            data: {
                '_method': 'DELETE',
                '_token': $('input[name=_token]').val(),
                'id': $id
            },
            success: function(data){
                $('.post' + $id).remove();
            }
        });
    });
</script>
@endsection




