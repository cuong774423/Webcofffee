@extends('layouts.master')
@section('content')	
    <!-- Carousel Section -->
    @if(Session::has('success'))
    <div id="orderSuccessMessage" style="display:block; font-size:20px; font-weight: bold; background-color: #28a745; color: white; padding: 20px; position: fixed; top: 20%; left: 50%; transform: translate(-50%, -50%); border-radius: 5px; font-size: 18px; z-index: 10;">
        {{ Session::get('success') }}
    </div>

    <script>
        window.onload = function() {
            var message = document.getElementById('orderSuccessMessage');
            message.style.display = 'block';

            // Ẩn thông báo sau 3 giây
            setTimeout(function() {
                message.style.display = 'none';
            }, 3000);
        };
    </script>
@endif
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100" alt="Slide 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100" alt="Slide 3">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/slide4.jpg') }}" class="d-block w-100" alt="Slide 4">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/slide5.jpg') }}" class="d-block w-100" alt="Slide 5">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


    
<div class="product-container">
    @foreach ($products as $product)
        <div class="product-card">
            <a href="{{ route('page.product', $product->ProductID) }}">
                <img src="{{ asset('images/' . $product->ImageURL) }}" alt="">
            </a>
            <a href="{{ route('page.product', $product->ProductID) }}">
                <h2>{{ $product->ProductName }}</h2>
            </a>
                <span>{{ $product->Price }}đ</span>
                <a class="add-to-cart pull-left" href="{{ route('banhang.addtocart',$product->ProductID) }}"><i class="fa fa-shopping-cart"></i></a>
        </div>
    @endforeach
</div>

<div class="about">
    <div class="about_item about1">
        <img src="{{ asset('images/about1.jpg')}}" alt="">
    </div>
    <div class="about_item about2">
        <div>
            <img src="{{ asset('images/about.webp')}}" alt="">
        </div>
        <div>
            <p>Được trồng trọt và chăm chút kỹ lưỡng, nuôi dưỡng từ thổ nhưỡng phì nhiêu, nguồn nước mát lành, bao bọc bởi mây và sương cùng nền nhiệt độ mát mẻ quanh năm, những búp trà ở Tây Bắc mập mạp và xanh mướt, hội tụ đầy đủ dưỡng chất, sinh khí, và tinh hoa đất trời.Chính khí hậu đặc trưng cùng phương pháp canh tác của đồng bào dân tộc nơi đây đã tạo ra Trà Xanh vị mộc dễ uống, dễ yêu, không thể trộn lẫn với bất kỳ vùng miền nào khác </p>
        </div>
        <div>
            <button>Thử ngay</button>
        </div>
       
    </div>
</div>


    

    <script>
        let currentIndex = 0;
        const items = document.querySelectorAll('.carousel-item');
        const totalItems = items.length;

        function showNextSlide() {
            items[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % totalItems;
            items[currentIndex].classList.add('active');
        }

        setInterval(showNextSlide, 3000); // Change slide every 3 seconds
    </script>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) { // Khi cuộn xuống 50px hoặc hơn
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>
@endsection
