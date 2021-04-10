@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('REGISTER FORM') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" 
                                     name="phone" placeholder = "isikan +62" required autocomplete="phone">
                               <?php
                               if (isset($_POST['submit'])) {
                                    // mengambil nomor handphone telah diinput
                                    $phone = $_POST['phone'];
                                    // validasi inputan nomor handphone
                                        if (!preg_match("/^[0-9|(\+|)]*$/", $phone) OR strlen(strpos($phone, "+", 1)) > 0) {
                                            echo "<strong>Handphone hanya boleh menggunakan angka dan diawali simbol +</strong>";
                                        }   
                                        else if (substr($phone, 0, 3) != "+62" ) {
                                            echo "<strong>Handphone harus diawali dengan kode negara +62</strong>";
                                        }
                                        else if (substr($phone, 3, 1) == "0" ) {
                                            echo "<strong>Handphone tidak boleh diikuti dengan angka 0 setelah kode negara</strong>";
                                        }
                                        else {
                                            // menampilkan nomor handphone
                                                echo "<strong>Handphone : $tampil_handphone</strong>";
                                        }                
                                }?>
                            </div>
                        </div>

                            <div class="form-group row">
                                <label for="address"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control"
                                           name="address" required autocomplete="address">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                           <!--div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="g-recaptcha" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"></div>
                                    @if($errors->has('g-recaptcha-response'))
                                        <span class="invalid-feedback" style="display:block">
                                            <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>  -->

                        <!-- google recaptcha -->
                        <div class="form-group row {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <label class="col-md-4 col-form-label text-md-right">Captcha</label>
                            <div class="col-md-6">
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                            <div class="form-group row mb-0">
                            <style>
                                .button {
                                background-color: #e3e4fa;
                                border: none;
                                color: black;
                                text-align: center;
                                font-size: 12px;
                                padding: 8px 18px;
                                border-radius: 8px;
                                font-weight: bold;
                                font-family: charcoal;
                                place-items:center;
                                }
                            </style>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="button">
                                        {{ __('REGISTER') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
