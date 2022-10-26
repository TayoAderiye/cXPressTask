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
