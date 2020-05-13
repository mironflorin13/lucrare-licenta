@extends('layouts.dentist  ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label for="location">Location</label>
                    <input  type="text" 
                            class="form-control @error('location') is-invalid @enderror"
                            id="location"
                            name="location"
                            value="{{old('title')??$user->dentist_profiles->location}}"
                            >
                    @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{old('address')??$user->dentist_profiles->address}}" >
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Address">Phone number</label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" maxlength="10" value="{{old('phone')??$user->dentist_profiles->phone}}" >
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Schedule Monday to Friday</label>
                    <input type="text" class="form-control @error('shedule_m_f') is-invalid @enderror" id="schedule_m_f" name="schedule_m_f" value="{{old('schedule_m_f')??$user->dentist_profiles->schedule_m_f}}" >
                    @error('schedule_m_f')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Schedule Saturday</label>
                    <input type="text" class="form-control @error('shedule_sat') is-invalid @enderror" id="schedule_sat" name="schedule_sat" value="{{old('schedule_sat')??$user->dentist_profiles->schedule_sat}}" >
                    @error('schedule_sat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Schedule Sunday</label>
                    <input type="text" class="form-control @error('shedule_sun') is-invalid @enderror" id="schedule_sun" name="schedule_sun" value="{{old('schedule_sun')??$user->dentist_profiles->schedule_sun}}" >
                    @error('schedule_sun')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    
                    <label for="description">Description</label>
                    <textarea type="text"
                              class="form-control @error('description') is-invalid @enderror"
                              id="description"
                              rows="3"
                              name="description"
                              >{{$user->dentist_profiles->description}}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> 
               
                <label for="imag">Profile Image</label>  
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="image">
                    <label class="custom-file-label" for="customFile">{{$user->dentist_profiles->image}}</label>
                  </div>
            
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    
@endsection