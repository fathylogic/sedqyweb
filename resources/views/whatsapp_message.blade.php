<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel 12 How to Send WhatsApp message using Twilio - itstuffsolutiotions.io</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" >
  <style type="text/css">
    body{
      background: #F8F9FA;
    }
  </style>
</head>
<body>
  
<section class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
        <div class="card border border-light-subtle rounded-3 shadow-sm mt-5">
          <div class="card-body p-3 p-md-4 p-xl-5">
             @session('success')
                <div class="alert alert-success" role="alert"> 
                {{ $value }}
                </div>
             @endsession
            <h2 class="text-center mb-4">ارسال رسالة واتس </h2>
            <form method="POST" action="{{ route('send.whatsapp') }}">
              @csrf
  
              @session('error')
                  <div class="alert alert-danger" role="alert"> 
                      {{ session('error') }}
                  </div>
              @endsession
  
              <div class="row gy-2 overflow-hidden">               
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="" placeholder="eg. +9665xxxxxxxx" required>
                    <label for="phone" class="form-label">رقم المرسل له مثال مسبوقا برمز البلد </label>
                  </div>
                  @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <textarea  type="text" class="form-control @error('message') is-invalid @enderror" name="message" id="message" cols="50" placeholder="your message..." required></textarea>
                    <label for="message" class="form-label">{{ __('Whatsapp Message') }}</label>
                  </div>
                  @error('message')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="col-12">
                  <div class="d-grid my-3">
                    <button class="btn btn-success btn-lg" type="submit">{{ __('Send Whatsapp') }}</button>
                  </div>
                </div>
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  
</body>
</html>
