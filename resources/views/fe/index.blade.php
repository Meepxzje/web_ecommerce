<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('font-end//css/reset.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0e2b80c1a7.js" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('font-end/css/stylesproduct.css')}}">
    <link rel="stylesheet" href="{{asset('font-end/css/styles.css')}}">
    <!-- js -->
    <script src="{{asset('font-end/js/uikit.js')}}"></script>
    <script src="{{asset('font-end/js/uikit-icons.js')}}"></script>
    <script src="{{asset('font-end/js/search.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.css" />
    <title>@yield('title')</title>
</head>

<body>
    <aside>
        @include('fe.layout.header')
    </aside>
    @yield('home')
    @yield('sanpham')
    @yield('chitietsp')
    @yield('listsp')
    @yield('dsdm')
    @yield('giohang')
    @yield('hang')
    @yield('taikhoan')
    @yield('thanhtoan')
    @yield('sosanh')
    @yield('404')
    @yield('timkiemsp')
    @yield('spgiamgia')
    <aside>
        @include('fe.layout.footer')
    </aside>

    <script>
        const categoryBtn = document.getElementById("categoryBtn");
        const featureDropdown = document.getElementById("featureDropdown");
        const arrowIcon = document.getElementById('arrowIcon');

        categoryBtn.addEventListener("click", () => {
            featureDropdown.classList.toggle("open");
            arrowIcon.classList.toggle('fa-angle-up');
        });
        document.addEventListener("click", (event) => {
            if (!featureDropdown.contains(event.target) && !categoryBtn.contains(event.target)) {
                featureDropdown.classList.remove("open");
                arrowIcon.classList.remove('fa-angle-up');
            }
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @include('fe.layout.thongbao')

    <script>
        window.embeddedChatbotConfig = {
            chatbotId: "eZ2XbnoO7ybJ-ZEq82IRP",
            domain: "www.chatbase.co"
        }
    </script>
    <script src="https://www.chatbase.co/embed.min.js" chatbotId="eZ2XbnoO7ybJ-ZEq82IRP" domain="www.chatbase.co" defer>
    </script>

    <!-- <script>
        window.embeddedChatbotConfig = {
            chatbotId: "pQK0iePC7YHSpZoqYWncj",
            domain: "www.chatbase.co"
        }
    </script>
    <script
        src="https://www.chatbase.co/embed.min.js"
        chatbotId="pQK0iePC7YHSpZoqYWncj"
        domain="www.chatbase.co"
        defer>
    </script> -->





    <a href="https://www.facebook.com/people/VinMeep-Shop/61562357379968/" rel="noopener noreferrer" target="_blank" style="position: fixed; bottom: 75px; right: 10px;">
        <img src="https://i.ibb.co/CvfvQRR/c5i5MG5.png" alt="Chatbox ShopEris" style="height: 60px;">
    </a>

</body>

</html>
