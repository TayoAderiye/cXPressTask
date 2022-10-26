@props(['activity'])
@props(['users'])

<x-admin-layout>

    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Activity</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" >
                @csrf
                <input name="id" hidden value="{{$activity->id}}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="title" value="{{$activity->title}}" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                    @error('title')
                    <p style="color: red" class="text-red-500 text-xs mt-1">{{$message}}</p>
                 @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <input name="description" value="{{$activity->description}}" type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Description">
                    @error('description')
                    <p style="color: red" class="text-red-500 text-xs mt-1">{{$message}}</p>
                 @enderror
                  </div>
                  {{-- <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="image" accept="image/png, image/gif, image/jpeg" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                    @error('image')
                    <p style="color: red" class="text-red-500 text-xs mt-1">{{$message}}</p>
                 @enderror
                  </div> --}}
                  <div class="form-group">
                    <label for="exampleInputFile">Type</label>
                    <select value="{{$activity->type}}" name="type" class="custom-select form-control-border" id="exampleSelectBorder">
                      {{-- <option>SELECT</option> --}}
                      <option value="G">Global</option>
                      <option value="N">Private</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">User (Only Select if you want to Assign)</label>
                   
                    <select name="userId" class="custom-select form-control-border" id="exampleSelectBorder">
                      @foreach ($users as $user)
                      <option value="{{$user->id}}">{{$user->email}}</option>
                    @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Date:</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input value="{{$activity->date}}" name="date"  type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                      @error('date')
                      <p style="color: red" class="text-red-500 text-xs mt-1">{{$message}}</p>
                   @enderror
                  </div>
                </div>
                
                <div class="card-footer">
                  <button formaction="/updateActivity" type="submit" class="btn btn-primary">Submit</button>
                  <button formaction="/assignActivity" type="submit" class="btn btn-primary">Assign</button>

                </div>
              </form>
            </div>
            <!-- /.card -->
  
           
  
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</x-admin-layout>