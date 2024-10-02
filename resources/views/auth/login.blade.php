
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


<section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
              <h3 class=""></h3>
              
            </div>
  
            <div class="divider d-flex align-items-center my-4">
              <h3 class="text-center  mb-0">GrafiTareas </h3>
            </div>
        

            

            <!-- Email input -->
         
            <div data-mdb-input-init class="form-outline mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full"  class="form-control form-control-lg"  type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

         
  
            <!-- Password input -->
  
            <div data-mdb-input-init class="form-outline mb-3">
                <x-input-label for="password" :value="__('Contraseña')" />
    
                <x-text-input id="password" class="form-control form-control-lg block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            
            <div class="d-flex justify-content-between align-items-center">

                


              <!-- Checkbox -->
              <div  class="form-check mb-0">
                <label for="remember_me" class="inline-flex items-center">
                    <input  class="form-check-input me-2"  id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recuerdame') }}</span>
                </label>
            </div>


            </div>
  
            <div class="text-center text-lg-start mt-4 pt-2">
        
                <x-primary-button class="ml-3 btn btn-primary btn-lg">
                    {{ __('Acceder') }}
                </x-primary-button>


            </form>

              <p class="small fw-bold mt-2 pt-1 mb-0">¿No tienes una cuenta? <a href="#!"
                  class="link-danger"  data-toggle="modal" data-target="#registerModal" >Registra una cuenta</a></p>
            </div>
  
          </form>
  
        
  
  
        
        <!-- Modal -->
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="registerModalLabel">Nueva cuenta </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- Formulario de Registro -->
                 <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class=" form-control block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electronico')" />
            <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="form-control block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="form-control block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('¿Ya estas registrado?') }}
            </a>

            <x-primary-button class="ml-4 btn btn-primary btn-lg">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
                  <div id="registerErrors" class="mt-3 text-danger"></div>
                </div>
              </div>
            </div>
          </div>



          <script>
            $(document).ready(function() {
                $('#registerForm').on('submit', function(e) {
                    e.preventDefault();
            
                    // Limpia los errores anteriores
                    $('#registerErrors').html('');
            
                    // Datos del formulario
                    var formData = {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        password_confirmation: $('#password_confirmation').val(),
                        _token: $('input[name="_token"]').val()
                    };
            
                    // Realiza la solicitud AJAX
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('register') }}', // URL a la que envías el formulario
                        data: formData,
                         success: function(response) {
                            // Si el registro fue exitoso, redirecciona o muestra mensaje
                            if (response.success) {
                                window.location.href = "/tasks"; // Cambia esta ruta según a dónde quieras redireccionar
                            }
                        },
                        error: function(response) {
                            // Maneja los errores de validación y los muestra en el modal
                            var errors = response.responseJSON.errors;
                            var errorHtml = '<ul>';
                            $.each(errors, function(key, value) {
                                errorHtml += '<li>' + value[0] + '</li>';
                            });
                            errorHtml += '</ul>';
                            $('#registerErrors').html(errorHtml);
                        }
                    });
                });
            });
            </script>



<script>
    $(document).ready(function() {
        // Si hay errores de validación, abrir el modal automáticamente
        @if ($errors->any())
            $('#registerModal').modal('show');
        @endif
    });
</script>





        </div>
      </div>
    </div>
    <div
      class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
      <!-- Copyright -->
      <div class="text-white mb-3 mb-md-0">
        Copyright © 2020. All rights reserved.
      </div>
      <!-- Copyright -->
  
      <!-- Right -->
      <div>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="#!" class="text-white">
          <i class="fab fa-linkedin-in"></i>
        </a>
      </div>
      <!-- Right -->
    </div>
  </section>

  <style>
.divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}

  </style>




