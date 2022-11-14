<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nhà thuốc</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,200;1,300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <base href="{{asset('')}}">
  <link rel="stylesheet" href="style/layout.css">
</head>

<body>
  <div class="topnav">
    <div class="navlink">
      <a href="{{route('homepage')}}">Trang chủ</a>
      <a href="{{route('add')}}">Thêm sản phẩm</a>
      <a href="{{route('productlist')}}">Danh sách sản phẩm</a>
    </div>
    <div class="search_container">
      <form for="search" action="{{route('search')}}" method="get">
        <input type="text" placeholder="Tìm kiếm..." name="search" id="search">
        <button type="submit">Tìm</button>
      </form>
    </div>
  </div>

  <div class="content">
    <div class="dropdown">
      <button class="nut_dropdown">Sắp xếp</button>
      <div class="noidung_dropdown">
        <a href="{{route('SortProductASC')}}">Giá tăng dần</a>
        <a href="{{route('SortProductDESC')}}">Giá giảm dần</a>
        <a href="{{route('SortProductAZ')}}">Tên A - Z</a>
        <a href="{{route('SortProductZA')}}">Tên Z - A</a>
      </div>
    </div>

    @yield('content')
  </div>

  <div class="footer">
    hello
  </div>

</body>

</html>