<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="{{ URL::asset("/css/app.css") }}">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Perfil Usuário</h1>
            <div class="row">

                @if(session("success"))
                    <div class="alert alert-success col-md-12">
                        <strong>{{ session("success") }}</strong>
                    </div>
                @endif

                @include("elements.message")

                <form action="/perfil" method="post" class="col-md-12" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" id="name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" id="email" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" name="password" alue="{{ auth()->user()->password }}" id="password" class="form-control"/>
                    </div>

                    <div class="form-group">
                        @if (auth()->user()->image != null)
                            <img src="{{ url('storage/user/' . auth()->user()->image) }}"
                                 style="margin-bottom: 5px" alt="Image profile user" width="50px" height="50px" />
                        @endif
                        <label for="image">Imagem:</label>
                        <input type="file" name="image" id="image" value="{ auth()->user()->image }}" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Gravar" class="btn btn-primary"/>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{ URL::asset("/css/app.js") }}"></script>
    </body>
</html>