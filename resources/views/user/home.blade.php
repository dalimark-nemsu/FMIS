@extends('layouts.user.app')

@section('page-title', 'Dashboard')

@section('content')

<style>
  .date-time-text {
    font-size: 24px; /* Adjust the font size as desired */
  }
</style>


<section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <div class="col-lg-12">
              <div class="row">
                <!-- Real-time Date and Time -->
                <div class="col-md-12">
                  <div class="card date-time-card">
                    <div class="card-body">
                      <h5 class="card-title">Current Date and Time</h5>
                      <p id="date-time" class="date-time-text"></p>
                    </div>
                  </div>
                </div>        
       </div>



       

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->

      </div>




      <script>
        function updateDateTime() {
          var now = new Date();
          var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
          var formattedDateTime = now.toLocaleString('en-US', options);
          document.getElementById('date-time').textContent = formattedDateTime;
        }
      
        // Update date and time every second
        setInterval(updateDateTime, 1000);
      </script>


</section>

@endsection


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
