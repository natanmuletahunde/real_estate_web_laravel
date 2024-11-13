@extends('layouts.app')

@section('content')

<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url({{asset('assets/images/hero_bg_2.jpg')}});" data-aos="fade">

<div class="row align-items-center justify-content-center text-center">
  <div class="col-md-10">
    <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Property Details of</span>s
    <h1 class="mb-2"> All Requests  Properties</h1>

  </div>
</div>
</div>

<div class="site-section site-section-sm bg-light">
   <div class="container">

     <div class="row">
       <div class="col-12">
         <div class="site-section-title mb-5">
           <h2>All Requests  Properties</h2>
         </div>
       </div>
     </div>

     <div class="row mb-5">

       @if ($allrequests -> count()>0)
       @foreach ( $allrequests as $relatedProp )
       <div class="col-m    d-6 col-lg-4 mb-4">
         <div class="property-entry h-100">
           <a href="{{route('single.prop', $relatedProp->id )}}" class="btn btn-success">

              Go to this Property
           </a>
         
         </div>
       </div>
       @endforeach
       <h2 class=" ">There are not Requests Proprties just now </h2>
       @endif
       <footer class="site-footer">
         <div class="container">
           <div class="row">
             <div class="col-lg-4">
               <div class="mb-5">
                 <h3 class="footer-heading mb-4">About Homeland</h3>
                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe pariatur reprehenderit vero atque, consequatur id ratione, et non dignissimos culpa? Ut veritatis, quos illum totam quis blanditiis, minima minus odio!</p>
               </div>
             </div>
             <div class="col-lg-4 mb-5 mb-lg-0">
               <div class="row mb-5">
                 <div class="col-md-12">
                   <h3 class="footer-heading mb-4">Navigations</h3>
                 </div>
                 <div class="col-md-6 col-lg-6">
                   <ul class="list-unstyled">
                     <li><a href="#">Home</a></li>
                     <li><a href="#">Buy</a></li>
                     <li><a href="#">Rent</a></li>
                     <li><a href="#">Properties</a></li>
                   </ul>
                 </div>
                 <div class="col-md-6 col-lg-6">
                   <ul class="list-unstyled">
                     <li><a href="#">About Us</a></li>
                     <li><a href="#">Privacy Policy</a></li>
                     <li><a href="#">Contact Us</a></li>
                     <li><a href="#">Terms</a></li>
                   </ul>
                 </div>
               </div>


             </div>

             <div class="col-lg-4 mb-5 mb-lg-0">
               <h3 class="footer-heading mb-4">Follow Us</h3>

               <div>
                 <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                 <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                 <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                 <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
               </div>



             </div> 

           </div>
           <div class="row pt-5 mt-5 text-center">
             <div class="col-md-12">
               <p>
                 <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                 Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                 <script>
                   document.write(new Date().getFullYear());
                 </script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                 <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
               </p>
             </div>

           </div>
         </div>
       </footer>

     </div>

    </div>
    </div>

@endsection
