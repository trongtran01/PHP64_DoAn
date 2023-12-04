<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../admin/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('admin/img/lrvlogo.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Add-Edit
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('admin/css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ ('admin/demo/demo.css') }}" rel="stylesheet" />
  <!-- Load cdn ckeditor -->
  <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
         <a href="#" class="simple-text logo-normal">
          <div class="logo-image-big">
            <img src="{{ asset('admin/img/logolrv.png') }}">
          </div>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="{{ url('backend/backend') }}">
              <i class="fa fa-home" aria-hidden="true"></i>
              <p>Trang chủ</p>
            </a>
          </li>
          <li>
            <a href="{{ url('backend/categories') }}">
              <i class="fa fa-table fa-fw"></i>
              <p>Danh mục sản phẩm</p>
            </a>
          </li>
          <li class="active">
            <a href="{{ url('backend/products') }}">
              <i class="fa fa-list" aria-hidden="true"></i>
              <p>Danh sách sản phẩm</p>
            </a>
          </li>
          <li>
            <a href="{{ url('backend/news') }}">
              <i class="fa fa-newspaper-o" aria-hidden="true"></i>
              <p>Tin tức</p>
            </a>
          </li>
          <li>
            <a href="{{ url('backend/orders') }}">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              <p>Đơn hàng</p>
            </a>
          </li>
          <li>
            <a href="{{ url('backend/categories') }}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <p>User</p>
            </a>
          </li>
          <li>
            <a href="{{ url('backend/logout') }}">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
              <p>Đăng xuất</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" style="height: auto ;">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Trang danh sách sản phẩm</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Tìm kiếm...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-magnify" href="javascript:;">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="javascript:;">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Sản phẩm</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                      <div class="col-md-12">
    <div style="margin-bottom:5px;">
    </div>
    <div class="col-md-12">
      <div class="panel panel-primary">
          <div class="panel-heading"></div>
          <div class="panel-body">
            <!-- muốn upload được file thì phải có thuộc tính enctype="multipart/form-data" -->
          <form method="post" enctype="multipart/form-data" action="{{ $action }}">
            @csrf
              <!-- rows -->
              <div class="row" style="margin-top:5px;">
                  <div class="col-md-2">Name</div>
                  <div class="col-md-10">
                      <input type="text" required value="{{ isset($record->name)?$record->name:'' }}" name="name" class="form-control" required>
                  </div>
              </div>
              <!-- end rows -->
              <!-- rows -->
              <div class="row" style="margin-top:5px;">
                  <div class="col-md-2">Price</div>
                  <div class="col-md-10">
                      <input type="text" required value="{{ isset($record->price)?$record->price:'' }}" name="price" class="form-control" required>
                  </div>
              </div>
              <!-- end rows -->
              <!-- rows -->
              <div class="row" style="margin-top:5px;">
                  <div class="col-md-2">Discount</div>
                  <div class="col-md-10">
                      <input type="number" required min="0" value="{{ isset($record->discount)?$record->discount:'' }}" name="discount" class="form-control" required>
                  </div>
              </div>
              <!-- end rows -->
              <!-- rows -->
              <div class="row" style="margin-top:5px;">
                  <div class="col-md-2">Category</div>
                  <div class="col-md-10">
                      @php
                        //có thể dùng trực tiếp câu lệnh full sql (không khuyến khích)
                        $categories = DB::select("select * from categories where parent_id = 0 order by id desc");
                      @endphp
                      <select class="form-control" name="category_id" style="width:250px;">
                      @foreach($categories as $row)
                        <option @if(isset($record->category_id)&&$record->category_id==$row->id) selected @endif value="{{ $row->id }}">{{ $row->name }}</option>
                        @php
                          $subCategories = DB::table("categories")->where("parent_id","=",$row->id)->orderBy("id","desc")->get();
                        @endphp
                        @foreach($subCategories as $subRow)
                          <option @if(isset($record->category_id)&&$record->category_id==$subRow->id) selected @endif value="{{ $subRow->id }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $subRow->name }}</option>
                        @endforeach
                      @endforeach
                      </select>
                  </div>
              </div>
              <!-- end rows -->
              <!-- để fix độ cao của ckeditor thì phải thêm đoạn css sau -->
              <style>
                .ck-editor__editable{
                  max-height: 350px;
                  min-height: 350px;
                  overflow: scroll;
                }
              </style>
              <!-- rows -->
              <div class="row" style="margin-top:5px;">
                  <div class="col-md-2">Description</div>
                  <div class="col-md-10">
                      <textarea name="description" id="description">{{ isset($record->description)?$record->description:'' }}</textarea>
                      <script type="text/javascript">
                        ClassicEditor.create(document.querySelector("#description"));
                      </script>
                  </div>
              </div>
              <!-- end rows -->
              <!-- rows -->
              <div class="row" style="margin-top:5px;">
                  <div class="col-md-2">Content</div>
                  <div class="col-md-10">
                      <textarea name="content" id="content">{{ isset($record->content)?$record->content:'' }}</textarea>
                      <script type="text/javascript">
                        ClassicEditor.create(document.querySelector("#content"));
                      </script>
                  </div>
              </div>
              <!-- end rows -->
              <!-- rows -->
              <div class="row" style="margin-top:5px;">
                  <div class="col-md-2"></div>
                  <div class="col-md-10">
                      <input type="checkbox" @if(isset($record->hot) && $record->hot == 1) checked @endif name="hot" id="hot"> <label for="hot">Hot</label>
                  </div>
              </div>
              <!-- end rows -->
              <!-- rows -->
              <div class="row" style="margin-top:5px;">
                  <div class="col-md-2">Photo</div>
                  <div class="col-md-10">
                      <input type="file" name="photo">
                  </div>
              </div>
              <!-- end rows -->
              <!-- rows -->
              <div class="row" style="margin-top:5px;">
                  <div class="col-md-2"></div>
                  <div class="col-md-10">
                      <input type="submit" value="Process" class="btn btn-primary">
                  </div>
              </div>
              <!-- end rows -->
          </form>
          </div>
      </div>
  </div>
    </div>
</div>

                  <!-- <ul class="pagination" style="padding-left: 10px;">
                      <li class="page-item">
                          <a href="http://localhost/php64_laravel_DoAn/public/backend/categories?page=1" class="page-link">1</a>
                      </li>
                      <li class="page-item">
                          <a href="http://localhost/php64_laravel_DoAn/public/backend/categories?page=2" class="page-link">2</a>
                      </li>
                  </ul> -->
                  <!-- <style type="text/css">
                      .page-link{
                        color: #51cbce;
                        font-size: 16px;
                      }
                      .page-link:hover{
                        background: #51cbce;
                        color: #fff;
                      }
                      .table{
                        font-size: 16px;
                      }
                      .w-5{
                        display: hidden !important;
                      }
                      .flex-1{
                        margin-bottom: 15px;
                      }
                      svg {
                        overflow: hidden;
                        vertical-align: middle;
                        display: contents;
                        }
                    .z-0{
                            display: none;
                        }
                  </style> -->
                </div>
              </div>
            </div>
          </div>
      <footer class="footer" style="margin-top:100px !important ;position: absolute; bottom: 0; width: -webkit-fill-available;">
        <div class="container-fluid">
          <div class="row">
            <div class="credits ml-auto">
              <span class="copyright" style="font-size: 18px;"></span>
            </div>
          </div>
        </div>
      </footer>
    </div>
                    <div class="cpr">© 2023, made with <i class="fa fa-heart heart"></i> by Suplement Home</div>

  </div>

  <style type="text/css">
    .cpr{
      float: right ;
      line-height: 18px;
      padding-right: 20px;
      padding-bottom: 20px;
      font-size: 18px;
    }
  </style>
  <!--   Core JS Files   -->
  <script src="{{ asset('admin/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{ asset('admin/js/plugins/chartjs.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('admin/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('admin/js/paper-dashboard.min.js?v=2.0.1') }}" type="text/javascript"></script>
</body>

</html>
