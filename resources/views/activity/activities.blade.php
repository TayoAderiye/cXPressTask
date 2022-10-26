@props(['activities'])
@props(['users'])

<x-admin-layout>

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create Activity</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="/createActivity" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="title" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Title">
                  @error('title')
                  <p style="color: red" class="text-red-500 text-xs mt-1">{{$message}}</p>
               @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <textarea name="description"  type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Description"></textarea>
                  @error('description')
                  <p style="color: red" class="text-red-500 text-xs mt-1">{{$message}}</p>
               @enderror
                </div>
                <div class="form-group">
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
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Type</label>
                  <select name="type" class="custom-select form-control-border" id="exampleSelectBorder">
                    <option>SELECT</option>
                    <option value="G">Global</option>
                    <option value="N">Private</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">User (Only Select if Private)</label>
                 
                  <select name="userId" class="custom-select form-control-border" id="exampleSelectBorder">
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->email}}</option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Date:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input name="date"  type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
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
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

         

        </div>
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Get User Activity</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="/getUserActivities">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputFile">Users</label>
                 
                  <select name="userId" class="custom-select form-control-border" id="exampleSelectBorder">
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->email}}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

         

        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
    <br>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List of All Activities</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Date</th>
                  <th>Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($activities as $activity)
                <tr>
                  <td>{{$activity->id}}</td>
                  <td>{{$activity->title}}</td>
                  <td>{{$activity->description}}</td>
                  <td><img
                   style="height: 50px"
                    src="{{asset('storage/' . $activity->image) }}"
                    alt=""
                /></td>
                  <td>{{$activity->date}}</td>
                  <td>{{$activity->type}}</td>
                  <td>
                    <a href="/editActivity/{{$activity->id}}" class="btn btn-primary">Edit</a>
                    <a href="/deleteActivity/{{$activity->id}}" class="btn btn-danger">Delete</a>                  

                  </td>
                </tr>
              </tbody>
              @endforeach
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>
  <x-flash-message />
  
</x-admin-layout>
