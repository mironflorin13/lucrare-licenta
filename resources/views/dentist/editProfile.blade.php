@extends('layouts.dentist  ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/dentist/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input  type="text" 
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            maxlength="40"
                            name="name"
                            value="{{old('title')??$user->dentist_profiles->name}}"
                            >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="location">City</label>
                    <input  type="text" 
                            class="form-control @error('location') is-invalid @enderror"
                            id="location"
                            maxlength="40"
                            name="location"
                            value="{{old('title')??$user->dentist_profiles->location}}" 
                            readonly>
                    @error('location')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" maxlength="70" value="{{old('address')??$user->dentist_profiles->address}}" >
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
                    <select type="text" class="form-control @error('shedule_m_f') is-invalid @enderror" id="schedule_m_f" name="schedule_m_f" value="{{old('schedule_m_f')??$user->dentist_profiles->schedule_m_f}}" >
                        <option value='8:00-15:00' @if ($user->dentist_profiles->schedule_m_f == "8:00-15:00") {{ 'selected' }} @endif >8:00-15:00</option>
                        <option value='8:00-16:00' @if ($user->dentist_profiles->schedule_m_f == "8:00-16:00") {{ 'selected' }} @endif >8:00-16:00</option>
                        <option value='8:00-17:00' @if ($user->dentist_profiles->schedule_m_f == "8:00-17:00") {{ 'selected' }} @endif >8:00-17:00</option>
                        <option value='8:00-18:00' @if ($user->dentist_profiles->schedule_m_f == "8:00-18:00") {{ 'selected' }} @endif >8:00-18:00</option>
                        <option value='8:00-19:00' @if ($user->dentist_profiles->schedule_m_f == "8:00-19:00") {{ 'selected' }} @endif >8:00-19:00</option>
                        <option value='8:00-20:00' @if ($user->dentist_profiles->schedule_m_f == "8:00-20:00") {{ 'selected' }} @endif >8:00-20:00</option>
                        <option value='9:00-15:00' @if ($user->dentist_profiles->schedule_m_f == "9:00-15:00") {{ 'selected' }} @endif >9:00-15:00</option>
                        <option value='9:00-16:00' @if ($user->dentist_profiles->schedule_m_f == "9:00-16:00") {{ 'selected' }} @endif >9:00-16:00</option>
                        <option value='9:00-17:00' @if ($user->dentist_profiles->schedule_m_f == "9:00-17:00") {{ 'selected' }} @endif >9:00-17:00</option>
                        <option value='9:00-18:00' @if ($user->dentist_profiles->schedule_m_f == "9:00-18:00") {{ 'selected' }} @endif >9:00-18:00</option>
                        <option value='9:00-19:00' @if ($user->dentist_profiles->schedule_m_f == "9:00-19:00") {{ 'selected' }} @endif >9:00-19:00</option>
                        <option value='9:00-20:00' @if ($user->dentist_profiles->schedule_m_f == "9:00-20:00") {{ 'selected' }} @endif >9:00-20:00</option>
                        <option value='10:00-17:00' @if ($user->dentist_profiles->schedule_m_f == "10:00-17:00") {{ 'selected' }} @endif >10:00-17:00</option>
                        <option value='10:00-18:00' @if ($user->dentist_profiles->schedule_m_f == "10:00-18:00") {{ 'selected' }} @endif >10:00-18:00</option>
                        <option value='10:00-19:00' @if ($user->dentist_profiles->schedule_m_f == "10:00-19:00") {{ 'selected' }} @endif >10:00-19:00</option>
                        <option value='10:00-20:00' @if ($user->dentist_profiles->schedule_m_f == "10:00-20:00") {{ 'selected' }} @endif >10:00-20:00</option>
                    </select>
                    @error('schedule_m_f')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Schedule Saturday</label>
                    <select type="text" class="form-control @error('shedule_sat') is-invalid @enderror" id="schedule_sat" name="schedule_sat">
                        <option value='CLOSE' @if ($user->dentist_profiles->schedule_sat == "CLOSE") {{ 'selected' }} @endif >CLOSE</option>
                        <option value='8:00-15:00' @if ($user->dentist_profiles->schedule_sat == "8:00-13:00") {{ 'selected' }} @endif >8:00-13:00</option>
                        <option value='8:00-15:00' @if ($user->dentist_profiles->schedule_sat == "8:00-14:00") {{ 'selected' }} @endif >8:00-14:00</option>
                        <option value='8:00-15:00' @if ($user->dentist_profiles->schedule_sat == "8:00-15:00") {{ 'selected' }} @endif >8:00-15:00</option>
                        <option value='8:00-16:00' @if ($user->dentist_profiles->schedule_sat == "8:00-16:00") {{ 'selected' }} @endif >8:00-16:00</option>
                        <option value='8:00-17:00' @if ($user->dentist_profiles->schedule_sat == "8:00-17:00") {{ 'selected' }} @endif >8:00-17:00</option>
                        <option value='8:00-18:00' @if ($user->dentist_profiles->schedule_sat == "8:00-18:00") {{ 'selected' }} @endif >8:00-18:00</option>
                        <option value='8:00-19:00' @if ($user->dentist_profiles->schedule_sat == "8:00-19:00") {{ 'selected' }} @endif >8:00-19:00</option>
                        <option value='8:00-20:00' @if ($user->dentist_profiles->schedule_sat == "8:00-20:00") {{ 'selected' }} @endif >8:00-20:00</option>
                        <option value='9:00-15:00' @if ($user->dentist_profiles->schedule_sat == "9:00-15:00") {{ 'selected' }} @endif >9:00-15:00</option>
                        <option value='9:00-16:00' @if ($user->dentist_profiles->schedule_sat == "9:00-16:00") {{ 'selected' }} @endif >9:00-16:00</option>
                        <option value='9:00-17:00' @if ($user->dentist_profiles->schedule_sat == "9:00-17:00") {{ 'selected' }} @endif >9:00-17:00</option>
                        <option value='9:00-18:00' @if ($user->dentist_profiles->schedule_sat == "9:00-18:00") {{ 'selected' }} @endif >9:00-18:00</option>
                        <option value='9:00-19:00' @if ($user->dentist_profiles->schedule_sat == "9:00-19:00") {{ 'selected' }} @endif >9:00-19:00</option>
                        <option value='9:00-20:00' @if ($user->dentist_profiles->schedule_sat == "9:00-20:00") {{ 'selected' }} @endif >9:00-20:00</option>
                        <option value='10:00-17:00' @if ($user->dentist_profiles->schedule_sat == "10:00-17:00") {{ 'selected' }} @endif >10:00-17:00</option>
                        <option value='10:00-18:00' @if ($user->dentist_profiles->schedule_sat == "10:00-18:00") {{ 'selected' }} @endif >10:00-18:00</option>
                        <option value='10:00-19:00' @if ($user->dentist_profiles->schedule_sat == "10:00-19:00") {{ 'selected' }} @endif >10:00-19:00</option>
                        <option value='10:00-20:00' @if ($user->dentist_profiles->schedule_sat == "10:00-20:00") {{ 'selected' }} @endif >10:00-20:00</option>
                    </select>
                    @error('schedule_sat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Schedule Sunday</label>
                    <select type="text" class="form-control @error('shedule_sun') is-invalid @enderror" id="schedule_sun" name="schedule_sun" value="{{old('schedule_sun')??$user->dentist_profiles->schedule_sun}}" >
                        <option value='CLOSE' @if ($user->dentist_profiles->schedule_sun == "CLOSE") {{ 'selected' }} @endif>CLOSE</option>
                        <option value='8:00-15:00' @if ($user->dentist_profiles->schedule_sun == "8:00-13:00") {{ 'selected' }} @endif >8:00-13:00</option>
                        <option value='8:00-15:00' @if ($user->dentist_profiles->schedule_sun == "8:00-14:00") {{ 'selected' }} @endif >8:00-14:00</option>
                        <option value='8:00-15:00' @if ($user->dentist_profiles->schedule_sun == "8:00-15:00") {{ 'selected' }} @endif >8:00-15:00</option>
                        <option value='8:00-16:00' @if ($user->dentist_profiles->schedule_sun == "8:00-16:00") {{ 'selected' }} @endif >8:00-16:00</option>
                        <option value='8:00-17:00' @if ($user->dentist_profiles->schedule_sun == "8:00-17:00") {{ 'selected' }} @endif >8:00-17:00</option>
                        <option value='8:00-18:00' @if ($user->dentist_profiles->schedule_sun == "8:00-18:00") {{ 'selected' }} @endif >8:00-18:00</option>
                        <option value='8:00-19:00' @if ($user->dentist_profiles->schedule_sun == "8:00-19:00") {{ 'selected' }} @endif >8:00-19:00</option>
                        <option value='8:00-20:00' @if ($user->dentist_profiles->schedule_sun == "8:00-20:00") {{ 'selected' }} @endif >8:00-20:00</option>
                        <option value='9:00-15:00' @if ($user->dentist_profiles->schedule_sun == "9:00-15:00") {{ 'selected' }} @endif >9:00-15:00</option>
                        <option value='9:00-16:00' @if ($user->dentist_profiles->schedule_sun == "9:00-16:00") {{ 'selected' }} @endif >9:00-16:00</option>
                        <option value='9:00-17:00' @if ($user->dentist_profiles->schedule_sun == "9:00-17:00") {{ 'selected' }} @endif >9:00-17:00</option>
                        <option value='9:00-18:00' @if ($user->dentist_profiles->schedule_sun == "9:00-18:00") {{ 'selected' }} @endif >9:00-18:00</option>
                        <option value='9:00-19:00' @if ($user->dentist_profiles->schedule_sun == "9:00-19:00") {{ 'selected' }} @endif >9:00-19:00</option>
                        <option value='9:00-20:00' @if ($user->dentist_profiles->schedule_sun == "9:00-20:00") {{ 'selected' }} @endif >9:00-20:00</option>
                        <option value='10:00-17:00' @if ($user->dentist_profiles->schedule_sun== "10:00-17:00") {{ 'selected' }} @endif >10:00-17:00</option>
                        <option value='10:00-18:00' @if ($user->dentist_profiles->schedule_sun == "10:00-18:00") {{ 'selected' }} @endif >10:00-18:00</option>
                        <option value='10:00-19:00' @if ($user->dentist_profiles->schedule_sun == "10:00-19:00") {{ 'selected' }} @endif >10:00-19:00</option>
                        <option value='10:00-20:00' @if ($user->dentist_profiles->schedule_sun == "10:00-20:00") {{ 'selected' }} @endif >10:00-20:00</option>
                    </select>
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
                              maxlength="170"
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
            
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
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